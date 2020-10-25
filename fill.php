<?

function fillFile($fileName, $number, $first = 0){
    $counter = 0;
    $handle = fopen($fileName, 'w');
    for($i = $first; $i < $number; $i++){
        $pair = 'ключ' . $i . "\t" . 'значение' . $i . "\x0A";
        fwrite($handle, $pair);
        $counter++;
    }
    fclose($handle);
    return $counter;
}
