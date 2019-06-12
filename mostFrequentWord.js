/*Недавно мы считали для каждого слова количество его вхождений в строку. Но на все слова может быть не так интересно
    смотреть, как, например, на наиболее часто используемые.
    Напишите программу, которая считывает текст из файла (в файле может быть больше одной строки) и выводит самое частое
    слово в этом тексте и через пробел то, сколько раз оно встретилось. Если таких слов несколько, вывести
    лексикографически первое (можно использовать оператор < для строк).
    В качестве ответа укажите вывод программы, а не саму программу.
    Слова, написанные в разных регистрах, считаются одинаковыми.
    abc a bCd bC AbC BC BCD bcd ABC*/
const fs = require('fs');
const _ = require('underscore');
let text;

try {
    text = fs.readFileSync('/home/xenia/Завантаження/dataset_3363_3.txt', 'utf8');

} catch(e) {
    throw new Error("Cannot read file");
}

const arr = text.toLowerCase().split(" ");
const wordsStatistic = _.countBy(arr, function(item) {
    return item;
});
const frequentWords = findMostFrequentWords(wordsStatistic);
const outputData = findMostFrequentWordEver(frequentWords);
fs.writeFile('/home/xenia/PhpstormProjects/decodedJS.txt', outputData, (err) => {
    if (err) {
        throw Error('File cannot be written')
    }
    console.log("Successfully Written to File.");
});

function findMostFrequentWords(wordsStatistic)
{
    let biggestNumberOfOccurrence = [];
    const maxValue = Math.max(...Object.values(wordsStatistic));

    _.each(wordsStatistic, (value, key)=>{
        if(value === maxValue){
            biggestNumberOfOccurrence.push(key + " " + value)
        }
    });

    return biggestNumberOfOccurrence;
}

function findMostFrequentWordEver(frequentWords)
{
    return frequentWords.sort()[0]
}
