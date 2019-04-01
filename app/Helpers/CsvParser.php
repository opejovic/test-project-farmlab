<?php

namespace App\Helpers;

use App\Models\Practice;
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
	 * Maps the first array of the collection as keys (eg. 'herd_number', 'lab_code') 
	 * and the rest of the collections arrays as values (results, eg. '555555', '123456') 
	 * into an associative array.
	 * Eg. ['herd_number' => 555555, 'lab_code' => 123456 ... ];
	 *	    
	 * After that merges the array with the practice name 
	 * using mergePracticeName method.
	 * 
	 * @return array
	 */
    private function toAssocArray()
    {
        $lines = $this->toCollection();

        return $lines->slice(1)->map(function ($result) use ($lines) {
            return $lines->first()->combine($result);
        })->pipe([$this, 'mergePracticeName']);
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

    /**
     * Adds the practice_name (key, value pair) to the array based on the practice_id field.
     *
     * @return array
     */
    public function mergePracticeName($results)
    {
        return $results->map(function ($result) {
            return $result->merge([
                'practice_name' => Practice::name($result['practice_id'])
            ])->all();
        });
    }
}
