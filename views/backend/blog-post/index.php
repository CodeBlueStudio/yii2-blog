<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use akiraz2\blog\models\BlogPost;
use akiraz2\blog\models\Status;
use akiraz2\blog\Module;
use akiraz2\blog\traits\IActiveStatus;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\blog\models\BlogPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('blog', 'Blog Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-index">
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
                    [
                        'attribute' => 'category_id',
                        'value' => function ($model) {
                            return $model->category->title;
                        },
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'category_id',
                            BlogPost::getArrayCategory(),
                            ['class' => 'form-control', 'prompt' => Module::t('blog', 'Please Filter')]
                        )
                    ],

                    [
                        'attribute' => 'title',
                        'value' => function ($model) {
                            if (strlen($model->title) > 55) {
                                return substr($model->title, 0, 50) . '...';
                            }

                            return $model->title;
                        }
                    ],

                    'title',

                    [
                        'attribute' => 'status',
                        'format' => 'html',
                        'value' => function ($model) {
                            if ($model->status === IActiveStatus::STATUS_ACTIVE) {
                                $class = 'label-success';
                            } elseif ($model->status === IActiveStatus::STATUS_INACTIVE) {
                                $class = 'label-warning';
                            } else {
                                $class = 'label-danger';
                            }

                            return '<span class="label ' . $class . '">' . $model->getStatus() . '</span>';
                        },
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'status',
                            BlogPost::getStatusList(),
                            ['class' => 'form-control', 'prompt' => Module::t('blog', 'Status')]
                        )
                    ],
                    'created_at:date',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'  => '{update}{delete}',
                        'buttons'   => [
                            'update'    => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span> Update', $url, [
                                    'class'         => 'btn btn-primary btn-xs',
                                    'title'         => 'Update',
                                    'aria-label'    => 'Update',
                                    'data-pjax'     => 0
                                ]);
                            },

                            'delete'    => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', $url, [
                                    'class'         => 'btn btn-danger btn-xs',
                                    'title'         => 'Delete',
                                    'aria-label'    => 'Delete',
                                    'data-pjax'     => 1,
                                    'data-confirm'  => 'Are you sure you want to delete this item?',
                                    'data'          => [
                                        'method'    => 'POST'
                                    ],
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>

        <div class="col-sm-3">
            <?= $this->render('@codebluestudio/yii2-blog/views/backend/_menu'); ?>
        </div>
    </div>
</div>
