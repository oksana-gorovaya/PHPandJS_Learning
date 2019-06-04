<?php
/*Напишите программу, на вход которой подаётся список чисел одной строкой. Программа должна для каждого элемента этого
списка вывести сумму двух его соседей. Для элементов списка, являющихся крайними, одним из соседей считается элемент,
находящий на противоположном конце этого списка. Например, если на вход подаётся список "1 3 5 6 10", то на выход
ожидается список "13 6 9 15 7" (без кавычек).
Если на вход пришло только одно число, надо вывести его же.

Вывод должен содержать одну строку с числами нового списка, разделёнными пробелом.*/

$userInput = "1 3 5 6 10";
$transformedUserInput = explode(" ", $userInput);

function showNeighboursSum($numbersArray)
{
    $userOutput = [];

    if (count($numbersArray) === 1) {
        array_push($userOutput, $numbersArray[0]);
    } else {
        for ($counter = 0; $counter < count($numbersArray); $counter++) {
            if ($counter === 0) {
                $neighboursSum = $numbersArray[1] + end($numbersArray);
            } elseif ($counter === (count($numbersArray) - 1)) {
                $neighboursSum = $numbersArray[$counter - 1] + $numbersArray[0];
            } else {
                $neighboursSum = $numbersArray[$counter + 1] + $numbersArray[$counter - 1];
            }

            array_push($userOutput, $neighboursSum);
        }
    }

    return implode(' ', $userOutput);
}



var_dump(showNeighboursSum($transformedUserInput));