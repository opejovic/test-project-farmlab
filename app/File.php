<?php

namespace App;

use App\LabResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class File extends Model
{
	protected $fillable = ['name', 'file_path'];

    public function upload()
    {
        $file = request('csv_file');
    	$fileName = $file->getClientOriginalName();

    	if (! Storage::exists("labresults/{$fileName}")) {
	        $filePath = Storage::putFileAs('labresults', $file, $fileName);

	        $this->create([
	            'name' => $fileName,
	            'file_path' => storage_path($filePath)
	        ]); 
            
            LabResult::parseAndSave($file);

    	} else {
    		
    	return redirect()->back()
 				->withErrors(["The {$fileName} already exists in the storage."]);
    	}
        
        session()->flash('message', 'File successfully uploaded.');
    
    }
}
