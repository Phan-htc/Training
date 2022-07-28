<?php

namespace Tests ;

use PHPUnit\Framework\TestCase;

class PassTest extends TestCase
{
    public function estFortProvider()
    {
        return [
            ["", "Faible"],
            ["ICNUOJebAEODJptajPYRWKa9XgXUhx73m", "Fort"],
        ] ;
    }

    /**
     * @dataProvider estFortProvider
     */
    public function testEstFort($motdepasse, $expected)
    {
        $this->assertEquals($expected, Pass::estFort($motdepasse));
    }
}
