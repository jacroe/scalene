<?php

if (!function_exists("pluralize"))
{
	function pluralize($count, $singlular, $plural = null)
	{
		if ($plural)
			return ($count == 1) ? $singlular : $plural;
		else
			return ($count == 1) ? $singlular : $singlular."s";
	}
}

if (!function_exists("camelize"))
{
	function camelize($str)
	{
		return strtolower($str[0]).substr(str_replace(' ', '', ucwords(preg_replace('/[\s_]+/', ' ', $str))), 1);
	}
}

// https://stackoverflow.com/a/9074663
if (!function_exists("oxford_comma"))
{
	function oxford_comma(array $array, $conjunction = null)
	{
		if (is_null($conjunction)) {
			return implode(', ', $array);
		}

		$arrayCount = count($array);

		switch ($arrayCount) {

			case 1:
				return $array[0];
				break;

			case 2:
				return $array[0] . ' ' . $conjunction . ' ' . $array[1];
		}

		// 0-index array, so minus one from count to access the
		//  last element of the array directly, and prepend with
		//  conjunction
		$array[($arrayCount - 1)] = $conjunction . ' ' . end($array);

		// Now we can let implode naturally wrap elements with ','
		//  Space is important after the comma, so the list isn't scrunched up
		return implode(', ', $array);
	}
}

# https://www.php.net/manual/en/function.nl2br.php#73440
if (!function_exists("nl2br_replace"))
{
	function nl2br_replace($str, $use_xhtml = true)
	{
		if ($use_xhtml)
			$replacement = "<br />";
		else
			$replacement = "<br>";

		return str_replace(array("\r\n", "\r", "\n"), $replacement, $str);
	}
}
