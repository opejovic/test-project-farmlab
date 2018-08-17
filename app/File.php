<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
	protected $fillable = ['name', 'file_path'];

    public function upload()
    {
        $file = Storage::putFile('labresults', request()->file('labresult'));

        $this->create([
            'name' => request('labresult')->getClientOriginalName(),
            'file_path' => storage_path($file)
        ]);

    }
}
