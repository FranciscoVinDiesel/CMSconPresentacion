
<?php

use yii\widgets\LinkPager;
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>

<?php foreach ($noticias as $key => $value): ?>
    <div class="post-preview">
        <a href="post.html">
            <h2 class="post-title">
                <?= Html::a($value->titulo, ['noticia/' . $value->seo_slug]) ?>

            </h2>
            <p class="post-meta">Fecha de publicación:  <?php echo Yii::$app->formatter->asRelativeTime($value->created_at) ?></p>
           <h5>Autor: <?=     \yii\helpers\ArrayHelper::getValue(dektrium\user\models\User::findOne(['id'=> $value->created_by  ]), 'username');   
     ?></h5>
                   
                            <p align="justify"><?= \yii\bootstrap\Html::tag('span', substr(strip_tags($value->detalle), 0, 100) . '...', [ 'data-toggle' => 'tooltip', 'title' => 'Selecciona el enlace de la noticia para leer más..', 'style' => 'cursor:help;']); ?></p>            
                      
    
    
        </a>
        
    </div>
    <hr>
<?php endforeach; ?>

<!-- Pager -->
<ul class="pager">
    <?php echo LinkPager::widget(['pagination' => $pagination]); ?>
</ul>




