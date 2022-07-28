<?php

namespace Tests ;

use PHPUnit\Framework\TestCase ;
use Psr\Log\LogLevel ;

class FileLoggerTest extends TestCase
{
	
	private const FILENAME = "/tmp/log.txt" ;
	
    public function testFileCreated()
    {
		$logger = new FileLogger(self::FILENAME) ;
		
        $this->assertFileExists(self::FILENAME) ;
		
		unset($logger) ;
		unlink(self::FILENAME) ;
    }
	
	public function levelProvider() {
		return [
			[LogLevel::EMERGENCY, "Hello", "[emergency] Hello\n" ],
			[LogLevel::ALERT    , "Hello", "[alert    ] Hello\n" ],
			[LogLevel::CRITICAL , "Hello", "[critical ] Hello\n" ],
			[LogLevel::ERROR    , "Hello", "[error    ] Hello\n" ],
			[LogLevel::WARNING  , "Hello", "[warning  ] Hello\n" ],
			[LogLevel::NOTICE   , "Hello", "[notice   ] Hello\n" ],
			[LogLevel::INFO     , "Hello", "[info     ] Hello\n" ],
			[LogLevel::DEBUG    , "Hello", "[debug    ] Hello\n" ],
		] ;
	}
	
	/**
	 * @dataProvider levelProvider
	 */
	public function testLevel($level, $message, $expected) {
		$logger = new FileLogger(self::FILENAME) ;
		
        $logger->log($level, $message) ;
		
		$content = file_get_contents(self::FILENAME) ;
		$this->assertSame($expected, $content) ;
		
		unset($logger) ;
		unlink(self::FILENAME) ;
	}
}
