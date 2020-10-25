<?php
//$file = dirname(__FILE__) . "\\file";
include_once 'search.php';
function tester($file, $lastindex, $firstindex = 0) {
    for($i = $firstindex; $i <= $lastindex; $i++) {
        $key = 'ключ' . $i;
        $value = binarySearch($file, $key);
        $etalon = 'значение' . $i;
        echo '$value = ' . $value;
        echo '<br/>$key = ' . $key;
        echo '<br/> четыреждыблядскаяярость! ' .strnatcmp($value, 'значение' . $i);
        echo '<br/> НЕчетыреждыблядскаяярость! '; var_dump(!strnatcmp($value, 'значение' . $i));
        if(strnatcmp($value, 'значение' . $i)){
            echo '<p style="color: crimson">Несоответствие: </p>';
            echo '<p>key = ' . $key .'; </p>';
            echo '<p>value = ' . $value . '; strlen($value) = '. strlen($value) . '; </p>';
            echo '<p>Должно быть value = ' . $etalon . '; strlen($etalon) = '. strlen($etalon) . ';</p>';
            echo '==============================================<br/>';
        }
        else {
            $successed[] = $i;
        }
    }
    echo '<br/> Всего протестировано: (' . ($i - $firstindex) .')';
    echo '<br/> Успешные индексы: (' . count($successed) .')';
    echo '<pre>';
    print_r($successed);
    echo '</pre>';
}
