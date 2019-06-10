<?php
/*Напишите программу, которая считывает из файла строку, соответствующую тексту, сжатому с помощью кодирования
повторов, и производит обратную операцию, получая исходный текст.
L4V7H18O20a9m20R18Q2h12x9P12l15o19B3H17f15q17o10N11U11S13f10q6Q17W14U4p16w3S6M2A1a11r1J12
*/

$encodedFile = file_get_contents('/home/xenia/Завантаження/dataset_3363_2.txt');

if (!$encodedFile){
    var_dump("cannot read file");
}
$pattern = "/[a-zA-Z]/";

function splitInput($encodedFile, $pattern)
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

function separateCharacters($splitedInput, $pattern)
{
    $result = [];
    $letters = [];
    $numbers = [];
    foreach($splitedInput as $item){
        $tempArray = str_split($item);
        foreach($tempArray as $element){
            if (preg_match($pattern, $element) === 1){
                array_push($letters, $element);
            } else{
                array_push($numbers, $element);
            }
        }
    }

    if ($numbers[0] === ","){
        unset($numbers[0]);
    }

    $jointNumbers = implode($numbers);
    $splitedNumbers = explode(",", $jointNumbers);

    foreach ($letters as $element){
        array_push($result, str_repeat($element, intval(array_shift($splitedNumbers))));
    }
    return implode($result);
}
$splitedInput = splitInput($encodedFile, $pattern);
$restoredBlocks = separateCharacters($splitedInput, $pattern);
var_dump($restoredBlocks);

$decodedFile = file_put_contents('/home/xenia/PhpstormProjects/decodedFile.txt', $restoredBlocks);
