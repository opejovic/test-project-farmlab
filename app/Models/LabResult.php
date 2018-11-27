<?php

namespace App\Models;

use App\Mail\NewResultNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class LabResult extends Model
{
    const PROCESSED     = 'PROCESSED';
    const UNPROCESSED   = 'UNPROCESSED';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The "booting" method of the model.
     * Applies an anonymous global scope for the model. All queries will return
     * results for the practice of the authenticated user.
     *
     * Also, when the new result is uploaded, the email notification is sent to the owner (vet) of that result.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('practice_id', function (Builder $builder) {
            $builder->where('practice_id', auth()->user()->practice_id);
        });

        static::created(function ($labresult) {
            Mail::to($labresult->vet->email)->queue(
                new NewResultNotification($labresult, $labresult->vet)
            );
        });
    }

    /**
     * Lab result belongs to a vet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vet()
    {
        return $this->belongsTo(User::class, 'vet_id');
    }

    /**
     * Lab result belongs to a practice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function practice()
    {
        return $this->belongsTo(Practice::class);
    }

    /**
     * Query scope
     *
     * Returns all results for the auth user.
     *
     * @param        $query
     * @param string $status
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function scopeResults($query, $status = LabResult::UNPROCESSED)
    {
        return $query->where('status', $status)
                     ->where('vet_id', auth()->id())
                     ->oldest('id')
                     ->get();
    }

    /**
     * Query scope
     *
     * Returns all processed results.
     *
     * @param $query
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function scopeProcessed($query)
    {
        return $query->where('status', LabResult::PROCESSED);
    }

    /**
     * Returns results based on their status (by default, returns Unprocessed (if there are any))
     * for the auth user.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function fetchByStatus()
    {
        $results = $this->results();
        if ($results->isEmpty()) {
            return $this->results(LabResult::PROCESSED);
        }
        return $results;
    }

    /**
     * Returns all results for the practice  of the authenticated vet.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function fetchAll()
    {
        return $this->with('vet')->with('practice')->oldest('id')->get();
    }

    /**
     * Check it the Lab result is proccessed.
     *
     * @return boolean
     */
    public function isProcessed()
    {
        return ($this->status === LabResult::PROCESSED) ? true : false;
    }

    /**
     * @param File $file
     *  Parse the result from the request()->file, and save it to DB.
     */
    public function parseAndSave($file)
    {
        $handle = fopen($file, 'r');
        fgetcsv($handle);         // Adding this line will skip the reading of the 
        // first line from the csv file and the reading process will begin 
        // from the second line onwards. 
        // ((fgetcsv parses the first line (header) and returns an array 
        // with those columns. Implicitly, the file pointer is now on the 2nd row.))

        while (($column = fgetcsv($handle, 1000, ",")) !== FALSE) {

            $labresult =  $this->create([
                'herd_number'     => $column[0],
                'date_of_arrival' => $column[1],
                'date_of_test'    => $column[2],
                'animal_id'       => $column[3],
                'lab_code'        => $column[4],
                'test_name'       => $column[5],
                'type_of_samples' => $column[6],
                'reading'         => $column[7],
                'interpretation'  => $column[8],
                'farmer_name'     => $column[9],
                'vet_comment'     => $column[10],
                'vet_indicator'   => $column[11],
                'practice_id'     => $column[12],
                'practice_name'   => Practice::name($column[12]),
                'vet_id'          => $column[13]
            ]);
        }
        fclose($handle);
    }

    /**
     * Returns the labresults practice name
     *
     * @return void
     */
    public function getPracticeNameAttribute()
    {
        return $this->practice->name;
    }

    /**
     * Returns the number of the unproccesed results.
     *
     * @return integer
     */
    public function getUnprocessedAttribute()
    {
        return $this->results()->count();
    }
}
