const instructions = ['add global a', 'create foo global', 'add foo b', 'get foo a', 'get foo c', 'create bar foo', 'add bar a', 'get bar a', 'get bar b'];
let namespaces = {
    'global': []
};
instructionsController(instructions, namespaces);

function instructionsController(instructions, namespaces)
{
     instructions.forEach(function (instruction){
    if (instruction.match(/^add/)) {
        namespaces = addFn(instruction, namespaces);
    } else if (instruction.match(/^create/)){
        namespaces = createFn(instruction, namespaces);
    } else if (instruction.match(/^get/)){
        getFn(instruction, namespaces, namespaces);
    } else{
        throw new Error('Unknown instruction');
    }
});

    return namespaces;
}

function addFn(instruction, namespaces)
{
    const slicedInstruction = instruction.split(' ').slice(1);
    if (slicedInstruction.length === 2){
        return processVariableAdding(slicedInstruction, namespaces);

    } else {
        throw new Error('Enter function name and variable name');
    }
}

function createFn(instruction, namespaces)
{
    const slicedInstruction = instruction.split(' ').slice(1);
    if (slicedInstruction.length === 2){
        return processFunctionCreating(slicedInstruction, namespaces);
    } else{
        throw new Error('Enter child function name and parent function name');
    }
}


function getFn(instruction, namespaces)
{
    const slicedInstruction = instruction.split(' ').slice(1);
    if (slicedInstruction.length === 2) {
        processVariableGetting(slicedInstruction, namespaces, namespaces);
    } else {
        throw new Error('Enter function name and variable name');
    }
}

function processVariableAdding(array, namespaces)
{
    const whereToAdd = array[0];
    const variableName = array[1];

    if (Object.keys(namespaces).includes(whereToAdd)){
        namespaces[whereToAdd].push(variableName);
    }

    return namespaces;
}

function processFunctionCreating(array, namespaces)
{
    const childFunctionName = array[0];
    const parentFunctionName = array[1];
    if (Object.keys(namespaces).includes(parentFunctionName)){
        namespaces[parentFunctionName].push(childFunctionName);
        namespaces[childFunctionName] = [];

        return namespaces;
    } else{
        namespaces[parentFunctionName] = [];
        namespaces[parentFunctionName].push(childFunctionName);
        namespaces[childFunctionName] = [];

        return namespaces;
    }
}

function getFromNamespace(namespace, variable, namespaces)
{
    if (namespaces[namespace].includes(variable)){
        return true;
    }
    return false;
}

function processVariableGetting(array, namespaces)
{
    let parent = array[0];
    const variableName = array[1];
    while (parent !== null){
        if (getFromNamespace(parent, variableName, namespaces)){
            console.log(parent);
            return;
        }
        if (parent === 'global'){
            parent = null;
            console.log('None');
        }
        for (let [name, scope] of Object.entries(namespaces)){
            if (scope.includes(parent)){
                parent = name;
            }
        }
    }
}

