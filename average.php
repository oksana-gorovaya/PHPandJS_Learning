<?php
/*Напишите программу, которая считывает с клавиатуры два числа a и b, считает и выводит на консоль среднее
арифметическое всех чисел из отрезка [a;b], которые делятся на 3.

В приведенном ниже примере среднее арифметическое считается для чисел на отрезке [−5;12]. Всего чисел, делящихся на 3,
    на этом отрезке 6: −3,0,3,6,9,12. Их среднее арифметическое равно 4.5

На вход программе подаются интервалы, внутри которых всегда есть хотя бы одно число, которое делится на 3.﻿*/

$firstNumber = 1;
$secondNumber = 7;
var_dump(calculateAverage($firstNumber, $secondNumber));

function calculateAverage($firstNumber, $secondNumber){
    $range = range($firstNumber, $secondNumber +1);
    $amount = 0;
    $numbersSum = 0;

    foreach ($range as $element){
        if ($element % 3 === 0){
            $amount += 1;
            $numbersSum += $element;
        }
    }
    return $numbersSum / $amount;
}