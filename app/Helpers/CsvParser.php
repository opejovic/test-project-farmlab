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
		$this->file = Storage::get("labresults/{$file->getClientOriginalName()}");
	}

	/**
	 * Simply returns new instance of CsvParser passing in the file, 
	 * and then calling the arrangeData method.
	 *
	 * @var $file 
	 */
	public static function parse($file)
	{
		return (new self($file))->arrangeData();
	}    

	/**
	 * Combines the first line of the lines collection (making it the keys of the array) 
	 * and the rest of the lines (making them values of the array).
	 * Eg. ['herd_number' => 555555]; 
	 *
	 * @return array
	 */
    private function arrangeData()
    {
        $lines = $this->toCollection();

        return $lines->slice(1, -1)->map(function ($result) use ($lines) {
            return array_combine($lines->first()->all(), $result->all());
        });
    }
	
	/**
	 * Maps the lines of the given csv file to collection. 
	 *
	 * @return collection
	 */
    private function toCollection()
    {
        return collect(explode("\n", $this->file))
            ->map(function ($line) {
                return collect(explode(',', $line));
            });
    }
}
