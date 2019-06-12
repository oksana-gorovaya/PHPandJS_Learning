<?php
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

$inputFile = file_get_contents('/home/xenia/Завантаження/dataset_3363_4 (1).txt');
$inputData = explode("\n", trim($inputFile));

if (!$inputData){
    throw new Exception("cannot read file");
}

$studentsGradesList = separateStudents($inputData);
$averagePerStudent = findAverageGrade($studentsGradesList);
$averagePerSubject = findAveragePerSubject($studentsGradesList);
$output_file = file_put_contents('/home/xenia/PhpstormProjects/grades.txt', $averagePerStudent.$averagePerSubject);

function separateStudents($inputData)
{
    $studentsList = [];
    foreach($inputData as $item){
        array_push($studentsList, explode(';',$item));
    }
    return removeName($studentsList);
}

function removeName($studentsList)
{
    foreach ($studentsList as $key => $item){
        unset($studentsList[$key][0]);
    }

    return $studentsList;
}

function findAverageGrade($studentsGradesList)
{
    $arr = [];
    foreach ($studentsGradesList as $item){
        $grades = 0;
        $counter = count($item);
        foreach ($item as $element){
            $grades += $element;
            $counter = count($item);
        }
        $average = round(($grades / $counter), 11);
        array_push($arr, $average."\n");
    }

    return implode($arr);
}

function findAveragePerSubject($studentsGradesList)
{
    $mathGrades = [];
    $physicsGrades = [];
    $languageGrades = [];
    foreach ($studentsGradesList as $item){
        foreach ($item as $element) {
            array_push($mathGrades, $item[1]);
            array_push($physicsGrades, $item[2]);
            array_push($languageGrades, $item[3]);
        }
    }
    $averageMath = array_sum($mathGrades) / count($mathGrades);
    $averagePhysics = array_sum($physicsGrades) / count($physicsGrades);
    $averageLanguage = array_sum($languageGrades) /count($languageGrades);

    return round($averageMath, 11)." ".round($averagePhysics, 11)." ".round($averageLanguage, 11);
}