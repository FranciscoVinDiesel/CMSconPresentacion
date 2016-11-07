<?php
use kartik\alert\AlertBlock;
?>
<div class="container">

    
    
     <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1" align="justify">
                    <p align="justify"><?= \yii\helpers\ArrayHelper::getValue($noticia, function($noticia,$defaultValue){
        return $noticia[0]['nDetalle'];
    }) ?></p>
       </div>
      </div>
    </div>
    </article>

    <hr>
    
   
  
 
 
    
</div>

