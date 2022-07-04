<?php

$file = file_get_contents('emails.txt');
$emails = json_decode($file);
$screen = $emails->models[0]->data->contact;

$fp = fopen('card.vcf', 'a');

foreach ($screen as &$value) {
    fwrite($fp,"BEGIN:VCARD".PHP_EOL."VERSION:3.0".PHP_EOL."FN:".$value->name->first." ".$value->name->last.PHP_EOL."N:".$value->name->last.";".$value->name->first.";;;".PHP_EOL."EMAIL;TYPE=INTERNET;TYPE=WORK:".$value->email[0]->value.PHP_EOL."END:VCARD".PHP_EOL);
}

fclose($fp);

?>
