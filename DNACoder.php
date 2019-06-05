<?php

/*Кодирование осуществляется следующим образом:
s = 'aaaabbсaa' преобразуется в 'a4b2с1a2', то есть группы одинаковых символов исходной строки заменяются на этот
символ и количество его повторений в этой позиции строки.

    Напишите программу, которая считывает строку, кодирует её предложенным алгоритмом и выводит закодированную
последовательность на стандартный вывод. Кодирование должно учитывать регистр символов.*/

$DNA_sample = 'aaaaabaaa';
$temp_str = '';
$result = groupElements($DNA_sample, $temp_str);
var_dump(countDuplicates($result));

function groupElements($DNA_sample, $temp_str){
    $arr = str_split($DNA_sample);
    $counter = 0;

    foreach ($arr as $item){
        if ($counter === 0){
            $temp_str .= $item;
            $counter += 1;

        }
        elseif ($arr[$counter] !== $arr[$counter - 1]){
            $temp_str .= "," . $item;
            $counter += 1;
        }

        else{
            $temp_str .= $item;
            $counter += 1;
        }
    };
    return $temp_str;
}

function countDuplicates($result){
    $DNA_coded = '';
    $temp_array = explode(",", $result);

    foreach($temp_array as $element){
        $elementNumber = strlen($element);
        $DNA_coded .= $element[0].$elementNumber;
    };
    return $DNA_coded;
}

