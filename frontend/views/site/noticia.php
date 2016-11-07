<?php
use kartik\alert\AlertBlock;
?>
<div class="container">
    <br><br><br><br>

    <h1><?= \yii\helpers\ArrayHelper::getValue($noticia, function($noticia,$defaultValue){
        return $noticia[0]['nTitulo'];
    }) ?></h1>
   
     <p><?=     \yii\helpers\ArrayHelper::getValue(dektrium\user\models\User::findOne(['id'=>  \yii\helpers\ArrayHelper::getValue($noticia, function($noticia,$defaultValue){
        return $noticia[0]['nAutor'];}) ]), 'username');   
     ?></p>
    
    <p><?=     \yii\helpers\ArrayHelper::getValue(\common\models\Categoria::findOne(['id'=>  \yii\helpers\ArrayHelper::getValue($noticia, function($noticia,$defaultValue){
        return $noticia[0]['nCategoria'];}) ]), 'categoria');   
     ?></p>
    
    
     <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <p><?= \yii\helpers\ArrayHelper::getValue($noticia, function($noticia,$defaultValue){
        return $noticia[0]['nDetalle'];
    }) ?></p>
       </div>
      </div>
    </div>
    </article>

    <hr>
    
   
  
 
 
    
</div>

