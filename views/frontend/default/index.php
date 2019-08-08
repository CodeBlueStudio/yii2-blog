<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use akiraz2\blog\Module;
use yii\widgets\ListView;

$this->title = 'Blog';

Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => 'Blog about Design, Ionic 4, React, Flutter & Android frameworks'
]);
Yii::$app->view->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Design, Ionic 4, React, Flutter, Android'
]);

if (Yii::$app->get('opengraph', false)) {
    Yii::$app->opengraph->set([
        'title' => $this->title,
        'description' => Module::t('blog', 'Blog'),
    ]);
}
?>


<section class="my-5 about-page">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <h1 class="font-size-xxlg tc-primary ml-5 mt-5 font-bold">DevsPush Blog</h1>
                <p class="font-size-lg tc-primary ml-5">Blog about Design, Ionic 4, React, Flutter & Android frameworks</p>
            </div>
        </div>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_brief',
            'options' => [
                'class' => 'row',
                'id' => false
            ],
            'itemOptions' => [
                'tag' => false
            ],
            'layout' => '{items}{pager}'
        ]); ?>

        <?php /*
        <div class="row">
            <div class="col-12 my-5">
                <!-- Pagination -->
                <ul class="pagination d-flex justify-content-center my-3">
                    <li class="active"><a href="#" class="previous tc-secundary font-size-xmd font-medium">Previous</a></li>
                    <li class="font-size-xmd font-medium active"><a href="#">1</a></li>
                    <li class="font-size-xmd font-medium"><a href="#">2</a></li>
                    <li class="font-size-xmd font-medium"><a href="#">3</a></li>
                    <li class="font-size-xmd font-medium"><a href="#">4</a></li>
                    <li><a href="#" class="next tc-secundary font-size-xmd font-medium">Next</a></li>
                </ul>
            </div>
        </div>
        */ ?>
    </div>
</section>


