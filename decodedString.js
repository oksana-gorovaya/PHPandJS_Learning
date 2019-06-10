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
    console.log('Error:', e.stack);
}

const pattern = /[a-zA-Z]/;

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

function separateCharacters(splitedInput, pattern)
{
    let result = [];
    let letters = [];
    let numbers = [];

    splitedInput.forEach(function(item){
        const tempArray = item.split('');
        tempArray.forEach(function(element){
            if (element.match(pattern)){
                letters.push(element);
            } else{
                numbers.push(element);
            }
        });
    });

    numbers.shift();

    let jointNumbers = numbers.join('');
    let splitedNumbers = jointNumbers.split(',');

    letters.forEach(function (element) {
        result.push(element.repeat(splitedNumbers.shift()))

    });

    return result.join('');
}
const splitedInput = splitInput(encodedFile, pattern);
const restoredBlocks = separateCharacters(splitedInput, pattern);

fs.writeFile('/home/xenia/PhpstormProjects/decodedJS.txt', restoredBlocks, (err) => {
    if (err) console.log(err);
    console.log("Successfully Written to File.");
});
