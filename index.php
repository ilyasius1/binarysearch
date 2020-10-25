<?
include_once 'form.php';
include_once 'search.php';
$file = dirname(__FILE__) . "\\file";
if(count($_POST) > 0) {
    $text = $_POST['text'];
    $result = binarySearch($file, $text);
}
?>
<H1>Результат:</H1>
<p><?=$result?></p>
