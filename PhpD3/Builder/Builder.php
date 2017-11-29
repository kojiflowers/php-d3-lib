<?php namespace PhpD3\Builder;

class Builder
{
    protected $prepData;

    public function __construct()
    {
        $this->prepData = new DataPrep();

    }
}