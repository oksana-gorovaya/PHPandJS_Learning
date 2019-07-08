<?php
class NonPositiveError extends Exception{
}

class PositiveList
{
    private $numberCollection = [];

    public function add(array $arr): void
    {
        foreach ($arr as  $item){
            if ($item > 0){
                array_push($this->numberCollection, $item);
            }
            throw new NonPositiveError;
        }
    }

    public function getCollection(): array
    {
        return $this->numberCollection;
    }

    public function array_push(int $inputNumber): void
    {
        if ($inputNumber >= 0){
            array_push($this->numberCollection, $inputNumber);
        }
        throw new NonPositiveError;
    }

}


$a = new PositiveList();
$a->add([3, 5, 1]);
$a->add([3]);
var_dump($a->getCollection());
$a->add([9, 9, 9]);
var_dump($a->getCollection());
