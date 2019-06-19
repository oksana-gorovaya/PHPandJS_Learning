<?php
/*Группа биологов в институте биоинформатики завела себе черепашку.
После дрессировки черепашка научилась понимать и запоминать указания биологов следующего вида:
север 10
запад 20
юг 30
восток 40
где первое слово — это направление, в котором должна двигаться черепашка, а число после слова — это положительное
расстояние в сантиметрах, которое должна пройти черепашка.

Но команды даются быстро, а черепашка ползёт медленно, и программисты догадались, что можно написать программу, которая
определит, куда в итоге биологи приведут черепашку. Для этого программисты просят вас написать программу, которая
выведет точку, в которой окажется черепашка после всех команд. Для простоты они решили считать, что движение начинается
в точке (0, 0), и движение на восток увеличивает первую координату, а на север — вторую.

Программе подаётся на вход число команд n, которые нужно выполнить черепашке, после чего n строк с самими командами.
Вывести нужно два числа в одну строку: первую и вторую координату конечной точки черепашки. Все координаты
целочисленные.*/

$instructionsNumber = readline();
$instructions = fillDynamicList($instructionsNumber);
$preprocessedInstructions = associateDirectionWithDistance($instructions);
$finishCoordinates = getDirections($preprocessedInstructions);
$formattedOutput = formatOutput($finishCoordinates);
var_dump($formattedOutput);

function fillDynamicList($entriesNumber)
{
    $filledList = [];
    while (sizeof($filledList) < $entriesNumber){
        $anotherEntry = strtolower(readline());
        array_push($filledList, $anotherEntry);
    }

    return $filledList;
}

function associateDirectionWithDistance($instructions)
{
    $instructionsArray = [];
    foreach ($instructions as $command){
        $direction = [];
        $distance = [];
        foreach (explode(' ', $command) as $commandPart){
            if (preg_match('/[a-zA-Zа-яА-Я]/', $commandPart)){
                array_push($direction, $commandPart);
            } else if (preg_match('/[0-9]/', $commandPart)){
                array_push($distance, $commandPart);
            } else {
                throw new Exception('This tortoise does not support this type of command.');
            }
        }
        array_push($instructionsArray, array_combine($direction, $distance));
    }

    return $instructionsArray;
}

function getDirections($preprocessedInstructions)
{
    $route = ['x' => 0, 'y' => 0];
    foreach ($preprocessedInstructions as $instruction){
        foreach ($instruction as $direction => $distance){
            if (($direction) === 'север' || ($direction === 'north')){
                $route['y'] += intval($distance);
            }
            else if(($direction === 'запад') || ($direction === 'west')){
                $route['x'] -= intval($distance);
            }
            else if (($direction === 'юг') || ($direction === 'south')){
                $route['y'] -= intval($distance);
            }
            else if (($direction === 'восток') || ($direction === 'east')){
                $route['x'] += intval($distance);
            } else {
                throw new Exception('This tortoise does not support this type of command.');
            }
        }
    }

    return $route;
}

function formatOutput($finishCoordinates)
{
    $output = '';
    foreach ($finishCoordinates as $coordinate){
        $output .= strval($coordinate) . ' ';

    }
    return $output;
}