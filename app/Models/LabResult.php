<?php

namespace App\Models;

use App\Events\LabResultCreated;
use App\Mail\NewResultNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class LabResult extends Model
{
    const PROCESSED   = 'Processed';
    const UNPROCESSED = 'Unprocessed';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that fire off the events.
     * 
     */
    protected $dispatchesEvents = [
        'created' => LabResultCreated::class
    ];
    
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
     * Vets processes the result via form/modal.
     *
     */
    public function process($comment, $indicator)
    {
        $this->update([
            'vet_id'        => auth()->id(),
            'vet_comment'   => $comment,
            'vet_indicator' => $indicator,
            'processed_at'  => Carbon::now(),
        ]);        
    }

    /**
     * Query scope
     *
     * Returns all lab results owned by user.
     *
     * @param        $query
     * @param string $status
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function scopeOwnedByAuth($query)
    {
        return $query->where('vet_id', auth()->id())->orderBy('processed_at', 'asc');
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
        return $query->whereNotNull('processed_at');
    }
    
    /**
     * Query scope
     *
     * Returns all unprocessed results.
     *
     * @param $query
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function scopeUnprocessed($query)
    {
        return $query->whereNull('processed_at');
    }

    /**
     * Check it the Lab result is proccessed.
     *
     * @return boolean
     */
    public function isProcessed()
    {
        return ($this->processed_at !== null) ? true : false;
    }

    /**
     * @param File $file
     *  Parse the result from the csv file, and save it to DB.
     */
    public static function parse($file)
    {
        $handle = fopen($file, 'r');
        fgetcsv($handle);         // Adding this line will skip the reading of the 
        // first line from the csv file and the reading process will begin 
        // from the second line onwards. 
        // ((fgetcsv parses the first line (header) and returns an array 
        // with those columns. Implicitly, the file pointer is now on the 2nd row.))

        while (($column = fgetcsv($handle, 1000, ",")) !== FALSE) {

            self::create([
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
     * Returns the number of the unproccesed results owned by auth user.
     *
     * @return integer
     */
    public function getCountUnprocessedAttribute()
    {
        return $this->ownedByAuth()->unprocessed()->count();
    }

    /**
     * Returns the number of the processed results owned by auth user.
     *
     * @return integer
     */
    public function getCountProcessedAttribute()
    {
        return $this->ownedByAuth()->processed()->count();
    }

    /**
     * Returns the status of the labresult - processed or unprocessed.
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        return $this->isProcessed() ? self::PROCESSED : self::UNPROCESSED;
    }
}
