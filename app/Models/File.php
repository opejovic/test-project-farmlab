<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class File extends Model
{
    protected $fillable = ['name', 'file_path'];


    /**
     * @param   $fileName [requested files name]
     * Check if the file exists in the storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function fileExists($fileName)
    {
        if (Storage::exists("labresults/{$fileName}")) {
            return back()->withErrors(["The {$fileName} already exists in the storage."]);
        }

        return false;
    }

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

        if (! $this->fileExists($fileName)) {

        $this->saveToDb($fileName, Storage::putFileAs('labresults', $file, $fileName));

        (new LabResult)->parseAndSave($file);

        session()->flash('message', 'File successfully uploaded.');
        }

    }
}
