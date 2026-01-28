<?php
echo 'simple continue';
for($i = 1; $i <= 2; $i++) {
    echo "\n".'$i = '.$i.'  ';
    for($j = 1; $j <= 5; $j++) {
        if($j == 2) {
            continue;
        }
        echo '$j = '.$j.'  ';
    }
}

echo "<br/>";
echo 'multi-level continue';
for($i = 1; $i <= 2; $i++) {
    echo "\n".'$i = '.$i.'  ';
    for($j = 1; $j <= 5; $j++) {
        if($j == 2) {
            continue 2;
        }
        echo '$j = '.$j.'  ';
    }
}
?>