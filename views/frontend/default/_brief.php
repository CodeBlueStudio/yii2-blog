<?php
use yii\helpers\Html;

$banner = $model->getImageFileUrl('banner');
?>

<div class="col-12 col-md-6 col-lg-4">
    <div class="card mt-4">
        <?php if (!is_null($banner)) { ?>
        <a href="<?= $model->url ?>">
            <img class="card-img-top" alt="<?= Html::encode($model->title) ?>" src="<?= $banner ?>" />
        </a>
        <?php } ?>

        <div class="card-body">
            <span class="font-size-md tc-secundary"><?= Yii::$app->formatter->asDate($model->created_at) ?> by <?= $model->user->username ?></span>
            <h2 class="pt-3 font-size-xlg tc-primary font-light"><?= Html::a(Html::encode($model->title), $model->url); ?></h2>
            <p class="pt-3 font-size-xmd tc-primary"><?= \yii\helpers\HtmlPurifier::process($model->brief) ?></p>
        </div>
    </div>
</div>
