/*Кодирование осуществляется следующим образом:
s = 'aaaabbсaa' преобразуется в 'a4b2с1a2', то есть группы одинаковых символов исходной строки заменяются на этот
символ и количество его повторений в этой позиции строки.

    Напишите программу, которая считывает строку, кодирует её предложенным алгоритмом и выводит закодированную
последовательность на стандартный вывод. Кодирование должно учитывать регистр символов.*/

const DNA_sample = 'aaaaabcaa';
let temp_str = '';
const result = groupElements(DNA_sample, temp_str);
console.log(countDuplicates(result));

function groupElements(DNA_sample, temp_str){
    const arr = Array.from(DNA_sample);
    let counter = 0;

    arr.forEach(function(item){
        if (counter === 0){
            temp_str += item;
            counter += 1;

        }
        else if (arr[counter] !== arr[counter - 1]){
            temp_str += ','+item;
            counter += 1;

        }

        else{
            temp_str += item;
            counter += 1;
        }
    });
    return temp_str;
}
function countDuplicates(result){
    let DNA_coded = '';
    const temp_array = result.split(',');
    temp_array.forEach(function(element){
        DNA_coded += element[0]+element.length
    });
    return DNA_coded;
}
