const mainString = 'ababac';
const firstString = 'c';
const secondString = 'c';
let counter = 0;
console.log(countChanges(mainString, firstString, secondString, counter));

function countChanges(mainString, firstString, secondString, counter)
{
    if (mainString.includes(firstString)){
        counter += 1;
        if (counter < 1000) {
            return countChanges(mainString.replace(new RegExp(firstString, 'g'), secondString), firstString, secondString, counter);
        }
        return 'Impossible';
    } else {
        return counter;
    }
}