<?php
function operasi($n){
    $times = 0;
    while($n != 1 && $n >= 0){
        echo $n. " -> ";

        if ($n % 2 == 0) {
            $n = $n / 2;
            $times++;
        }else {
            $n = ($n * 3) + 1;
            $times++;
        }
    }
    echo $n;
    echo "<br />Number Of Operations: " . $times;
}
operasi(12);
?>