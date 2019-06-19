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
const _ = require('lodash');
const instructions = ['север 10', 'запад 20', 'юг 30', 'восток 40'];
const preprocessedInstructions = associateDirectionWithDistance(instructions);
const finishCoordinates = getDirections(preprocessedInstructions);
const formattedOutput = formatOutput(finishCoordinates);

function associateDirectionWithDistance(instructions)
{
    let direction = [];
    let distance = [];
    instructions.forEach (function(command){
        command.split(' ').forEach (function(commandPart){
            if (commandPart.match(/[a-zA-Zа-яА-Я]/)){
                direction.push(commandPart);
            } else if (commandPart.match(/[0-9]/)){
                distance.push(commandPart);
            } else {
                throw new Error('This tortoise does not support this type of command.');
            }
        });
    });

    return _.zipObject(direction, distance)
}

function getDirections(preprocessedInstructions)
{
    let route = {'x' : 0, 'y' : 0};
    for ([direction, distance] of Object.entries(preprocessedInstructions)){
        if ((direction) === 'север' || (direction === 'north')){
            route['y'] += parseInt(distance);
        }
        else if((direction === 'запад') || (direction === 'west')){
            route['x'] -= parseInt(distance);
        }
        else if ((direction === 'юг') || (direction === 'south')){
            route['y'] -= parseInt(distance);
        }
        else if ((direction === 'восток') || (direction === 'east')){
            route['x'] += parseInt(distance);
        } else {
            throw new Error('This tortoise does not support this type of command.');
        }
    }

    return route;
}

function formatOutput(finishCoordinates)
{
    let output = '';
    for(let coordinate of Object.values(finishCoordinates)){
        output += coordinate + ' ';

    }

    return output;
}