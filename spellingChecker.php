<?php
/*Простейшая система проверки орфографии основана на использовании списка известных слов. Каждое слово в проверяемом
тексте ищется в этом списке и, если такое слово не найдено, оно помечается, как ошибочное.
Напишем подобную систему.

Через стандартный ввод подаётся следующая структура: первой строкой — количество d записей в списке известных слов,
после передаётся  d строк с одним словарным словом на строку, затем — количество l строк текста, после чего — l строк
текста.

Напишите программу, которая выводит слова из текста, которые не встречаются в словаре. Регистр слов не учитывается.
Порядок вывода слов произвольный. Слова, не встречающиеся в словаре, не должны повторяться в выводе программы.*/

$numberOfWords = readline();
$allowedWords = fillDynamicList($numberOfWords);
$numberOfLines = readline();
$textLines = fillDynamicList($numberOfLines);
$splittedLines = splitLines($textLines);
$unrecognizedWords = compareLists($allowedWords, $splittedLines);

function fillDynamicList($entriesNumber)
{
    $filledList = [];
    while (sizeof($filledList) < $entriesNumber){
        $anotherEntry = strtolower(readline());
        array_push($filledList, $anotherEntry);
        }

    return $filledList;
}

function splitLines($textLines)
{
    $separatedWords = [];
    foreach ($textLines as $line){
        array_push($separatedWords, explode(' ', $line));
    }

    return $separatedWords;
}

function compareLists($allowedWords, $splittedLines)
{
    $unrecognizedWords = [];
    foreach ($splittedLines as $line){
        foreach ($line as $word){
            if (!in_array($word, $allowedWords)){
                array_push($unrecognizedWords, $word);
            }
        }
    }
    $formattedOutput = '';
    foreach (array_unique($unrecognizedWords) as $word){
        $formattedOutput .= $word . "\n" ;
    }

    return $formattedOutput;
}