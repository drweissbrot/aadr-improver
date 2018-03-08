<?php

function randomize()
{
	$lines = file_get_contents(__DIR__ . '/lines.txt');

	$sentences = array_filter(explode('%%NEWLINE', $lines));

	shuffle($sentences);

	$string = '';

	for ($i = 0; $i < count($sentences); $i++) {
		$string .= $sentences[$i] . ' ';

		if ($i % 7 == 0) {
			$string .= "\n\n";
		}
	}

	return $string;
}

for ($i = 0; $i < 10; $i++) {
	file_put_contents(__DIR__ . "/randomized/{$i}.txt", randomize());
}
