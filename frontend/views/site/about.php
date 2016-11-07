<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Este blog fue creado con fines educativos, en la materia Nuevas Técnicas de Programación,
    Francisco Mecia Vélez creador de este blog, estudiante de la PUCESE,cursando el último nivel de la carrera de
    Ingeniería de Sistemas y Computación.
    </p>

    <code><?= __FILE__ ?></code>
</div>
