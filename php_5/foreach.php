<?php
    // foreach
    $fruits = ["apple","banana","orange","grapes"];
    foreach($fruits as $fruit)
    {
        echo $fruit;
        echo "<br/>";
    }
    $employee = [
        "name" => "john smith",
        "age" => 30,
        "profession" => "software engineer"
    ];
    foreach($employee as $key => $value)
    {
        echo sprintf("%s: %s</br>",$key,$value);
        echo "<br/>";
    }
?>