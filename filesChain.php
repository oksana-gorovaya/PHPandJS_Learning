<?php
function checkFiles()
{
    $fileName = '699991.txt';
    while (preg_match('(^[0-9]+[.]txt$)', $fileName)){
        $path = file_get_contents('https://stepic.org/media/attachments/course67/3.6.3/' . $fileName);
        $fileName = $path;
    }

    return $fileName;
}


echo(checkFiles());