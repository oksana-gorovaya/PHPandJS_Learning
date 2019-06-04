/*Напишите программу, которая принимает на вход список чисел в одной строке и выводит на экран в одну строку значения,
которые повторяются в нём более одного раза.

    Для решения задачи может пригодиться метод sort списка.

    Выводимые числа не должны повторяться, порядок их вывода может быть произвольным.*/

const userInput = '22 22 22 3 4 4 4 4 4 3 0 0 -2 -2';
const transformedInput = userInput.split(" ");

function transformInput()
{
    let sampleArray = [];
    let userOutput = [];
    transformedInput.forEach(function (item) {
        if(sampleArray.includes(item)) {
            if(!userOutput.includes(item)){
                userOutput.push(item);
            }
        }
        sampleArray.push(item);
    });
    return userOutput.join(" ");

}

console.log(transformInput());
