<?php

namespace App;

use App\Jobs\ParseAndInsert;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class File extends Model
{
	protected $fillable = ['name', 'file_path'];

	//check to see if the requested file matches some other uploaded file by name, if it does - throws an error, if it doesent - uploads the file.

    public function upload()
    {
        $file = request()->file('csv_file');
    	$fileName = $file->getClientOriginalName();

    	if (! Storage::exists("labresults/{$fileName}")) {
	        $path = Storage::putFileAs('labresults', $file, $fileName);

	        $this->create([
	            'name' => request('csv_file')->getClientOriginalName(),
	            'file_path' => storage_path($path)
	        ]); 

            ParseAndInsert::dispatch();

    	} else {
    		
    	return redirect()->back()
 				->withErrors(["The {$fileName} already exists in the storage."]);
    	}
           
    }
}
