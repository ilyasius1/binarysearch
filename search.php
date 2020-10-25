<?php
function getTime($time = false) {
    return $time === false ? microtime(true) : round(microtime(true) - $time, 3);
}

function binarySearch($fileName, $key){
    $handle = fopen($fileName, "r");
    $interval = 4000;
    $result = 'Undefined';
    $fileStart = 0;
    $fileEnd = filesize($fileName) - 1;
    $delimeter = '\x0A';
    echo '<br/> key = "';
    print_r($key);
    echo '"<br/>';
    echo '<br/>strlen($delimeter) = ' . strlen($delimeter) . '<br/>';
    //$fileMiddle = floor(($fileStart + ($fileEnd - $fileStart)/2)); //середина
    /*echo '<br/>' . ftell($handle) . '<br/>';
    echo '<br/> fileName ' . $fileName . '<br/>';
    echo '<br/> start ' . $start . '<br/>';
    echo '<br/> end ' . $end . '<br/>';
    echo '<br/> file($fileName) ' . file($fileName) . '<br/>';
    echo '<br/> filesize($fileName) ' . filesize($fileName) . '<br/>';*/
    //$array_shift = null;
    //$array_pop = null;
    while(($fileStart <= $fileEnd) && !feof($handle)){                                                                          //пока не достигнем конца потока
        $fileMiddle = floor(($fileStart + ($fileEnd - $fileStart)/2)); //середина
        fseek($handle, $fileMiddle);                                                                //переходим на $fileMiddle, т.е. на середину файла
        $length = $fileEnd - $fileStart;
        echo '<br/>===================<br/>';
        echo '<br/>$fileStart = ' . $fileStart;
        echo '<br/>$fileMiddle = ' . $fileMiddle;
        echo '<br/>$fileEnd = ' . $fileEnd;
        echo '<br/>length = ' . ($fileEnd - $fileStart);
        echo '<br/>~~~~~~~~~~~~~~~~~~~~~<br/>';
        $string = ($length > $interval) ? fgets($handle, $interval) : fgets($handle, $length);                                                        //берём строку длиной $interval байт начиная с $fileMiddle
        $array = explode($delimeter, $string);                                                          //записываем в массив строки
        echo '<br/>$$string =' . $string;
      //  echo '<br/>$array_pop(prev) + array_shift =' . $array_pop . array_shift($array);
        $array_pop = array_pop($array);                                                             //удаляем последний элемент массива (может быть обрезан)
        $array_shift = array_shift($array);                                                         //удаляем первый элемент массива (может быть обрезан)
        echo '<br/>$array_shift = ' . $array_shift . '<br/>';
        echo '<br/>strlen($array_shift) = ' . strlen($array_shift) . '<br/>';
        echo '<br/>$array_pop = ' . $array_pop . '<br/>';
        echo '<br/>strlen($array_pop) = ' . strlen($array_pop) . '<br/>';
        echo '<br/>$fileMiddle + strlen($array_shift) = ' . ($fileMiddle + strlen($array_shift)) . '<br/>';
        echo '<br/>~~~~~~~~~~~~~~~~~~~~~<br/>';
        //fseek($handle, $fileMiddle + $interval - strlen($array_pop) -1);
        //echo '<br/> $fileMiddle + strlen($array_pop)' . ($fileMiddle + strlen($array_pop));
        //$gaga = fgets($handle, strlen($array_pop));
        //echo '<br/> $gaga = ' . $gaga . '<br/> strlen = ' . strlen($gaga) . '<br/>';
        $pairs = [];
        foreach ($array as $str) {
            $pairs[] = explode('\t', $str);                                                         //каждую строку массива превращаем в массив, где [0] - ключ, [1] - искомое значение        
        }                                                                                           //и загоняем в двумерный массив $pairs
        
        if (strnatcmp($key, $pairs[0][0]) == 0) {                                                   //если искомый ключ в 0 элементе массива $pairs
            $result = '<br/> Искомое значение по ключу "' . $key . '" найдено: ' . $pairs[0][1];
            echo $result;
            return $result;
        }
        elseif (strnatcmp($key, end($pairs)[0]) == 0) {                                             //если искомый ключ в последнем элементе массива $pairs
            $result = '<br/> Искомое значение по ключу "' . $key . '" найдено: ' . end($pairs)[1];
            echo $result;
            return $result;
        }
        elseif (strnatcmp($key, $pairs[0][0]) < 0){                                                 //если искомый ключ перед первым элементом массива $pairs
            
            echo '<br/> $key < $pairs[0][0]: key = "' . $key . '", pairs[0][0] = "' . $pairs[0][0] . '"';
            echo '<br/> $pairs[0][0] = ' . $pairs[0][0];
            echo '<br/> end($pairs)[0] = ' . end($pairs)[0];
            echo '<br/> Делаем $fileEnd = $fileMiddle + strlen($array_shift) + 6<br/>';
            echo '<br/>- - - - - - - - - - - - - - - <br/>';
            $fileEnd = $fileMiddle + strlen($array_shift) + strlen($delimeter) +1;
            //$fileEnd = $fileMiddle - strlen($array_shift) - strlen($delimeter) - 2;                                      //смещаем указатель конца на середину + длина обрезка из начала $array + разделитель +1
            echo '<br/> $fileStart = ' . $fileStart;
            echo '<br/> $fileMiddle = ' . $fileMiddle;
            echo '<br/> $fileEnd = ' . $fileEnd;
            fseek($handle, $fileMiddle);  
            echo '<br/>fseek($handle, $fileMiddle); fgets($handle, strlen($array_shift)) = ' . fgets($handle, strlen($array_shift));
            fseek($handle, $fileEnd-5);  
            echo '<br/>fseek($handle, $fileEnd-5); fgets($handle, strlen($array_shift)+4) = ' . fgets($handle, strlen($array_shift)+4);
            fseek($handle, $fileMiddle + strlen($array_shift) + 5); 
            echo '<br/> fseek($handle, $fileMiddle + strlen($array_shift) + 5) fgets($handle, strlen($array_shift)+4): ' . fgets($handle, strlen($array_shift)+4);
            fseek($handle, $fileEnd);
            echo '<br/> fseek($handle, $fileEnd) fgets($handle, 4): ' . fgets($handle, 4);
            //return true;
        }
        elseif (strnatcmp($key, end($pairs)[0]) > 0) {                                              //если искомый ключ за последним элементе массива $pairs
            //echo '<br/> Искомое значение по ключу "' . $key . '" после диапазона';
            echo '<br/> $pairs[0][0] = ' . $pairs[0][0];
            echo '<br/> end($pairs)[0] = ' . end($pairs)[0];
            echo '<br/> $key > end($pairs)[0]): key = "' . $key . '", end($pairs)[0]) = "' . $pairs[0][0] . '"';
            echo '<br/> Делаем $fileStart = $fileMiddle + $interval - strlen($array_pop) - 7;<br/>';
            echo '<br/>++++++++++++++++++++<br/>';
            //echo '<br/> position = ' . ftell($handle);
            $fileStart = $fileMiddle + $interval - strlen($array_pop) - strlen($delimeter) -1;
            echo '<br/> position + strlen($array_pop) ' . (ftell($handle) + strlen($array_pop));
            echo '<br/> fgets($handle, strlen($array_pop)) = ' . fgets($handle, strlen($array_pop));
            //$fileStart = $fileMiddle + $interval - strlen($array_pop) + strlen($delimeter) +2;                          //смещаем начала на середину + длина интервала - длина обрезка из конца $array - разделитель
            echo '<br/> $fileStart = ' . $fileStart;
            echo '<br/> $fileMiddle = ' . $fileMiddle;
            echo '<br/> $fileEnd = ' . $fileEnd;
            fseek($handle, $fileStart); 
            echo '<br/> $string = ' . $string . '<br/>';
            echo '<br/> $array: <pre>'; print_r($array);
            echo '</pre>';
            echo '<br/>  strlen($array_pop);!! ' .  strlen($array_pop); 
            echo '<br/>  $array_pop); ' .  $array_pop; 
            echo '<br/> fseek($handle, $fileStart); fgets($handle, strlen($array_pop));!! ' . fgets($handle, strlen($array_pop)+5); 
            //return 1;
        }
        else {                                                                                      //если искомый ключ между первым и последним элементами массива
            echo '<br/> Искомое значение по ключу "' . $key . '" где-то внутри...';
            $first = 0;                                                                             //ставим указатель начала на первый элемент массива
            $last = count($pairs) - 1;                                                              //ставим указатель конца на последний элемент массива
            while($first <= $last){                                                                 //пока они не сойдутся
                $middle = floor(($first + ($last - $first)/2));                                     //вычисляем середину
                $compare = strnatcmp($key, $pairs[$middle][0]);                                     //сравниваем искомый ключ с ключом (0-м элементом) середины
                if($compare < 0){                                                                   //если искомый ключ меньше середины 
                    $last = $middle - 1;                                                            //ставим указатель конца на элемент, предшествующий середине
                    //echo '<br/>$pairs[$middle] = '; var_dump($pairs[$middle]);
                    //echo '<br/>$compare = ' . $compare;
                } elseif($compare > 0){                                                             //если искомый ключ больше середины 
                    $first = $middle + 1;                                                           //ставим указатель начала на элемент, следующий за серединой
                    //echo '<br/>$pairs[$middle] = '; var_dump($pairs[$middle]);
                    //echo '<br/>$compare = ' . $compare;
                } else {                                                                            //иначе искомый ключ = середине
                    //echo '<br/>$pairs[$middle] = ' . $pairs[$middle];
                    $result = '<br/> Искомое значение по ключу "' . $key . '" найдено: ' . $pairs[$middle][1];
                    echo $result;
                    return $result;//возвращаем его значение
                }
            }
            echo $result;
            return $result;
        }


    }
    /*echo '<br/><br/> $Pairs: <br/><pre>';
        var_dump($pairs);
    echo '<br/> $array: ';
    print_r($array);
    echo '</pre>';*/
    //echo '<br/> Position ' . $position . '<br/>';
    /*
    while($start <= $end){
        
        echo '<br/>' . ftell($handle) . '<br/>';
        echo '<br/>' . $position . '<br/>';
        //$string = fgets($handle,4000);
        //mb_convert_encoding($string, 'cp1251');
        //$array = explode('\x0A', $string);
        //$last = array_pop($array);
        //foreach($array as $str){
        //    $arr = explode('\t', $str);
        //    $result[] = $arr;
        //}
        /*echo '<br/>';
        print_r($last);
        print_r(strlen($last));
        echo '<br/>';
        print_r(ftell($handle));
        echo '<br/>';
        print_r(ftell($handle) - strlen($last));
        echo '<pre>';
        print_r($array);
        echo '</pre>';
        echo '<br/>';*/
        /*if(!feof($handle)){
            fseek($handle, ftell($handle) - strlen($last));
        }*/    
        
        
    //}
    fclose($handle);
    echo $result;
    return $result;
/*
    echo '<pre>';
    print_r($result);
    echo '</pre>';
    echo '<br/>';*/
}
    
