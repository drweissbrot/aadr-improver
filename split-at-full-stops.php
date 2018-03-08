<?php

$path = __DIR__ . '/full-text.txt';

$fullText = file_get_contents($path);

$bits = preg_split('/([^\.]\.\)?\s)/', $fullText, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

$sentences = [];

for ($i = 0; $i < count($bits); $i++) {
	if ($i % 2 == 0) {
		$sentences[] = $bits[$i];

		continue;
	}

	$sentences[count($sentences) - 1] .= $bits[$i];
}

for ($i = 0; $i < count($sentences); $i++) {
	$sentence = $sentences[$i];
	$sentence = trim($sentence);

	// $sentence = str_replace("\n", ' ', $sentence);
	$sentence .= '%%NEWLINE';

	if ($sentence === '.') {
		unset($sentences[$i]);

		continue;
	}

	$sentences[$i] = $sentence;
}

file_put_contents(__DIR__ . '/lines.txt', $sentences);
