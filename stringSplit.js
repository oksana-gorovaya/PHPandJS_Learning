/*Напишите программу, на вход которой подается одна строка с целыми числами. Программа должна вывести сумму этих чисел.
*/

const userInput = '3 7 20 -8';
let tempArr = userInput.split(" ");
console.log(showSum());

function showSum()
{
    let inputSum = 0;
    tempArr.forEach(function (item) {
        inputSum += +item;
    });
    return inputSum
}

