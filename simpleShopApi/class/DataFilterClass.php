<?php

declare(strict_types=1);

class DataFilter
{
    public static function filterInteger(string $dataToFilter) : int 
    {
        return (int) filter_var($dataToFilter, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function filterString(string $dataToFilter) : string 
    {
        return (string) filter_var($dataToFilter, FILTER_SANITIZE_STRING);
    }
}
