<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use akiraz2\blog\Module;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\blog\models\BlogTagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('blog', 'Blog Tags');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-tag-index">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <div class="row">
        <div class="col-sm-9">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\CheckboxColumn'],

                    'id',
                    'name',
                    'frequency',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>

        <div class="col-sm-3">
            <?= $this->render('@codebluestudio/yii2-blog/views/backend/_menu'); ?>
        </div>
    </div>
</div>
