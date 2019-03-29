<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class CsvParser
{
	private $file;

	/**
     * Create a new class instance.
     *
     * @return void
     */
	private function __construct($file)
	{
		$this->file = trim(Storage::get("labresults/{$file->getClientOriginalName()}"));
	}

	/**
	 * Simply returns new instance of CsvParser passing in the file, 
	 * and then calls the toAssocArray method.
	 *
	 * @var $file
	 */
	public static function parse($file)
	{
		return (new self($file))->toAssocArray();
	}    

	/**
	 * Combines the first line (header, eg. 'herd_number') of the lines collection 
	 * and the rest of the lines (results, eg. '555555') into an associative array.
	 * Eg. ['herd_number' => 555555]; 
	 *
	 * @return array
	 */
    private function toAssocArray()
    {
        $lines = $this->toCollection();

        return $lines->slice(1)->map(function ($result) use ($lines) {
            return $lines->first()->combine($result)->all();
        });
    }
	
	/**
	 * Maps the lines of the given csv file to collection. 
	 *
	 * @return collection
	 */
    private function toCollection()
    {
        return collect(explode("\n", $this->file))->map(function ($line) {
            return collect(explode(',', $line));
        });
    }
}
