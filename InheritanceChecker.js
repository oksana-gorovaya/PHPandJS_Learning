const InheritanceChecker = class {
    constructor(classesLineage, requests){
        this.classesLineage = classesLineage;
        this.requests = requests;
    }

    sortRelatives(classesLineage)
    {
        let classesRelation = {};
        let splittedClasses = [];
        classesLineage.forEach(function(customClass){
            splittedClasses.push(customClass.split(':'));

        });
        splittedClasses.forEach(function(item){
            if (item.length > 1){
                classesRelation[item[0].trim()] = item[1].trim().split(' ');
            } else{
                classesRelation[item[0].trim()] = ['None'];
            }
        });

        return classesRelation;
    }


    checkRequests(requests, classesRelation, findAncestor)
    {
        let splittedRequests = [];
        requests.forEach(function(request){
            splittedRequests.push(request.split(' '));

        });
        splittedRequests.forEach(function(pair){
            if (InheritanceChecker.findAncestor(classesRelation, pair[1], pair[0], []) !== null){
                console.log('Yes');
            } else{
                console.log('No');
            }
        });
    }

    static findAncestor(classesRelation, start, end, path)
    {
        path.push(start);
        if (!Object.keys(classesRelation).includes(start)){
            return null;
        }

        if (start === end){
            return path;
        }

        for (let node of classesRelation[start]){
            let newpath;
            if (!(node in path)){
                newpath = InheritanceChecker.findAncestor(classesRelation, node, end, path);
            }
            if (newpath){
                return newpath;
            }
        }

        return null;
    }
};

const classesLineage = ['A', 'B : A', 'C : A', 'D : B C'];
const requests = ['A B', 'B D', 'C D', 'D A'];
let pathFinder = new InheritanceChecker(classesLineage, requests);
pathFinder.classesRelation = pathFinder.sortRelatives(pathFinder.classesLineage);
pathFinder.checkRequests(pathFinder.requests, pathFinder.classesRelation, pathFinder.findAncestor);