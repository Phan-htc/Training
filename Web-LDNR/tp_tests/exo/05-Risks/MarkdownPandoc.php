<?php

namespace Tests ;

class MarkdownPandoc implements Markdown
{
    public function __construct()
    {
		if (shell_exec("pandoc --version") == "") {
			throw new \Exception("Pandoc is not available") ;
		}
    }

    public function toHtml($markdown)
    {
        return shell_exec("echo " . escapeshellarg($markdown) . " | pandoc --from markdown --to html5") ;
    }
}
