<?php
echo 'simple break';
for($i = 1; $i <= 2; $i++){
    echo "\n".'$i = '.$i.'  ';
    for($j = 1; $j <= 5; $j++) {
        if($j == 2) {
            break;
        }
        echo '$j = '.$j.'  ';
    }
}

echo "<br/>";

echo 'multi-level break';
for($i = 1; $i <= 2; $i++){
    echo "\n".'$i = '.$i.'  ';
    for($j = 1; $j <= 5; $j++) {
        if($j == 2) {
            break 2;
        }
        echo '$j = '.$j.'  ';
    }
}
?>