<?php
class NonPositiveError extends Exception{
    public function __construct($message = null, $code = 0) {
        echo $message;
    }
}

class PositiveList
{
    private $numberCollection = [];

    public function add($arr)
    {
        foreach ($arr as  $item){
            if ($item > 0){
                array_push($this->numberCollection, $item);
            } else {
                throw new NonPositiveError;
            }
        }
    }

    public function getCollection()
    {
        return $this->numberCollection;
    }

    public function array_push($inputNumber)
    {
        if ($inputNumber <= 0){
            throw new NonPositiveError;
        } else{
            array_push($this->numberCollection, $inputNumber);
        }

    }

}


$a = new PositiveList();
$a->add([3, 5, 1]);
$a->add([3]);
var_dump($a->getCollection());
$a->add([9, 9, 9]);
var_dump($a->getCollection());
