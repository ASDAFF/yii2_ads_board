<?php
use yii\helpers\BaseHtml;
?>
<div class="row">
    <div id="category-btn" >
        <h6>Категории</h6>
    </div>
    <div id="category">

    <?php
    for($i=0;$i<count($list);$i++){
        ?>

        <div class="col-md-3">
            <?php
            for($j=0;$j<count($list[$i]);$j++){
                if($j != 0){
                    echo BaseHtml::a($list[$i][$j]->name,['adsense/index', 'category' => $list[$i][$j]->name]) . '<br>';
                }else{
                    echo '<h5>' . $list[$i][$j]->name . '</h5>';
                }
            }
            ?>
        </div>
    <?php
    }

    ?>
    </div>
</div>