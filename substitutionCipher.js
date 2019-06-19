/*В какой-то момент в Институте биоинформатики биологи перестали понимать, что говорят информатики: они говорили
каким-то странным набором звуков.
В какой-то момент один из биологов раскрыл секрет информатиков: они использовали при общении подстановочный шифр, т.е.
заменяли каждый символ исходного сообщения на соответствующий ему другой символ. Биологи раздобыли ключ к шифру и теперь
 нуждаются в помощи:
Напишите программу, которая умеет шифровать и расшифровывать шифр подстановки. Программа принимает на вход две строки
одинаковой длины, на первой строке записаны символы исходного алфавита, на второй строке — символы конечного алфавита,
после чего идёт строка, которую нужно зашифровать переданным ключом, и ещё одна строка, которую нужно расшифровать.
Пусть, например, на вход программе передано:
abcd
*d%#
abacabadaba
#*%*d*%
Это значит, что символ a исходного сообщения заменяется на символ * в шифре, b заменяется на d, c — на % и d — на #.
Нужно зашифровать строку abacabadaba и расшифровать строку #*%*d*% с помощью этого шифра. Получаем следующие строки,
которые и передаём на вывод программы:
*d*%*d*#*d*
dacabac
*/

const _ = require('lodash');
const initialLetters = 'abcd';
const encryptingLetters = '*d%#';
const stringToEncrypt = 'abacabadaba';
const stringToDecrypt = '#*%*d*%';

const cipherKey = createEncryptingDictionary(initialLetters, encryptingLetters);
const encryptedString = encryptString(cipherKey, stringToEncrypt);
const decryptedString = decryptString(cipherKey, stringToDecrypt);

function createEncryptingDictionary(initialLetters, encryptingLetters)
{
    const keysArray = initialLetters.split('');
    const valuesArray = encryptingLetters.split('');

    return _.zipObject(keysArray, valuesArray);
}

function encryptString(cipherKey, stringToEncrypt)
{
    let encryptedString = '';
    stringToEncrypt.split('').forEach(function (character) {
        if (Object.keys(cipherKey).includes(character)){
            encryptedString += cipherKey[character];
        }
    });

    return encryptedString;
}

function decryptString(cipherKey, stringToDecrypt)
{
    let decryptedString = '';
    stringToDecrypt.split('').forEach(function(item){
        if (Object.values(cipherKey).includes(item)){
            for (let [key, value] of Object.entries(cipherKey)){
                if(item === value){
                    decryptedString += key;
                }
            }
        }
    });

    return decryptedString;
}

