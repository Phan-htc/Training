<?php

namespace Tests ;

use PHPUnit\Framework\TestCase;
use Tests\AlarmController ;
use Tests\Alarm ;

class AlarmControllerTest extends TestCase
{
	
	public function testConstructor1() {
		$mock = $this->createMock(Alarm::class) ;
		$ctrl = new AlarmController($mock, 10, 12) ;
		
		$this->assertTrue(true) ;
	}
		
	public function testIsOn1() {
		$mock = $this->createMock(Alarm::class) ;
		$mock->method("isOn")->willReturn(false) ;
		$ctrl = new AlarmController($mock, 10, 12) ;
		
		$this->assertFalse($ctrl->isOn()) ;
	}
	
	public function testNotifyOffHigher() {
		$mock = $this->createMock(Alarm::class) ;
		$mock->method("isOn")->willReturn(false) ;
		$mock->expects($this->once())->method('on') ;
		$mock->expects($this->never())->method('off') ;

		$ctrl = new AlarmController($mock, 10, 12) ;
		$ctrl->notify(13) ;
	}

}