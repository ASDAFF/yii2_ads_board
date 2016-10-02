<?php

foreach($list as $item){
    echo $item->title . "<br>";
    echo $item->state . "<br>";
    echo $item->cost . "<br>";
    echo $item->date_publish . "<br>";
    //var_dump($item->category);
    foreach($item as $it){
        var_dump($it);
    }
}