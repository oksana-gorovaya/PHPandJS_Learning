<?php
$inputDate = readline('Insert initial date: ');
$inputDays = readline('Insert days: ');
$formattedInputDate = formatInputDate($inputDate);
$date = new DateTime($formattedInputDate);
$date->add(new DateInterval('P'.$inputDays.'D'));
$outputDate = $date->format('Y-m-d') . "\n";
$formattedOutputDate = formatOutputDate($outputDate);
echo $formattedOutputDate;

function formatInputDate(string $inputDate): string
{
    return str_replace(' ', '-', $inputDate);
}

function formatOutputDate(string $outputDate): string
{
    return str_replace('-', ' ', $outputDate);
}