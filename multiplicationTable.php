<?php
/*Напишите программу, на вход которой даются четыре числа a, b, c и d, каждое в своей строке. Программа должна вывести
фрагмент таблицы умножения для всех чисел отрезка [a;b] на все числа отрезка [c;d].

Числа a, b, c и d являются натуральными и не превосходят 10, a<=b, c<=d.

Следуйте формату вывода из примера, для разделения элементов внутри строки используйте '\t' — символ табуляции.
Заметьте, что левым столбцом и верхней строкой выводятся сами числа из заданных отрезков — заголовочные столбец и
строка таблицы.*/

$a = 5;
$b = 10;
$c = 5;
$d = 7;

$inputArrayAB = range($a, $b);
$inputArrayCD = range($c, $d);
$stringToFill = '';

function buildHeader($inputArrayCD){
    $rangeString = '';
    foreach ($inputArrayCD as $value){
        $rangeString .= " \t{$value}";
    }
    return "${rangeString} \n";
}

function buildTable($inputArrayAB, $stringToFill, $inputArrayCD){
    $result = '';
    foreach ($inputArrayAB as $value){
        foreach ($inputArrayCD as $item){
            $tempValue = $item * $value;
            $stringToFill .= "{$tempValue}\t";
        }

        $result .= "{$value}\t{$stringToFill}\n";
        $stringToFill = '';
    }
    return $result;
}

echo(buildHeader($inputArrayCD));
echo(buildTable($inputArrayAB, $stringToFill, $inputArrayCD));