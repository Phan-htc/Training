<?php

namespace Tests ;

class MarkdownOnline implements Markdown
{

	private $handler ;
	
	public function __construct() {
		$this->handler = curl_init() ;
		curl_setopt_array($this->handler, [
			CURLOPT_PROTOCOLS      => CURLPROTO_HTTPS,
			CURLOPT_RETURNTRANSFER => true,
		]) ;
	}
	
	public function __destruct() {
		curl_close($this->handler);
	}
	
	public function toHtml($markdown)
    {
		$url  = "https://pandoc.org//cgi-bin/trypandoc" ;
		$url .= "?text=" . urlencode($markdown) ;
		$url .= "&from=markdown" ;
		$url .= "&to=html5" ;
		$url .= "&standalone=0" ;
		
		curl_setopt($this->handler, CURLOPT_URL, $url );
		$json = curl_exec($this->handler); 
		
		$data = json_decode($json) ;
				
        return $data->html ;
    }
}
