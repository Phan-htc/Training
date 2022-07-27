<?php

require __DIR__ . '/vendor/autoload.php';

echo Tests\Math::maximum(0, 0) . "\n" ;
echo Tests\Math::maximum(0, 1) . "\n" ;
echo Tests\Math::maximum(1, 0) . "\n" ;
echo Tests\Math::maximum(1, 1) . "\n" ;
