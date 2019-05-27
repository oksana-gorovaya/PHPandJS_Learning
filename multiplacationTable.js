'use strict';
/*Напишите программу, на вход которой даются четыре числа a, b, c и d, каждое в своей строке. Программа должна вывести
фрагмент таблицы умножения для всех чисел отрезка [a;b] на все числа отрезка [c;d].

Числа a, b, c и d являются натуральными и не превосходят 10, a<=b, c<=d.

    Следуйте формату вывода из примера, для разделения элементов внутри строки используйте '\t' — символ табуляции.
    Заметьте, что левым столбцом и верхней строкой выводятся сами числа из заданных отрезков — заголовочные столбец и
строка таблицы.*/
const _ = require("lodash");

const a = 3;
const b = 10;
const c = 5;
const d = 8;

const inputArrayAB = _.range(a, b +1);
const inputArrayCD = _.range(c, d +1);
let rangeString = '';
let stringToFill = '';

inputArrayCD.forEach(function(element){
    rangeString += `\t ${element} \t`
});

console.log(rangeString);

inputArrayAB.forEach(function(value){
    inputArrayCD.forEach(function(item){
        let tempValue = item * value;
        stringToFill += `\t ${tempValue} \t`;
    });

    console.log(`${value} ${stringToFill}`);
    stringToFill = ''
});


