<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\Module;
use kartik\markdown\MarkdownEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-post-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-sm-9">
            <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>
            <?= $form->field($model, 'brief')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'banner')->fileInput() ?>

            <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::class, [
                'moduleId' => $model->module->redactorModule,
                'clientOptions' => [
                    'plugins' => ['clips', 'fontcolor', 'imagemanager']
                ]
            ]); ?>

            <?= Html::submitButton($model->isNewRecord ? Module::t('blog', 'Create') : Module::t('blog', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(BlogCategory::get(0, BlogCategory::find()->all()), 'id', 'str_label')) ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => 128]) ?>
            <?= $form->field($model, 'tags')->textInput(['maxlength' => 128]) ?>
            <?= $form->field($model, 'status')->dropDownList(\akiraz2\blog\models\BlogPost::getStatusList()) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>


</div>
