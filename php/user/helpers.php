<?php
function isbn10_from_isbn13($isbn13) {
	if (!is_string($isbn13)) {
		return "Is not string, yo.";
	}

	$isbn13 = trim($isbn13);
	$isbn13 = str_replace("-", "", $isbn13);

	if (strlen($isbn13) !== 13) {
		return "String was of wrong length.";
	}

	$isbn10 = substr($isbn13, 3, -1);

	$digits_string = str_split($isbn10);
	$digits = array();

	foreach ($digits_string as $digit) {
		array_push($digits, intval($digit));
	}

	$sum = 0;
	for ($i = 0, $j = 10; $i < count($digits); $i++, $j--) {
		$sum += $digits[$i] * $j;
	}

	$checksum = 11 - ($sum % 11);
	$checksum %= 11;

	if ($checksum === 10) {
		$checksum = "X";
	}

	return "{$isbn10}{$checksum}";
}

function isbn13_from_isbn10($isbn10) {
	if (!is_string($isbn10)) {
		return "Is not string.";
	}

	$isbn10 = trim($isbn10);
	$isbn10 = str_replace("-", "", $isbn10);
	
	$isbn = substr($isbn10, 0, -1);
	$isbn13 = "978{$isbn}";

	if (strlen($isbn13) != 12) {
		return "Wrong amount of characters.";
	}

	$digits_string = str_split($isbn13);
	$digits = array();
	
	foreach ($digits_string as $digit) {
		array_push($digits, intval($digit));
	}

	$sum = 0;
	for ($i = 0; $i < count($digits); $i++) {
		if ($i % 2 == 0) {
			$sum += $digits[$i];
		}
		else {
			$sum += 3 * $digits[$i];
		}
	}

	$checksum = 10 - ($sum % 10);

	return "{$isbn13}{$checksum}";
}
?>