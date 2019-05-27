<?php
/*Напишите программу, на вход которой даются четыре числа a, b, c и d, каждое в своей строке. Программа должна вывести
фрагмент таблицы умножения для всех чисел отрезка [a;b] на все числа отрезка [c;d].

Числа a, b, c и d являются натуральными и не превосходят 10, a<=b, c<=d.

Следуйте формату вывода из примера, для разделения элементов внутри строки используйте '\t' — символ табуляции.
Заметьте, что левым столбцом и верхней строкой выводятся сами числа из заданных отрезков — заголовочные столбец и
строка таблицы.*/

$a = 7;
$b = 10;
$c = 3;
$d = 7;

$inputArrayAB = range($a, $b);
$inputArrayCD = range($c, $d);
$rangeString = '';
$stringToFill = '';

foreach ($inputArrayCD as $value){
    $rangeString .= " \t{$value}";
}

var_dump($rangeString);

foreach ($inputArrayAB as $value){
    foreach ($inputArrayCD as $item){
        $tempValue = $item * $value;
        $stringToFill .= "{$tempValue}\t";
    }

    var_dump("{$value}\t{$stringToFill}");
    $stringToFill = '';
}
