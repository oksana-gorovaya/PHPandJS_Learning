<?php
/*Напишите программу, которая принимает на вход список чисел в одной строке и выводит на экран в одну строку значения,
которые повторяются в нём более одного раза.

    Для решения задачи может пригодиться метод sort списка.

    Выводимые числа не должны повторяться, порядок их вывода может быть произвольным.*/

$userInput = '22 22 22 3 4 4 4 4 4 3 0 0 -2 -2';
$transformedInput = explode(" ", $userInput);
var_dump(transformInput($transformedInput));

function transformInput($transformedInput){
    $sampleArray = [];
    $userOutput = [];
    foreach ($transformedInput as $item){
        if(in_array($item , $sampleArray)) {
            if(!in_array($item, $userOutput)){
                array_push($userOutput, $item);
            }
        }
        array_push($sampleArray, $item);
    }
    $formattedOutput = implode(" ", $userOutput);
    return $formattedOutput;
}


