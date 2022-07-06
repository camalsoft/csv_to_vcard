<?php 

$i=0;
$n=999 //pages of address;
while ($i<=$n){
$i++;
shell_exec("curl 'https://admin.yandex.ru/api/models?_models=directory/get-users!!!COOKIE AND BROWSER SETTINGS!!! >> file_".$i.".txt");
}

$fp = fopen('card_big.vcf', 'a');
$i=0;
while ($i<93){
    $i++;
    $file = file_get_contents('file_'.$i.'.txt');
    $emails = json_decode($file);
    $screen=$emails->models[0]->data->result;
    foreach ($screen as &$value) {
        fwrite($fp,"BEGIN:VCARD".PHP_EOL."VERSION:3.0".PHP_EOL."FN:".$value->name->first." ".$value->name->last.PHP_EOL."N:".$value->name->last.";".$value->name->first.";;;".PHP_EOL."EMAIL;TYPE=INTERNET;TYPE=WORK:".$value->email.PHP_EOL."END:VCARD".PHP_EOL);
    }
}
fclose($fp);

?>
