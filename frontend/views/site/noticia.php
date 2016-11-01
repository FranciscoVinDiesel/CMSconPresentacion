<?php
use kartik\alert\AlertBlock;
?>
<div class="container">
    <br><br><br><br>

    <h1><?= $noticia->titulo ?></h1>
    Categoría: <?= $noticia->categoria->categoria ?><br>
    
    
    <?= $noticia->detalle ?>
    
 
    
</div>

