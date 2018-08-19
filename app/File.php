<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class File extends Model
{
	protected $fillable = ['name', 'file_path'];

    public function upload()
    {
        $path = Storage::putFile('labresults', request()->file('csv_file'));

        $this->create([
            'name' => request('csv_file')->getClientOriginalName(),
            'file_path' => storage_path($path)
        ]);        
    }
}
