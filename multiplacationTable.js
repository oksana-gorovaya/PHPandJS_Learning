'use strict';
/*Напишите программу, на вход которой даются четыре числа a, b, c и d, каждое в своей строке. Программа должна вывести
фрагмент таблицы умножения для всех чисел отрезка [a;b] на все числа отрезка [c;d].

Числа a, b, c и d являются натуральными и не превосходят 10, a<=b, c<=d.

    Следуйте формату вывода из примера, для разделения элементов внутри строки используйте '\t' — символ табуляции.
    Заметьте, что левым столбцом и верхней строкой выводятся сами числа из заданных отрезков — заголовочные столбец и
строка таблицы.*/
const _ = require("lodash");

const a = 5;
const b = 10;
const c = 5;
const d = 7;
const inputArrayCD = _.range(c, d + 1);
const inputArrayAB = _.range(a, b + 1);
let stringToFill = '';

function buildHeader(){
    let rangeString = '';
    inputArrayCD.forEach(function(element){
        rangeString += `\t${element}`
    });
    return rangeString
}

function buildTable(){
    let result = '';
    inputArrayAB.forEach(function(value){
        inputArrayCD.forEach(function(item){
            let tempValue = item * value;
            stringToFill += `${tempValue}\t`;
        });

        result += `${value}\t${stringToFill} \n`;
        stringToFill = ''
    });
    return result
}

console.log(buildHeader());
console.log(buildTable());

