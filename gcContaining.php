<?php
/*Напишите программу, которая вычисляет процентное содержание символов G (гуанин) и C (цитозин) в введенной строке
(программа не должна зависеть от регистра вводимых символов).

Например, в строке "acggtgttat" процентное содержание символов G и C равно 4/10⋅100=40.0, где 4 -- это количество
символов G и C,  а 10 -- это длина строки.*/

$stringToCheck = 'acggtgttat';
$counter = 0;
$gcContaining = 0;
$tempArray = str_split(strtoupper($stringToCheck));

foreach ($tempArray as $element){
    if ($element  === 'G' || $element === 'C'){
        $counter += 1;
    }
}

$gcContaining = $counter / strlen($stringToCheck) * 100;
var_dump($gcContaining);