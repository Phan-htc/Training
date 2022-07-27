<?php

namespace Tests ;

use Psr\Log\AbstractLogger ;

class FileLogger extends AbstractLogger {

    private $filename ;

	public function __construct($filename)
	{
		$this->filename = $filename ;
		touch($this->filename) ;
	}

	public function log($level, $message, array $context = array())
	{
		file_put_contents(
			$this->filename,
			sprintf("[%-9s] %s\n", $loglevel, $message),
			LOCK_EX
			) ;
	}

}