<?
$file = dirname(__FILE__) . "\\file";
include_once 'search.php';
include_once 'fill.php';
include_once 'tester.php';

if(isset($_POST['text'])) {
    $key = $_POST['text'];
    $time = time();
    $result = binarySearch($file, $key);
    $time = time() - $time;
}
$error = null;
$msg = null;
if(isset($_GET['fill'])){
    $number = $_GET['fill'];
    $first = $_GET['first'] ?? 0;
    $rows = fillFile($file, $number, $first);
    if (!$rows){
        $error = "Ошибка заполнения файла!";
    } else {
        $msg = "В файл успешно записано " . $rows . "строк!";
        //header('Location:index.php');
        //exit;
    }
}
if(isset($_POST['firstindex']) || isset($_POST['lastindex'])){
    $firstindex = $_POST['firstindex'] ?? '0';
    $lastindex = $_POST['lastindex'];
    tester($file, $lastindex, $firstindex );
}
require_once 'form.php';
if($error): ?>
<p style="color: red"><?=$error;?></p>
<?php else:?>
<p><?=$msg ?? ''?></p>
<p><?=$msg ?? ''?></p>
<H1>Результат:</H1>
<p>ФАйл: <?=$file?>;</p>
    Key = <?=$key?>;<br/>
    Value = <?=$result?>;<br/>
    Lead time = <?=$time?> sec.
<?php endif?>