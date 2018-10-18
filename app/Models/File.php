<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class File extends Model
{
    protected $fillable = ['name', 'file_path'];

    /**
     * Check if the file exists in the storage.
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
            'name'      => $fileName,
            'file_path' => storage_path($filePath)
        ]);
    }

    /**
     * Upload the file from the request to storage (if its not a duplicate),
     * and then trigger the LabResult parseAndSave method.
     */
    public function upload()
    {
        $file = request('csv_file');
        $fileName = $file->getClientOriginalName();

        if ($this->existsInDb($fileName)) {
            return back()->withErrors(["The {$fileName} already exists in our database records."]);
        }

        if ($this->existsInStorage($fileName)) {
            return back()->withErrors(["The {$fileName} already exists in the storage."]);
        }

        $this->saveToDb($fileName, Storage::putFileAs('labresults', $file, $fileName));

        (new LabResult)->parseAndSave($file);

        session()->flash('message', 'File successfully uploaded.');
    }
}
