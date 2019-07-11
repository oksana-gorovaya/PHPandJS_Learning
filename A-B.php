<?php
/*Рассмотрим два HTML-документа A и B.
Из A можно перейти в B за один переход, если в A есть ссылка на B, т. е. внутри A есть тег <a href="B">, возможно с
дополнительными параметрами внутри тега.
Из A можно перейти в B за два перехода если существует такой документ C, что из A в C можно перейти за один переход и
из C в B можно перейти за один переход.

Вашей программе на вход подаются две строки, содержащие url двух документов A и B.
Выведите Yes, если из A в B можно перейти за два перехода, иначе выведите No.*/
$pageA = trim(readline());
$pageB = trim(readline());
$pageContent = checkPage($pageA);
var_dump(comparePages($pageB, $pageContent));

function checkPage($pageA)
{
    $curlInstance = curl_init($pageA);
    curl_setopt($curlInstance, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($curlInstance);
    $links = [];
    if (curl_getinfo($curlInstance, CURLINFO_RESPONSE_CODE) === 200){
        foreach (explode('"', $data) as $item){
            if (strpos($item, 'http') !== false){
                array_push($links, $item);
            }
        }
    }
    curl_close($curlInstance);

    return $links;
}

function comparePages($pageB, $pageContent)
{
    foreach ($pageContent as $item){
        $nestedLinks = checkPage($item);
        if (in_array($pageB, $nestedLinks)){
            return 'Yes';
        }
    }

    return 'No';
}