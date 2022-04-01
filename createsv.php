<?php

function csv_to_array($filename, $delimiter)
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}

$array1=csv_to_array('users.csv',';');

$fp = fopen('card.vcf', 'a');


foreach ($array1 as $key => $value){
    fwrite($fp,"BEGIN:VCARD".PHP_EOL."VERSION:3.0".PHP_EOL."FN:".$value['namefirst']." ".$value['namelast'].PHP_EOL."N:".$value['namelast'].";".$value['namefirst'].";;;".PHP_EOL."EMAIL;TYPE=INTERNET;TYPE=WORK:".$value['email'].PHP_EOL."END:VCARD".PHP_EOL);
}

fclose($fp);

?>