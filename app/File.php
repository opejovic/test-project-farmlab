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
            return redirect()->back()
                ->withErrors(["The {$fileName} already exists in the storage."]);
        }

        return false;
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
        $filePath = Storage::putFileAs('labresults', $file, $fileName);

        $this->create([
            'name'      => $fileName,
            'file_path' => storage_path($filePath)
        ]);

        (new LabResult)->parseAndSave($file);

        session()->flash('message', 'File successfully uploaded.');
        }
    }
}
