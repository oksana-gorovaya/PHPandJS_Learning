/*Напишите программу, которая считывает из файла строку, соответствующую тексту, сжатому с помощью кодирования
    повторов, и производит обратную операцию, получая исходный текст.
    L4V7H18O20a9m20R18Q2h12x9P12l15o19B3H17f15q17o10N11U11S13f10q6Q17W14U4p16w3S6M2A1a11r1J12
    */

    //$encodedFile = file_get_contents('/home/xenia/Завантаження/dataset_3363_2.txt');
const fs = require('fs');
let encodedFile;

try {
    encodedFile = fs.readFileSync('/home/xenia/Завантаження/dataset_3363_2.txt', 'utf8');

} catch(e) {
    throw new Error("Cannot read file");
}
const pattern = /[a-zA-Z]/;
const splitedInput = splitInput(encodedFile, pattern);
const sortedLetters = sortLetters(splitedInput, pattern);
const sortedNumbers = sortNumbers(splitedInput, pattern);
const restoredBlocks = formDecodedString(sortedLetters, sortedNumbers);

function splitInput(encodedFile, pattern)
{
    const arr = encodedFile.split('');
    let dataArray = [];

    arr.forEach(function(item){
        if (item.match(pattern)){
            let chunk = "," + item;
            dataArray.push(chunk);
        } else{
            dataArray.push(item);
        }
    });
    return dataArray;

}

function sortLetters(splitedInput, pattern)
{
    let letters = [];
    splitedInput.forEach(function(item){
        const tempArray = item.split('');
        tempArray.forEach(function(element){
            if (element.match(pattern)){
                letters.push(element);
            }
        });
    });
    return letters;
}

function sortNumbers(splitedInput, pattern)
{
    let numbers = [];
    splitedInput.forEach(function(item){
        const tempArray = item.split('');
        tempArray.forEach(function(element){
            if (element.match(pattern) === null){
                numbers.push(element);
            }
        });
    });
    return numbers;
}
function ownTrimWithBlackJack (arr)
{
    if(arr[0] === ','){
        arr.shift()
    }
    return arr
}
function formDecodedString(sortedLetters, sortedNumbers)
{
    let result = [];
    const jointNumbers = ownTrimWithBlackJack(sortedNumbers).join('');
    const splitedNumbers = jointNumbers.split(',');
    sortedLetters.forEach(function (element) {
        result.push(element.repeat(splitedNumbers.shift()))

    });

    return result.join('');
}

fs.writeFile('/home/xenia/PhpstormProjects/decodedJS.txt', restoredBlocks, (err) => {
    if (err) {
        throw Error('File cannot be written')
    }
    console.log("Successfully Written to File.");
});
