<?php

namespace App\Support;

class Math
{
    private $base = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * Convert from base 10 to another base.
     *
     * @param  int     $value
     * @param  int     $base
     * @return string
     */
    public function toBase($value, $b = 62)
    {
        $r = $value  % $b;
        $result = $this->base[$r];
        $q = floor($value / $b);
        while ($q)
        {
            $r = $q % $b;
            $q = floor($q / $b);
            $result = $this->base[$r].$result;
        }
        return $result;
    }

}
