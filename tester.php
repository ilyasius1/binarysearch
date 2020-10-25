<?php

include_once 'search.php';

/*
 * Функция для тестирования binarySearch(). На больших файлах выполнение может прерваться по таймауту, поэтому необходимо указывать ограничители
 * @param $fileName имя файла, аргумент для binarySearch()
 * @param $lastindex - конечный индекс для проверки
 * @param $firstindex - начальный индекс для проверки
 * @return
 */
function tester($fileName, $lastindex, $firstindex = 0) {
    for($i = $firstindex; $i <= $lastindex; $i++) {
        $key = 'ключ' . $i;                                                                         //ключ по шаблону
        $value = binarySearch($fileName, $key);                                                     //полученное с помощью поиска значение
        $etalon = 'значение' . $i;                                                                  //эталон, каким должно быть значение
        if(strnatcmp($value, 'значение' . $i)){                                                 //если результат не соответствует ожиданию, он выводится
            $result[0] = '<p style="color: crimson">Несоответствие: </p>';
            $result[0] .= '<p>key = ' . $key .'; </p>';
            $result[0] .= '<p>value = ' . $value . '; strlen($value) = '. strlen($value) . '; </p>';
            $result[0] .= '<p>Должно быть value = ' . $etalon . '; strlen($etalon) = '. strlen($etalon) . ';</p>';
            $result[0] .= '==============================================<br/>';
        }
        else {
            $successed[] = $i;                                                                      //в случае успеха номер добавляется в массив успешно проверенных
        }
    }
    $result[0] = '<br/> Всего протестировано: (' . ($i - $firstindex) .')';
    $result[0] .= '<br/> Успешные индексы: (' . count($successed) .')';
    $result[1] = $successed;
    return $result;
}
