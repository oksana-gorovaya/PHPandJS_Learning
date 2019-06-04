/*Напишите программу, на вход которой подаётся список чисел одной строкой. Программа должна для каждого элемента этого
списка вывести сумму двух его соседей. Для элементов списка, являющихся крайними, одним из соседей считается элемент,
находящий на противоположном конце этого списка. Например, если на вход подаётся список "1 3 5 6 10", то на выход
ожидается список "13 6 9 15 7" (без кавычек).
Если на вход пришло только одно число, надо вывести его же.

Вывод должен содержать одну строку с числами нового списка, разделёнными пробелом.*/

const userInput = "1 3 5 6 10";
const transformedUserInput = userInput.split(" ");

function showNeighboursSum() {

        let userOutput = [];

        if (userInput.length === 1) {
            return userInput;
        }
        for (let counter = 0; counter < transformedUserInput.length; counter++) {

            if (counter === 0) {
                neighboursSum = +transformedUserInput[1] + +transformedUserInput[transformedUserInput.length - 1]

            } else if (counter === (transformedUserInput.length) - 1) {
                neighboursSum = +transformedUserInput[counter - 1] + +transformedUserInput[0]

            } else {
                neighboursSum = +transformedUserInput[counter + 1] + +transformedUserInput[counter - 1]
            }

            userOutput.push(neighboursSum);
        }
        return userOutput.join(" ")
    }

console.log(showNeighboursSum());