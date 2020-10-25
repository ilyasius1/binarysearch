<?
/*
 * функция для заполнения файла по шаблону
 * @param $fileName - имя файла
 * @param $number - количество добавляемых записей
 * @param $first - если указан, то будет добавление в конец файла начиная с этого номера, default 0
 * @return int
 */
function fillFile($fileName, $number, $first = 0){
    $counter = 0;                                                   //счётчик добавленных записей
    $mode = ($first) ? 'a' : 'w';                                     //тип доступа
    return $mode;
    $handle = fopen($fileName, $mode);
    for($i = $first; $i < $number; $i++){
        $pair = 'ключ' . $i . "\t" . 'значение' . $i . "\x0A";
        fwrite($handle, $pair);
        $counter++;
    }
    fclose($handle);
    return $counter;
}
