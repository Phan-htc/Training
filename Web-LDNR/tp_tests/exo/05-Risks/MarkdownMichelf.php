<?php

namespace Tests ;

use Michelf\Markdown as Michelf;

class MarkdownMichelf implements Markdown
{
    public function toHtml($markdown)
    {
        return Michelf::defaultTransform($markdown) ;
    }
}
