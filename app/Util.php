<?php
namespace App;

class Util
{	
    public function __construct() {
    }

    public function getTitle($url) {
    	$str = file_get_contents($url);
  		if(strlen($str)>0){
    	$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
    	preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
    	return $title[1];
  }
    }
}
// test 
//$util = new Util();
//echo $util->getTitle("http://www.washingtontimes.com/");