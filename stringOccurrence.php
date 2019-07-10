<?php
$s = readline();
$t = readline();
$lastPos = 0;
$counter = 0;
var_dump(findOccurrences($s, $t, $lastPos, $counter));

function findOccurrences(string $s, string $t, int $lastPos, int $counter): int
{
    while (($lastPos = strpos($s, $t, $lastPos)) !== false) {
        $counter += 1;
        $lastPos = $lastPos + 1;
    }
    return $counter;
}



