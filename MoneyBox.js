/*Реализуйте класс MoneyBox, для работы с виртуальной копилкой.
Каждая копилка имеет ограниченную вместимость, которая выражается целым числом – количеством монет, которые можно
положить в копилку. Класс должен поддерживать информацию о количестве монет в копилке, предоставлять возможность
добавлять монеты в копилку и узнавать, можно ли добавить в копилку ещё какое-то количество монет, не превышая ее
вместимость.*/
class MoneyBox{
    constructor(capacity)
    {
        this.capacity = capacity;
        this.coinsInBox = 0;
    }

    canAdd(numberOfCoins)
    {
        if (this.capacity - this.coinsInBox >= numberOfCoins){
        return true;
    }
        return false;
    }

    add(numberOfCoins)
    {
        this.coinsInBox += numberOfCoins;
        return this.coinsInBox;
    }
}

const smallMoneyBox = new MoneyBox(7);
smallMoneyBox.add(5);
console.log(smallMoneyBox.canAdd(1));