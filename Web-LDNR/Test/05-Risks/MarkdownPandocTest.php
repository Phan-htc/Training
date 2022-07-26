<?php

namespace Tests ;

use PHPUnit\Framework\TestCase;

class MarkdownPandocTest extends TestCase
{
    public function testH1()
    {
		$converter = new MarkdownPandoc() ;
        $this->assertEquals('<h1 id="titre">titre</h1>' . "\n", $converter->toHtml("# titre")) ;
    }
}
