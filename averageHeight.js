/*Дан файл с таблицей в формате TSV с информацией о росте школьников разных классов.
Напишите программу, которая прочитает этот файл и подсчитает для каждого класса средний рост учащегося.
Файл состоит из набора строк, каждая из которых представляет собой три поля:
Класс Фамилия Рост
Класс обозначается только числом. Буквенные модификаторы не используются. Номер класса может быть от 1 до 11
включительно. В фамилии нет пробелов, а в качестве роста используется натуральное число, но при подсчёте среднего
требуется вычислить значение в виде вещественного числа.

Выводить информацию о среднем росте следует в порядке возрастания номера класса (для классов с первого по одиннадцатый).
 Если про какой-то класс нет информации, необходимо вывести напротив него прочерк*/

const fs = require('fs');
const _ = require('lodash');

let studentList;
try {
    studentList = fs.readFileSync('/home/xenia/Завантаження/dataset_3380_5.txt', 'utf8');
} catch(e) {
    throw Error(e.stack);
}
const outputTemplate = createTemplate();
const studentHeightList = getHeight(studentList);
const output = fillTemplate(outputTemplate, studentHeightList);
const formattedOutput = formatOutput(output);

fs.writeFile('/home/xenia/PhpstormProjects/studentsHeight.txt', formattedOutput, (err) => {
    if (err) {
        throw Error('File cannot be written');
    }
    console.log("Successfully Written to File.");
});

function createTemplate()
{
    let studentsTemplate = {};
    for (let form = 1; form <= 11; form++) {
    studentsTemplate[form] = '-';
}

    return studentsTemplate;
}

function getHeight(studentList)
{
    let formHeightArray = [];
    const splittedList = studentList.trim().split("\n");

    splittedList.forEach (function(item){
        let formNumber = [];
        let studentHeight = [];
        const splittedItem = item.split("\t");

        splittedItem.forEach (function(element){
            if (element.match(/[0-9]/)){
                if (element <= 11){
                    formNumber.push(element);
                } else {
                    studentHeight.push(parseInt(element));
                }
            }
        });
        formHeightArray.push(_.zipObject(formNumber, studentHeight));
    });

    return formHeightArray;
}

function fillTemplate(outputTemplate, studentHeightList)
{
    let counter = [];
    Object.values(studentHeightList).forEach(function(item){
        for (let [key, value] of Object.entries(item)){
            if (outputTemplate[key] === '-'){
                outputTemplate[key] = value;
            } else {
                outputTemplate[key] += value;
            }
            counter.push(key);
        }
    });

    const formHeightObject = _.countBy(counter, function(item) {
        return item;
    });

    for (let [key, value] of Object.entries(outputTemplate)){
        if (value !== '-'){
            outputTemplate[key] = value / formHeightObject[key];
            }
     }

    return outputTemplate;
}

function formatOutput(output)
{
    let stringOutput = '';
    for (let [form, averageHeight] of Object.entries(output)){
        stringOutput += form + ': ' + averageHeight + "\n";
}

    return stringOutput;
}

