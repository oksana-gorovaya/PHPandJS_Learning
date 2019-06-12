'use strict';
/*Имеется файл с данными по успеваемости абитуриентов. Он представляет из себя набор строк, где в каждой строке
записана следующая информация:

Фамилия;Оценка_по_математике;Оценка_по_физике;Оценка_по_русскому_языку

Поля внутри строки разделены точкой с запятой, оценки — целые числа.
Напишите программу, которая считывает файл с подобной структурой и для каждого абитуриента выводит его среднюю оценку
по этим трём предметам на отдельной строке, соответствующей этому абитуриенту.
Также в конце файла, на отдельной строке, через пробел запишите средние баллы по математике, физике и русскому языку по
всем абитуриентам:
Примечание. Для разбиения строки на части по символу ';' можно использовать метод split следующим образом:

print('First;Second-1 Second-2;Third'.split(';'))
# ['First', 'Second-1 Second-2', 'Third']*/

const fs = require('fs');
const _ = require('lodash');
let inputFile;

try {
    inputFile = fs.readFileSync('/home/xenia/Завантаження/dataset_3363_4 (1).txt', 'utf8');

} catch(e) {
    throw new Error("Cannot read file");
}

const inputData = inputFile.trim().split("\n");
const studentsGradesList = separateStudents(inputData);
const averagePerStudent = findAverageGrade(studentsGradesList);
const averagePerSubject = findAveragePerSubject(studentsGradesList);
fs.writeFile('/home/xenia/PhpstormProjects/gradesJS.txt', averagePerStudent + averagePerSubject, (err) => {
    if (err) {
        throw Error('File cannot be written')
    }
    console.log("Successfully Written to File.");
});

function separateStudents(inputData)
{
    let studentsList = [];
    inputData.forEach(function (item) {
        studentsList.push(item.split(";"))
    });

    return removeName(studentsList);
}

function removeName(studentsList)
{
    studentsList.forEach(function (item) {
        item.shift();
    });

    return studentsList;
}

function findAverageGrade(studentsGradesList)
{
    let arr = [];
    let counter = 0;
    studentsGradesList.forEach(function (item) {
        let grades = 0;
        item.forEach(function (element) {
            grades += parseInt(element);
            counter = item.length;
        });
        let average = grades / counter;
        arr.push(average+"\n");
    });

    return arr.join('');
}

function findAveragePerSubject(studentsGradesList)
{
    let mathGrades = [];
    let physicsGrades = [];
    let languageGrades = [];
    studentsGradesList.forEach(function (item) {
        mathGrades.push(parseInt(item[0]));
        physicsGrades.push(parseInt(item[1]));
        languageGrades.push(parseInt(item[2]));
    });
    const averageMath = _.sum(mathGrades) / mathGrades.length;
    const averagePhysics = _.sum(physicsGrades) / physicsGrades.length;
    const averageLanguage = _.sum(languageGrades) / languageGrades.length;

    return averageMath + " " + averagePhysics + " " + averageLanguage;
}