<?php

namespace App\Models;

use App\Events\FileUploaded;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class File extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * A File has an uploader.
     *
     * @return App\Models\User::class
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Check if the file exists in the database
     *
     * @param   $fileName [requested files name]
     *
     * @return bool
     */
    private function existsInStorage($fileName)
    {
        return Storage::exists("labresults/{$fileName}") ? true : false;
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
        return $this->whereName($fileName)->first() !== null ? true : false;
    }
    
    /**
     * Check if the file exists in the storage or database.
     *
     * @param   $fileName [requested files name]
     *
     * @return bool
     */
    private function fileExists($fileName)
    {
        return $this->existsInStorage($fileName) || $this->existsInDb($fileName) ? true : false;
    }

    /**
     * Save the file from the request to db
     *
     * @param $fileName
     * @param $filePath
     */
    private function saveFile($fileName, $filePath)
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
        $file = request('file');
        $fileName = $file->getClientOriginalName();

        abort_if($this->fileExists($fileName), 400, 'The file already exists in our database records.');

        $this->saveFile($fileName, Storage::putFileAs('labresults', $file, $fileName));

        (new LabResult)->parseAndSave($file);
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
        return $this->where('created_at', '>=', now()->startOfMonth())->count();
                         
    }    

    /**
     * Returns the number of the all uploaded files.
     *
     * @return Integer
     */
    public function getCountAllAttribute()
    {
        return $this->count();
    }
}
