<?php

foreach($list as $item){
    echo $this->render('shortView',[
        'item' => $item,
    ]);
}
