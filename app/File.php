<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $fillable = ['name', 'file_path'];

    public function upload()
    {
        $file = request()->file('labresult')->store('labresults');

        $this->create([
            'name' => request('labresult')->getClientOriginalName(),
            'file_path' => storage_path('app/labresults' . $file)
        ]);
    }
}
