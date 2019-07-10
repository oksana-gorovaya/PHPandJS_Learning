const s = 'abababa';
const t = 'aba';
let lastPos = 0;
let counter = 0;
console.log(findOccurrences(s, t, lastPos, counter));

function findOccurrences(s, t, lastPos, counter)
{
    while ((lastPos = s.indexOf(t, lastPos)) !== -1) {
        counter += 1;
        lastPos = lastPos + 1;
    }
    return counter;
}