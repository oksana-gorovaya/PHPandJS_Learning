<?php
/*Дан файл с таблицей в формате TSV с информацией о росте школьников разных классов.
Напишите программу, которая прочитает этот файл и подсчитает для каждого класса средний рост учащегося.
Файл состоит из набора строк, каждая из которых представляет собой три поля:
Класс Фамилия Рост
Класс обозначается только числом. Буквенные модификаторы не используются. Номер класса может быть от 1 до 11
включительно. В фамилии нет пробелов, а в качестве роста используется натуральное число, но при подсчёте среднего
требуется вычислить значение в виде вещественного числа.

Выводить информацию о среднем росте следует в порядке возрастания номера класса (для классов с первого по одиннадцатый).
 Если про какой-то класс нет информации, необходимо вывести напротив него прочерк*/

$studentList = file_get_contents(readline());
$outputTemplate = createTemplate();
$studentHeightList = getHeight($studentList);
$output = fillTemplate($outputTemplate, $studentHeightList);
$formattedOutput = formatOutput($output);
file_put_contents(readline(), $formattedOutput);

function createTemplate()
{

    $studentsTemplate = [];
    foreach (range(1, 11) as $form){
        $studentsTemplate[$form] = '-';
    }
    return $studentsTemplate;
}

function getHeight($studentList)
{
    $splittedList = explode("\n", trim($studentList));
    $heightList = [];

    foreach ($splittedList as $item){
        $splittedItem = explode("\t", $item);
        $formNumber = [];
        $studentHeight = [];
        foreach ($splittedItem as $element){
            if (preg_match("/[0-9]/", $element)){
                if (intval($element) <= 11){
                    array_push($formNumber, intval($element));
                } else {
                    array_push($studentHeight, $element);
                }
            }
        }
        array_push($heightList, array_combine($formNumber, $studentHeight));

    }

    return $heightList;
}

function fillTemplate($outputTemplate, $studentHeightList)
{
    $counter = [];
    foreach ($studentHeightList as $item){
        $key = array_keys($item)[0];
        $value = array_values($item)[0];

        if ($outputTemplate[$key] === '-'){
            $outputTemplate[$key] = intval($value);
        } else {
            $outputTemplate[$key] += intval($value);
        }
        array_push($counter, $key);
    }
    foreach ($outputTemplate as $key => $value){
        if ($value !== '-'){
            $outputTemplate[$key] = $value / count(array_keys($counter, $key));
        }
    }

    return $outputTemplate;

}

function formatOutput($output)
{
    $stringOutput = '';
    foreach ($output as $form => $averageHeight){
        $stringOutput .= $form . ': ' . $averageHeight . "\n";
    }

    return $stringOutput;
}