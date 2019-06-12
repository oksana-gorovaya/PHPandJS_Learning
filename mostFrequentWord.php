<?php
/*Недавно мы считали для каждого слова количество его вхождений в строку. Но на все слова может быть не так интересно
смотреть, как, например, на наиболее часто используемые.
Напишите программу, которая считывает текст из файла (в файле может быть больше одной строки) и выводит самое частое
слово в этом тексте и через пробел то, сколько раз оно встретилось. Если таких слов несколько, вывести
лексикографически первое (можно использовать оператор < для строк).
В качестве ответа укажите вывод программы, а не саму программу.
Слова, написанные в разных регистрах, считаются одинаковыми.
abc a bCd bC AbC BC BCD bcd ABC*/


$text = strtolower(file_get_contents('/home/xenia/Завантаження/dataset_3363_3.txt'));
if (!$text){
    throw new Exception("cannot read file");
}

$arr = explode(" ", $text);

function countEntries($arr)
{
    return array_count_values($arr);
}

function findMostFrequentWords($wordsStatistic)
{
    $biggestNumberOfOccurrence =[];
    foreach ($wordsStatistic as $key => $value){
        if($value === max($wordsStatistic)){
            array_push($biggestNumberOfOccurrence, $key." ".$value);
        }
    }
    return $biggestNumberOfOccurrence;
}

function findMostFrequentWOrdEver($frequentWords)
{
    return min($frequentWords);
}

$wordsStatistic = countEntries($arr);
var_dump($wordsStatistic);
$frequentWords = findMostFrequentWords($wordsStatistic);
var_dump($frequentWords);
$outputData = findMostFrequentWOrdEver($frequentWords);
file_put_contents('/home/xenia/PhpstormProjects/decodedFile.txt', $outputData);