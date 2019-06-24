<?php
/*Реализуйте класс MoneyBox, для работы с виртуальной копилкой.
Каждая копилка имеет ограниченную вместимость, которая выражается целым числом – количеством монет, которые можно
положить в копилку. Класс должен поддерживать информацию о количестве монет в копилке, предоставлять возможность
добавлять монеты в копилку и узнавать, можно ли добавить в копилку ещё какое-то количество монет, не превышая ее
вместимость.*/
class MoneyBox{
    public function __construct($capacity)
    {
        $this->capacity = $capacity;
        $this->coinsInBox = 0;
    }

    public function canAdd($numberOfCoins)
    {
        if ($this->capacity - $this->coinsInBox >= $numberOfCoins){
            return true;
        }
        return false;
    }

    public function add($numberOfCoins)
    {
        $this->coinsInBox += $numberOfCoins;
        return $this->coinsInBox;
    }
}


$smallMoneyBox = new MoneyBox(7);
$smallMoneyBox->add(5);
var_dump($smallMoneyBox->canAdd(6));