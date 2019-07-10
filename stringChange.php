<?php
$mainString = readline();
$firstString = readline();
$secondString = readline();
$counter = 0;
var_dump(countChanges($mainString, $firstString, $secondString, $counter));

function countChanges(string $mainString, string $firstString, string $secondString, int $counter)
{
    if (strpos($mainString, $firstString) !== false){
        $counter += 1;
        if ($counter < 1000) {
            return countChanges(str_replace($firstString, $secondString, $mainString), $firstString, $secondString, $counter);
        }
        return 'Impossible';
    } else {
        return $counter;
    }
}



