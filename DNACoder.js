/*Кодирование осуществляется следующим образом:
s = 'aaaabbсaa' преобразуется в 'a4b2с1a2', то есть группы одинаковых символов исходной строки заменяются на этот
символ и количество его повторений в этой позиции строки.

    Напишите программу, которая считывает строку, кодирует её предложенным алгоритмом и выводит закодированную
последовательность на стандартный вывод. Кодирование должно учитывать регистр символов.*/

const DNA_sample = 'aaaaabcaa';
let DNA_coded = '';
let temp_str = '';
const arr = Array.from(DNA_sample);
let counter = 0;

arr.forEach(function(item){
    if (counter === 0){
        temp_str += item;
        counter += 1;

    }
    else if (arr[counter] !== arr[counter - 1]){
        temp_str += `,${item}`;
        counter += 1;

    }

    else{
        temp_str += item;
        counter += 1;
    }
});

temp_array = temp_str.split(',');
temp_array.forEach(function(element){
    DNA_coded += `${element[0]}${element.length}`
});
console.log(DNA_coded);