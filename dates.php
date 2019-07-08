<?php
$inputDate = readline('Insert initial date: ');
$inputDays = readline('Insert days: ');
$formattedInputDate = formatInputDate($inputDate);
$date = new DateTime($formattedInputDate);
$date->add(new DateInterval('P'.$inputDays.'D'));
$outputDate = $date->format('Y-m-d') . "\n";
$formattedOutputDate = formatOutputDate($outputDate);
echo $formattedOutputDate;

function formatInputDate($inputDate)
{
    return str_replace(' ', '-', $inputDate);
}

function formatOutputDate($outputDate)
{
    return str_replace('-', ' ', $outputDate);
}