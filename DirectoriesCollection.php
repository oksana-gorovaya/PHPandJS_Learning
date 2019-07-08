<?php
class DirectoriesCollection
{
    function __construct($pathToArchive, $archiveName)
    {
        $this->$pathToArchive = $pathToArchive;
        $this->archiveName = $archiveName;
        $this->path = sys_get_temp_dir() . '/' . $archiveName;
        $this->extractArchive($pathToArchive);

    }

    private function extractArchive($pathToArchive)
    {
        $zip = new ZipArchive();
        $extractedData = $zip->open($pathToArchive);
        if ($extractedData) {
            $zip->extractTo(sys_get_temp_dir());
            $zip->close();
        } else {
            throw new Exception('cannot extract from archive');
        }
    }

    private function removeTempDir($path)
    {
        if (is_dir($path)) {
            $objects = scandir($path);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($path."/".$object))
                        $this->removeTempDir($path."/".$object);
                    else
                        unlink($path."/".$object);
                }
            }
            rmdir($path);
        }
    }

    public function showDirectories($extension, $outputFile)
    {
        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->path), RecursiveIteratorIterator::SELF_FIRST);
        $directories = [];
        foreach($objects as $location => $object){
            $name = $object->getFileName();
            if (pathinfo($name, PATHINFO_EXTENSION) === $extension){
                $withoutName = str_replace($name, '', $location);
                $withoutParent = str_replace(sys_get_temp_dir() . '/', '', $withoutName);
                if (in_array($withoutParent, $directories)){
                    continue;
                }  else {
                    array_push($directories, $withoutParent . "\n");
                }
            }
        }
        sort($directories);
        file_put_contents($outputFile, $directories);
        $this->removeTempDir($this->path);
        return readfile($outputFile);
    }
}
$a = new DirectoriesCollection(readline('Path to archive'),readline('Archive name'));
var_dump($a->showDirectories(readline('File extension without a dot'), readline('Path to output file')));
