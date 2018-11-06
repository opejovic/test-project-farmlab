<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class File extends Model
{
    protected $fillable = ['name', 'file_path', 'uploaded_by'];

    /**
     * A File belongs to an uploader.
     *
     * @return App\Models\User::class
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Retruns the name of the files uploader.
     *
     */
    public function getUploaderNameAttribute()
    {
        return $this->uploader->name;
    }

    /**
     * Returns the time of the file upload.
     *
     */
    public function getUploadedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Returns the number of the uploaded files for the current month.
     *
     * @return Integer
     */
    public function getUploadedThisMonthAttribute()
    {
        return count($this->where('created_at', '>=', Carbon::now()->startOfMonth())
                          ->get());
    }    

    /**
     * Returns the number of the all uploaded files.
     *
     * @return Integer
     */
    public function getCountAllAttribute()
    {
        return count($this->all());
    }

    /**
     *
     * @param   $fileName [requested files name]
     *
     * @return bool
     */
    private function existsInStorage($fileName)
    {
        return (Storage::exists("labresults/{$fileName}")) ? true : false;
    }

    /**
     * Check if the file exists in the database
     *
     * @param   $fileName [requested files name]
     *
     * @return bool
     */
    private function existsInDb($fileName)
    {
        $dbFile = $this->where('name', $fileName)->first();

        return ($dbFile !== null) ? true : false;
    }

    /**
     * Save the file from the request to db
     *
     * @param $fileName
     * @param $filePath
     */
    private function saveToDb($fileName, $filePath)
    {
        $this->create([
            'name'        => $fileName,
            'file_path'   => storage_path($filePath),
            'uploaded_by' => auth()->id()
        ]);
    }

    /**
     * Upload the file from the request to storage (if its not a duplicate),
     * and then trigger the LabResult parseAndSave method.
     *
     */
    public function upload()
    {
        $file = request()->file('file');
        $fileName = $file->getClientOriginalName();

        if ($this->existsInDb($fileName)) {
            abort(400, 'The file already exists in our database records.');
        }

        if ($this->existsInStorage($fileName)) {
            abort(400, 'The file already exists in our storage.');
        }

        $this->saveToDb($fileName, Storage::putFileAs('labresults', $file, $fileName));

        (new LabResult)->parseAndSave($file);
    }
}
