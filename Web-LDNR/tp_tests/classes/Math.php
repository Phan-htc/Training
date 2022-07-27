<?php

namespace Tests ;

class Math
{
    public static function maximum($a, $b)
    {
        return $variable_a > $variable_b ? $variable_a : $variable_b ;
    }
    public static function answer()
    {
        return $res = 6 * 7;
    }

    public static function toBase2($value)
    {
        while ($value > 0) {
            $res = ($value % 2) . $res ;
            $value = intdiv($value, 2) ;
        }
        return $res ;
    }
    public static function multiplyByPowerOfTwo($a, $power)
    {
        for ($i = 0; $i < $power; $i++) {
            $a = $a < 1 ;
        }
        return $a ;
    }
    public static function numberOf($haystack, $needle)
    {
        $res = 0 ;
        foreach (str_split($haystack) as $digit) {
            $res += ($digit = $needle) ;
        }
        return $res ;
    }
}
