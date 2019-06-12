<?php

/*Напишите программу, которая считывает из файла строку, соответствующую тексту, сжатому с помощью кодирования
повторов, и производит обратную операцию, получая исходный текст.
L4V7H18O20a9m20R18Q2h12x9P12l15o19B3H17f15q17o10N11U11S13f10q6Q17W14U4p16w3S6M2A1a11r1J12
*/

$encodedFile = file_get_contents('/home/xenia/Завантаження/dataset_3363_2.txt');

if (!$encodedFile){
    throw new Exception("cannot read file");
}
$splitedInput = splitInput($encodedFile);
$sortedLetters = sortLetters($splitedInput);
$sortedNumbers = sortNumbers($splitedInput);
$restoredBlocks = formDecodedString($sortedLetters, $sortedNumbers);

function splitInput($encodedFile, $pattern = "/[a-zA-Z]/")
{
    $arr = str_split($encodedFile);
    $dataArray = [];
    foreach($arr as $item){
        if (preg_match($pattern, $item) === 1){
            $chunk = "," . $item;
            array_push($dataArray, $chunk);
        } else{
            array_push($dataArray, $item);
        }
    }
    return $dataArray;
}

function sortLetters($splitedInput, $pattern = "/[a-zA-Z]/")
{
    $letters = [];
    foreach($splitedInput as $item){
        $tempArray = str_split($item);
        foreach($tempArray as $element){
            if (preg_match($pattern, $element) === 1){
                array_push($letters, $element);
            }
        }
    }
    return $letters;
}

function sortNumbers($splitedInput, $pattern = "/[a-zA-Z]/")
{
    $numbers = [];
    foreach($splitedInput as $item){
        $tempArray = str_split($item);
        foreach($tempArray as $element){
            if (preg_match($pattern, $element) === 0){
                array_push($numbers, $element);
            } else{
                continue;
            }
        }
    }
    return $numbers;
}

function formDecodedString($sortedLetters, $sortedNumbers)
{
    $result = [];
    $jointNumbers = trim(implode($sortedNumbers), ',');
    $splitedNumbers = explode(",", $jointNumbers);
    foreach ($sortedLetters as $element){
        array_push($result, str_repeat($element, intval(array_shift($splitedNumbers))));
    }
    return implode($result);
}

$decodedFile = file_put_contents('/home/xenia/PhpstormProjects/decodedFile.txt', $restoredBlocks);
