/*Напишите программу, которая принимает на стандартный вход список игр футбольных команд с результатом матча и выводит
на стандартный вывод сводную таблицу результатов всех матчей.
За победу команде начисляется 3 очка, за поражение — 0, за ничью — 1.
Формат ввода следующий:
В первой строке указано целое число n — количество завершенных игр.
После этого идет n строк, в которых записаны результаты игры в следующем формате:
Первая_команда;Забито_первой_командой;Вторая_команда;Забито_второй_командой
Вывод программы необходимо оформить следующим образом:
Команда:Всего_игр Побед Ничьих Поражений Всего_очков
'Зенит;3;Спартак;1', 'ЦСКА;1;Спартак;1', 'ЦСКА;0;Зенит;2'*/
const _ = require('lodash');

const initialTable = ['Зенит;3;Спартак;1', 'ЦСКА;1;Спартак;1', 'ЦСКА;0;Зенит;2'];
const pattern = /[a-zA-zа-яА-Я\s-]/;
const firstTeamScore = 0;
const secondTeamScore = 1;
const matchTable = createMatchTableTemplate(initialTable, pattern);
const updatedTable = preprocessTableData(initialTable, matchTable, pattern);
const output = formatResults(updatedTable);
console.log(output);

function createMatchTableTemplate(initialTable, pattern)
{
    let gamesTemplate = {};

    initialTable.forEach(function(item){

        item.split(';').forEach (function(element){
            const checkInArray = Object.keys(gamesTemplate).includes(element);
            if (element.match(pattern) && (!checkInArray)){
                gamesTemplate[element] = {'games_played': 0, 'won' : 0, 'drawn' : 0, 'lost' : 0, 'points' : 0};
            } else if (element.match(/[0-9]/)){
                ;
            } else if (element.match(pattern) && (checkInArray)){
                ;
            } else{
                throw new Error('Invalid team name');
            }
        })
    });

    return gamesTemplate;
}

function preprocessTableData(initialTable, matchTable, pattern)
{
    let arr = [];

    initialTable.forEach (function(item) {
    arr.push(item.split(';'));
    });

    arr.forEach (function(item){
    let keysArray = [];
    let valuesArray = [];
    item.forEach (function(element){
        if (element.match(pattern)){
            keysArray.push(element);
        } else {
            valuesArray.push(parseInt(element));
        }
    });

    let games = [];
    games.push(_.zipObject(keysArray, valuesArray));
   matchTable = updateMatchTable(games, valuesArray, matchTable);
});
    return matchTable;
}

function updateMatchTable(games, valuesArray, matchTable)
{
    games.forEach (function(game){
        for (let [footballTeam, score] of Object.entries(game)){
            matchTable[footballTeam]['games_played'] += 1;

            if ((score === valuesArray[firstTeamScore]) && (score === valuesArray[secondTeamScore])){
                matchTable[footballTeam]['drawn'] += 1;
                matchTable[footballTeam]['points'] += 1;
            } else if (score === Math.max(...valuesArray)){
                matchTable[footballTeam]['won'] += 1;
                matchTable[footballTeam]['points'] += 3;
            } else {
                matchTable[footballTeam]['lost'] += 1;
            }
        }

    });

    return matchTable;
}

function formatResults(updatedTable)
{
    let output = '';
    for (let [key, value] of Object.entries(updatedTable)){
        output += "\n" + key + ': ';
        output += Object.values(value).join(' ');
}

    return output;
}