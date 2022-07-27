<?php

use PHPUnit\Framework\TestCase;
use Tests\PileTableau ;

class PileTableauTest extends TestCase
{

	public function testPileCreeeEstVide() {
		$pile = new PileTableau() ;
		$this->assertTrue($pile->empty()) ;
	}

	public function testApresPushPilePlusVide() {
		$pile = new PileTableau() ;
		$pile->push("hello world") ;
		$this->assertFalse($pile->empty()) ;
	}

	public function testPopSurPileVideLeveException() {
		$this->expectException(Exception::class);
		$pile = new PileTableau() ;
		$valeur = $pile->pop() ;
	}

	public function testHeadSurPileVideLeveException() {
                $this->expectException(Exception::class);
                $pile = new PileTableau() ;
                $valeur = $pile->head() ;
        }

	public function testPopApresPushRendLaPileVide() {
		$pile = new PileTableau() ;
		$pile->push("Bonjour") ;
		$bonjour = $pile->pop() ;

		$this->assertTrue($pile->empty()) ;
	}

	public function testCanNotPopTwice() {
		$this->expectException(Exception::class);
		$pile = new PileTableau() ;
		$pile->push("Bonjour") ;
		$pile->pop() ;
		$pile->pop() ;
	}

	public function testCanHeadTwice() {
		$pile = new PileTableau() ;
                $pile->push("Bonjour") ;
                $pile->head() ;
		$pile->head() ;

		$this->assertTrue(true) ;
	}

	public function testPopReturnPushedValue() {
		$pile = new PileTableau() ;
                $pile->push("Bonjour") ;
                $popedvalue = $pile->pop() ;

                $this->assertEquals("Bonjour", $popedvalue) ;
	}

	public function testTwoPushThenTwoPop() {
		$pile = new PileTableau() ;
		$pile->push("Première") ;
		$pile->push("Deuxième") ;

		$this->assertEquals("Deuxième", $pile->pop()) ;
		$this->assertEquals("Première", $pile->pop()) ;
	}

	public function testHeadTwiceAfterPush() {
		$pile = new PileTableau() ;
		$pile->push("Bonjour") ;

		$this->assertEquals("Bonjour", $pile->head()) ;
		$this->assertEquals("Bonjour", $pile->head()) ;
        }

	public function testHeadTwiceAfterTwoPush() {
		$pile = new PileTableau() ;
		$pile->push("Première") ;
                $pile->push("Bonjour") ;

                $this->assertEquals("Bonjour", $pile->head()) ;
                $this->assertEquals("Bonjour", $pile->head()) ;
        }

	public function testDebug() {
		$this->expectOutputString("[]\n") ;
		$pile = new PileTableau() ;
		$pile->debug() ;
	}

	public function testDebug1() {
		$this->expectOutputString("[1]\n") ;
		$pile = new PileTableau() ;
		$pile->push(1) ;
                $pile->debug() ;
	}

	public function testDebug2() {
                $this->expectOutputString("[1, 2]\n") ;
                $pile = new PileTableau() ;
		$pile->push(1) ;
		$pile->push(2) ;
                $pile->debug() ;
        }


}
