'use strict';
/*Напишите программу, которая вычисляет процентное содержание символов G (гуанин) и C (цитозин) в введенной строке
(программа не должна зависеть от регистра вводимых символов).

Например, в строке "acggtgttat" процентное содержание символов G и C равно 4/10⋅100=40.0, где 4 -- это количество
символов G и C,  а 10 -- это длина строки.*/

const stringToCheck = 'acggtgtggtat';
console.log(calculateGC(stringToCheck));

function calculateGC(stringToCheck){
    let counter = 0;
    let tempArray = stringToCheck.toLowerCase().split('');
    tempArray.forEach(function(element){
        if (element === 'g' || element === 'c'){
            counter += 1;
        }
    });

    return counter / stringToCheck.length * 100;
}
