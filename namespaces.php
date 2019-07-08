<?php
$instructionsNumber = intval(readline());
$instructions = [];

while (sizeof($instructions) < $instructionsNumber){
    $anotherInstruction = trim(readline());
    array_push($instructions, $anotherInstruction);
};

$namespaces = [
    'global'=> []
];

instructionsController($instructions, $namespaces);

function instructionsController($instructions, $namespaces)
{
    foreach ($instructions as $instruction) {
        if (preg_match('/^add/', $instruction)) {
            $namespaces = addFn($instruction, $namespaces);
            } elseif (preg_match('/^create/', $instruction)){
                $namespaces = createFn($instruction, $namespaces);
            } elseif (preg_match('/^get/', $instruction)){
                getFn($instruction, $namespaces, $namespaces);
            } else{
                throw new Exception('Unknown instruction');
            }
        }

    return $namespaces;
}


function addFn($instruction, $namespaces)
{
    $slicedInstruction = array_slice(explode(' ', $instruction), 1);
    if (sizeof($slicedInstruction) === 2){
        return processVariableAdding($slicedInstruction, $namespaces);

    } else {
        throw new Exception('Enter function name and variable name');
    }
}

function createFn($instruction, $namespaces)
{
    $slicedInstruction = array_slice(explode(' ', $instruction), 1);
    if (sizeof($slicedInstruction) === 2){
        return processFunctionCreating($slicedInstruction, $namespaces);
    } else{
        throw new Exception('Enter child function name and parent function name');
    }
}

function getFn($instruction, $namespaces)
{
    $slicedInstruction = array_slice(explode(' ', $instruction), 1);
    if (sizeof($slicedInstruction) === 2) {
        processVariableGetting($slicedInstruction, $namespaces, $namespaces);
    } else {
            throw new Exception('Enter function name and variable name');
        }
}

function processVariableAdding($array, $namespaces)
{
    $whereToAdd = $array[0];
    $variableName = $array[1];

    if (in_array($whereToAdd, array_keys($namespaces))){
        array_push($namespaces[$whereToAdd], $variableName);
    }

    return $namespaces;
}

function processFunctionCreating($array, $namespaces)
{
    $childFunctionName = $array[0];
    $parentFunctionName = $array[1];
    if (in_array($parentFunctionName, array_keys($namespaces))){
        array_push($namespaces[$parentFunctionName], $childFunctionName);
        $namespaces[$childFunctionName] = [];

        return $namespaces;
    } else{
        $namespaces[$parentFunctionName] = [];
        array_push($namespaces[$parentFunctionName], $childFunctionName);
        $namespaces[$childFunctionName] = [];

        return $namespaces;
    }
}

function getFromNamespace($namespace, $variable, $namespaces)
{
    if (in_array($variable, $namespaces[$namespace])){
        return true;
    }
    return false;
}

function processVariableGetting($array, $namespaces)
{
    $parent = $array[0];
    $variableName = $array[1];
    while ($parent != null){
        if (getFromNamespace($parent, $variableName, $namespaces)){
            var_dump($parent);
                return;
        }
        if ($parent === 'global'){
            $parent = null;
            var_dump('None');
        }
        foreach($namespaces as $name => $scope){
            if (in_array($parent, $scope)){
                $parent = $name;
            }
        }
    }
}


