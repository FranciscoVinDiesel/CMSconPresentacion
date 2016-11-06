<?php
use kartik\alert\AlertBlock;
?>
<div class="container">
    <br><br><br><br>

    <h1><?= \yii\helpers\ArrayHelper::getValue($noticia, function($noticia,$defaultValue){
        return $noticia[0]['nTitulo'];
    }) ?></h1>
   
    <h1><?= \yii\helpers\ArrayHelper::getValue($noticia, function($noticia,$defaultValue){
        return $noticia[0]['nDetalle'];
    }) ?></h1>
    
    <h1><?=     \yii\helpers\ArrayHelper::getValue(dektrium\user\models\User::findOne(['id'=>  \yii\helpers\ArrayHelper::getValue($noticia, function($noticia,$defaultValue){
        return $noticia[0]['nAutor'];}) ]), 'username');   
     ?></h1>
    
    <h1><?=     \yii\helpers\ArrayHelper::getValue(\common\models\Categoria::findOne(['id'=>  \yii\helpers\ArrayHelper::getValue($noticia, function($noticia,$defaultValue){
        return $noticia[0]['nCategoria'];}) ]), 'categoria');   
     ?></h1>
    
  
 
 
    
</div>

