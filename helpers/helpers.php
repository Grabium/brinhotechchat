<?php
function formatDate(string $date, string $format = 'd/m/Y \à\s H:i:s', string $timezone = 'America/Sao_Paulo'): string
{
    $carbonDate = \Carbon\Carbon::parse($date)->setTimezone($timezone); 
    return $carbonDate->format($format);
}