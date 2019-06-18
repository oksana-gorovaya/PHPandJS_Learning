<?php
/*Напишите программу, которая принимает на стандартный вход список игр футбольных команд с результатом матча и выводит
на стандартный вывод сводную таблицу результатов всех матчей.
За победу команде начисляется 3 очка, за поражение — 0, за ничью — 1.
Формат ввода следующий:
В первой строке указано целое число n — количество завершенных игр.
После этого идет n строк, в которых записаны результаты игры в следующем формате:
Первая_команда;Забито_первой_командой;Вторая_команда;Забито_второй_командой
Вывод программы необходимо оформить следующим образом:
Команда:Всего_игр Побед Ничьих Поражений Всего_очков
'Зенит;3;Спартак;1', 'Спартак;1;ЦСКА;1', 'ЦСКА;0;Зенит;2'*/
$gamesTotal = readline();
$initialTable = [];

while (sizeof($initialTable) < $gamesTotal)
{
    $anotherGame = readline();
    array_push($initialTable, $anotherGame);
}
$matchTable = createMatchTableTemplate($initialTable);
$updatedTable = preprocessTableData($initialTable, $matchTable);
$output = formatResults($updatedTable);
file_put_contents('/home/xenia/PhpstormProjects/footballTable.txt', $output);

function createMatchTableTemplate($initialTable)
{
    $gamesTemplate = [];

    foreach ($initialTable as $item){
        foreach (explode(';', $item) as $element){
            if (preg_match('/[a-zA-zа-Я]/', $element) && (in_array($element, array_keys($gamesTemplate)))){
                continue;
            } else if (preg_match('/[a-zA-zа-Я]/', $element) && (!in_array($element, array_keys($gamesTemplate)))){
                $gamesTemplate[$element] = ['games_played' => 0, 'won' => 0, 'drawn' => 0, 'lost' => 0, 'points' => 0];
            } else if (preg_match('/[0-9]/', $element)){
            } else {
                throw new Exception('Invalid team name');
            }
        }
    }

    return $gamesTemplate;
}

function preprocessTableData($initialTable, $matchTable)
{
    $arr = [];
    foreach ($initialTable as $item) {
        array_push($arr, explode(';', $item));
    }
    foreach ($arr as $item){
        $keysArray = [];
        $valuesArray = [];
        foreach ($item as $element){
            if (preg_match('/[a-zA-zа-Я]/', $element)){
                array_push($keysArray, $element);
            } else {
                array_push($valuesArray, intval($element));
            }
        }

        $games = [];
        array_push($games, array_combine($keysArray, $valuesArray));
        $matchTable = updateMatchTable($games, $valuesArray, $matchTable);
    }
    return $matchTable;
}

function updateMatchTable($games, $valuesArray, $matchTable)
{
    foreach ($games as $item){
        foreach ($item as $key => $value){
            $matchTable[$key]['games_played'] += 1;

            if (($value === $valuesArray[0]) && ($value === $valuesArray[1])){
               // var_dump('draw');
                $matchTable[$key]['drawn'] += 1;
                $matchTable[$key]['points'] += 1;
            } else if ($value === max($valuesArray)){
                $matchTable[$key]['won'] += 1;
                $matchTable[$key]['points'] += 3;
            } else {
                $matchTable[$key]['lost'] += 1;
            }
        }
    }
    return $matchTable;
}

function formatResults($updatedTable)
{
    $output = '';
    foreach ($updatedTable as $key => $value){
        $output .= "\n" . $key . ':';
        $output .= ''.join(' ', array_values($value));
    }

    return $output;
};
