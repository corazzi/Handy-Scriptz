<?php
class EmailHelper
{
    public static function encodeEmail($email='contact@yoursite.com', $linkText='Contact Us', $attrs ='class="encoded_email"' )
    {
    	$email = str_replace('@', '@', $email);
    	$email = str_replace('.', '.', $email);
    	$email = str_split($email, 5);
    
    	$linkText = str_replace('@', '@', $linkText);
    	$linkText = str_replace('.', '.', $linkText);
    	$linkText = str_split($linkText, 5);
    	
    	$part1 = '<a href="ma';
    	$part2 = 'ilto:';
    	$part3 = '" '. $attrs .' >';
    	$part4 = '</a>';
    
    	$encoded = '<script type="text/javascript">';
    	$encoded .= "document.write('$part1');";
    	$encoded .= "document.write('$part2');";
    	foreach($email as $e)
    	{
    			$encoded .= "document.write('$e');";
    	}
    	$encoded .= "document.write('$part3');";
    	foreach($linkText as $l)
    	{
    			$encoded .= "document.write('$l');";
    	}
    	$encoded .= "document.write('$part4');";
    	$encoded .= '</script>';
    
    	return $encoded;
    }
}
