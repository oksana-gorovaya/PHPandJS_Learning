<?php
class InheritanceChecker{
    public $classesNumber;
    public $classesLineage;
    public $classesRelation;
    public $requestsNumber;
    public $requests;


    public function fillDynamicArray($entriesNumber)
    {
        $arrayToFill = [];
        while (sizeof($arrayToFill) < $entriesNumber){
            $anotherEntry = readline();
            array_push($arrayToFill, $anotherEntry);
        }

        return $arrayToFill;
    }


    public function sortRelatives($classesLineage)
    {
        $classesRelation = [];
        $splittedClasses = [];
        foreach ($classesLineage as $customClass){
            array_push($splittedClasses, explode(':', $customClass));
        }

        foreach ($splittedClasses as $item){
            if (sizeof($item) > 1){
                $classesRelation[trim($item[0])] = explode(' ', trim($item[1]));
            } else{
                $classesRelation[trim($item[0])] = ['None'];
            }
        }

        return $classesRelation;
    }

    public function checkRequests($requests, $classesRelation)
    {
        $splittedRequests = [];
        foreach ($requests as $request){
            array_push($splittedRequests, explode(' ', $request));
        }

        foreach ($splittedRequests as $pair){
            if ($this->findAncestor($classesRelation, $pair[1], $pair[0], []) !== null){
                var_dump('Yes');
            } else{
                var_dump('No');
            }
        }
    }

    private function findAncestor($classesRelation, $start, $end, $path)
    {
        $path += [$start];
        var_dump($path, 'end');
        if (!in_array($start, array_keys($classesRelation))){
            return null;
        }

        if ($start == $end){
            return $path;
        }
        foreach ($classesRelation[$start] as $node){
            if (!in_array($node, $path)){
                $newpath = $this->findAncestor($classesRelation, $node, $end, $path);

            }
            if ($newpath){

                return $newpath;
            }
        }

        return null;
    }
}

$pathFinder = new InheritanceChecker();
$pathFinder->classesNumber = readline();
$pathFinder->classesLineage = $pathFinder->fillDynamicArray($pathFinder->classesNumber);
$pathFinder->requestsNumber = readline();
$pathFinder->classesRelation = $pathFinder->sortRelatives($pathFinder->classesLineage);
$pathFinder->requests = $pathFinder->fillDynamicArray($pathFinder->requestsNumber);
$pathFinder->checkRequests($pathFinder->requests, $pathFinder->classesRelation);