<?php

namespace Tests ;

use PHPUnit\Framework\TestCase;

class MarkdownOnlineTest extends TestCase
{

    public function testH1()
    {
		$converter = new MarkdownOnline() ;
		$this->assertEquals('<h1 id="titre">titre</h1>' . "\n", $converter->toHtml("# titre")) ;
    }
}
