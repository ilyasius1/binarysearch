<?php


set_time_limit(0);


function binarySearch($fileName, $key)
{
    $file = new SplFileObject($fileName);
    $fileStart = 0;
    $fileEnd = filesize($fileName) - 1;
    $file->fseek($fileStart);
//    echo '<br/>$file->current()='; var_dump($file->current());
//    echo '<br/>$file->current()='; var_dump($file->current());
//    echo '<br/>$file->fgets()='; var_dump($file->fgets());
//    echo '<br/>$file->fgets()='; var_dump($file->fgets());
//    echo '<br/>$file->fgets()='; var_dump($file->fgets());
//    echo '<br/>$file->fgets()='; var_dump($file->fgets());
    echo '<br/>$file->current()='; var_dump($file->current());
//    echo '<br/>$key = ' . $key;
//    echo '<br/>$fileStart = ' . $fileStart . '<br/>';
    while ($fileStart <= $fileEnd) {
        $position = floor(($fileStart + $fileEnd) / 2);

//        echo '<br/>$fileStart = ' . $fileStart . '<br/>';
//        echo '<br/>$fileEnd = ' . $fileEnd . '<br/>';
        $file->fseek($position);
        $file->current();
//        echo '<br/>$position = ' . $position . '<br/>';
//        echo '<br/>$file->current() ' . $file->current();
        $str = explode("\t", $file->fgets());
//        if($file->key() != 0) {
//            $str = explode("\t", $file->fgets());
//        }else {
//            $str = explode("\t", $file->current());
//        }
//
//        echo '<br/>$str = ';
//        print_r($str);
//        echo '<br/>';
        $strnatcmp = strnatcmp($str[0], trim($key));

        if ($strnatcmp > 0) {
            $fileEnd = $position - 1;
        } elseif ($strnatcmp < 0) {
            $fileStart = $position + 1;
        } else {
            return rtrim($str[1]);
        }
    }
    return 'undef'; // не найденно значение
}

//$fileName = 'D:\file';
//$key = 'key2';

//$time = time();
//$result = binarySearch($fileName, $key);
//$time = time() - $time;

//echo 'Key - ' . $key . "; Value - " . $result . ";" . "Lead time - " . $time . " sec.";

