<?php
/*Напишите программу, на вход которой подается одна строка с целыми числами. Программа должна вывести сумму этих чисел.
*/

$userInput = '4 -2 -9';
$tempArr = explode(" ", $userInput);
var_dump(showSum($tempArr));

function showSum($numbersArray)
{
    $inputSum = 0;
    foreach ($numbersArray as $item){
        $inputSum += intval($item);
    }
    return $inputSum;
}


