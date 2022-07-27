<?php

namespace Tests ;

class AlarmController {
	
	private $alarm ;
	private $low ;
	private $high ;
	
	public function __construct(Alarm $alarm, $low, $high)
	{
		$this->alarm = $alarm ;
		$this->low   = $low    ;
		$this->high  = $high   ;
	}
	
	public function isOn() {
		return $this->alarm->isOn() ;
	}
	
	public function notify($noise)
	{
		if ($this->alarm->isOn()) {
			if ($noise < $this->high) {
				$this->alarm->off() ;
			}
		} else {
			if ($noise > $this->low) {
				$this->alarm->on() ;
			}
		}
	}
	

}