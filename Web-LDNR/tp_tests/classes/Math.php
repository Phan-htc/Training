<?php

namespace Tests ;

class Math
{
    public static function maximum($variable_a, $variable_b)
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
            $resTB2 = ($value % 2) . $res ;
            $value = intdiv($value, 2) ;
        }
        return $resTB2 ;
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
        $resNO = 0 ;
        foreach (str_split($haystack) as $digit) {
            $resNO += ($digit = $needle) ;
        }
        return $resNO ;
    }
    public static function qualify($number)
    {
        $sum = 0 ;
            for ($i = 1; $i < $number; $i++) {
                if ($number % $i == 0) {
                    $sum += $i ;
                }
        }

        if ($sum < $number) {
            echo "$number est deficient\n" ;
        } elseif ($sum == $number) {
            echo "$number est parfait\n" ;
        } else {
            echo "$number est abondant\n" ;
        }
    }
}
