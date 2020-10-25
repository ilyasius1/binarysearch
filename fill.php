<?

$file = dirname(__FILE__) . "\\file";
$count = $_GET['count'];
function fillFile($fileName, $n){
    $c = 0;
    $handle = fopen($fileName, 'w');
    for($i = 0; $i < $n; $i++){
        $pair = 'ключ' . $i . '\t' . 'значение' . $i . '\x0A';
        fwrite($handle, $pair);
        $c++;
    }
    fclose($handle);
    return $c;
}
if (!fillFile($file, $count)){
    return "Error";
} else {
    header('Location:index.php');
    exit;
}
