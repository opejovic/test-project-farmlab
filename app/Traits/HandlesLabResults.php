<?php 

namespace App\Traits;

trait HandlesLabResults
{
	/**
     * Returns the percentage of processed results for the model.
     *
     * @return integer
     */
    public function processedResultsPercentage()
    {
        return number_format(
            ($this->results->filter->isProcessed()->count() / $this->results->count()) * 100
        );        
    }

    /**
     * Returns the percentage of processed results for the model, 
     * if there are any, otherwise returns 0.
     *
     * @return integer
     */
    public function getProcessedResultsPercentageAttribute()
    {   
        return $this->results->count() > 0 ? $this->processedResultsPercentage() : 0;
    }
}
