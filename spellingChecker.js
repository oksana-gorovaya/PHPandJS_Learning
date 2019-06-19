/*Простейшая система проверки орфографии основана на использовании списка известных слов. Каждое слово в проверяемом
тексте ищется в этом списке и, если такое слово не найдено, оно помечается, как ошибочное.
Напишем подобную систему.

Через стандартный ввод подаётся следующая структура: первой строкой — количество d записей в списке известных слов,
после передаётся  d строк с одним словарным словом на строку, затем — количество l строк текста, после чего — l строк
текста.

Напишите программу, которая выводит слова из текста, которые не встречаются в словаре. Регистр слов не учитывается.
Порядок вывода слов произвольный. Слова, не встречающиеся в словаре, не должны повторяться в выводе программы.*/

const allowedWords = ['a', 'bb', 'cCc'];
const lowerCaseAllowedWords = allowedWordsToLowerCase(allowedWords);
const textLines = ['a bb aab aba ccc', 'c bb aaa aaa'];
const splittedLines = splitLines(textLines);
const unrecognizedWords = compareLists(allowedWords, splittedLines);
const formattedOutput = formatOutput(unrecognizedWords);

function splitLines(textLines)
{
    let separatedWords = [];
    textLines.forEach(function (line){
        separatedWords.push(line.toLowerCase().split(' '));
    });

    return separatedWords.reduce((acc, val) => acc.concat(val), []);
}

function compareLists(allowedWords, splittedLines)
{
   let unrecognizedWords =  splittedLines.filter(function(word) {
        return lowerCaseAllowedWords.indexOf(word) === -1;
    });

   return [...new Set(unrecognizedWords)];
}

function allowedWordsToLowerCase(allowedWords){
    return allowedWords.map(function(word) {
        return word.toLowerCase();
    })
}

function formatOutput(unrecognizedWords)
{
    return unrecognizedWords.join("\n");
}