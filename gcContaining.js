'use strict';
/*Напишите программу, которая вычисляет процентное содержание символов G (гуанин) и C (цитозин) в введенной строке
(программа не должна зависеть от регистра вводимых символов).

Например, в строке "acggtgttat" процентное содержание символов G и C равно 4/10⋅100=40.0, где 4 -- это количество
символов G и C,  а 10 -- это длина строки.*/

const stringToCheck = 'acggtgtggtat';
let counter = 0;
let gcContaining;
let tempArray = stringToCheck.toUpperCase().split('');

tempArray.forEach(function(element){
    if (element === 'G' || element === 'C'){
        counter += 1;
    }
});

gcContaining = counter / stringToCheck.length * 100;
console.log(gcContaining);