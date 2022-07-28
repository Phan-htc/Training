<?php

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testMaximum()
    {
        $this->assertEquals(0, Tests\Math::maximum(0, 0));
        $this->assertEquals(1, Tests\Math::maximum(0, 1));
        $this->assertEquals(1, Tests\Math::maximum(1, 0));
        $this->assertEquals(1, Tests\Math::maximum(1, 1));
    }

    public function testAnswer() {
	    $this->assertEquals(42, Tests\Math::answer()) ;
    }

    public function testToBase2() {
	$this->assertEquals("0", Tests\Math::toBase2(0), "Valeur 0 => 0") ;
	$this->assertEquals("1", Tests\Math::toBase2(1), "Valeur 1 => 1") ;
	$this->assertEquals("10", Tests\Math::toBase2(2)) ;
	$this->assertEquals("11", Tests\Math::toBase2(3)) ;

    }

    public function testMultiplyBy2() {
	    $this->assertEquals(2, Tests\Math::multiplyByPowerOfTwo(1, 1)) ;
	    $this->assertEquals(4, Tests\Math::multiplyByPowerOfTwo(1, 2)) ;
	    $this->assertEquals(6, Tests\Math::multiplyByPowerOfTwo(3, 1)) ; // 6 = 3 * 2^1
    }

    public function testUCFirst() {
	    $this->assertEquals("",   Tests\Math::UCFirst("")) ;
	    $this->assertEquals("A",  Tests\Math::UCFirst("A")) ;
	    $this->assertEquals("A",  Tests\Math::UCFirst("a")) ;
	    $this->assertEquals("Aa", Tests\Math::UCFirst("AA")) ;
	    $this->assertEquals("Aa", Tests\Math::UCFirst("aa")) ;
	    $this->assertEquals("Aa", Tests\Math::UCFirst("AA")) ;
    }
    public function testCasTresParticulier() {
        if (! $this->checkCasTresParticulier()) {
            $this->markTestSkipped(
                'The MySQLi extension is not available.'
            );
        }
    }
    
}
