<?php

if (!function_exists("ordinalize"))
{
	function ordinalize($num)
	{
		// https://stackoverflow.com/questions/3109978/php-display-number-with-ordinal-suffix
		$ends = array('th','st','nd','rd','th','th','th','th','th','th');
		if (($num %100) >= 11 && ($num%100) <= 13)
		   $abbreviation = $num. 'th';
		else
		   $abbreviation = $num. $ends[$num % 10];

		return $abbreviation;
	}
}
