<?php

use akiraz2\blog\Module;
use yii\helpers\Html;

?>
<div class="panel panel-primary">
    <div class="panel-heading">Blog</div>
    <div class="list-group">
        <?= Html::a(Module::t('blog', 'Posts'), ['/blog/blog-post'], ['class' => 'list-group-item']); ?>
        <?= Html::a(Module::t('blog', 'Categories'), ['/blog/blog-category'], ['class' => 'list-group-item']); ?>
        <?= Html::a(Module::t('blog', 'Comments'), ['/blog/blog-comment'], ['class' => 'list-group-item']); ?>
        <?= Html::a(Module::t('blog', 'Tags'), ['/blog/blog-tag'], ['class' => 'list-group-item']); ?>
    </div>
</div>