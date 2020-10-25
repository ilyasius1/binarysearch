<?php

function getTime($time = false) {
    return $time === false ? microtime(true) : round(microtime(true) - $time, 3);
}
/* Функция бинарного поиска значения по ключу
 * @param $fileName - имя файла
 * @param $key - искомый ключ
 * @return string - найденное значение или 'undef'
 */
function binarySearch($fileName, $key)
{
    $file = new SplFileObject($fileName);                                           //создаем объект
    $fileStart = 0;                                                                 //определяем позицию начала ..
    $fileEnd = filesize($fileName) - 1;                                             //.. и конца файла

    $file->fseek($fileStart);                                                       //переходим на начало файла
    $file->fgets();                                                                 //считываем строку, попадая на начало 2-й строки
    $firstStringLength = $file->ftell()-1;                                          //убираем 1 от текущей позиции (переход на строку) и получаем длину 1 строки

    $file->fseek($fileStart);                                                       //возвращаемся на нулевую позицию

    while ($fileStart <= $fileEnd) {                                                //пока начало и конец файла не сойдутся
        $position = floor(($fileStart + $fileEnd) / 2);                       //ставим текущую позицию чтения на..
        $file->fseek($position);                                                    //.. середину файла
        $file->current();
        if($position < $firstStringLength) {                                        //если находимся на первой строке
            $file->next();                                                          //то считываем не следующую строку целиком,
            $file->fseek($fileStart);
            $str = explode("\t", $file->fread($firstStringLength));         //а только количество байт = длине первой строки, т.е. $firstStringLength
        }
        else{                                                                       //в противном случае, считываем следующую строку
            $str = explode("\t", $file->fgets());
        }
        $strnatcmp = strnatcmp($str[0], trim($key));

        if ($strnatcmp > 0) {                                                       //если полученная строка больше ключа
            $fileEnd = $position - 1;                                               //помещаем конец файла перед текущей серединой
        } elseif ($strnatcmp < 0) {                                                 //если полученная строка больше ключа
            $fileStart = $position + 1;                                             //помещаем начало файла за текущей серединой
        } else {
            return rtrim($str[1]);                                                  //строка найдена
        }
    }
    return 'undef';                                                                 // не найденно значение
}
