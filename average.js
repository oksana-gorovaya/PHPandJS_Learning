'use strict';
/*Напишите программу, которая считывает с клавиатуры два числа a и b, считает и выводит на консоль среднее
арифметическое всех чисел из отрезка [a;b], которые делятся на 3.

В приведенном ниже примере среднее арифметическое считается для чисел на отрезке [−5;12]. Всего чисел, делящихся на 3,
    на этом отрезке 6: −3,0,3,6,9,12. Их среднее арифметическое равно 4.5

На вход программе подаются интервалы, внутри которых всегда есть хотя бы одно число, которое делится на 3.﻿*/
const _ = require("lodash");

const firstNumber = 4;
const secondNumber = 7;
console.log(calculateAverage(firstNumber, secondNumber));

function calculateAverage(firstNumber, secondNumber){
    const range = _.range(firstNumber, secondNumber + 1);
    let counter = 0;
    let numbersSum = 0;

    range.forEach(function(element){
        if (element % 3 === 0){
            counter += 1;
            numbersSum += element;
        }
    });
    return numbersSum / counter
}
