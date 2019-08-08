<?php

/* @var $this \yii\web\View */
/* @var $post \akiraz2\blog\models\BlogPost */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use akiraz2\blog\models\BlogPost;
use akiraz2\blog\Module;
use yii\helpers\Html;

$this->title = $post->title;
Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $post->brief
]);
Yii::$app->view->registerMetaTag([
    'name' => 'keywords',
    'content' => $this->title
]);

if (Yii::$app->get('opengraph', false)) {
    Yii::$app->opengraph->set([
        'title' => $this->title,
        'description' => $post->brief,
        'image' => $post->getThumbFileUrl('banner'),
    ]);
}

$post_user = $post->user;
$username_attribute = Module::getInstance()->userName;

$recentNews = BlogPost::find()
    ->where(['!=', 'id', $post->id])
    ->andWhere(['status' => 1])
    ->orderBy('id DESC')
    ->limit(3)
    ->all();
?>
<section class="my-5 about-page">
    <div class="container">
        <div class="row mb-5">
            <article class="col-12" itemscope itemtype="http://schema.org/Article">
                <meta itemprop="author" content="<?= $post_user->{$username_attribute}; ?>">
                <meta itemprop="dateModified" content="<?= date_format(date_timestamp_set(new DateTime(), $post->updated_at), 'c') ?>"/>
                <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?= $post->getAbsoluteUrl(); ?>"/>
                <meta itemprop="commentCount" content="<?= $dataProvider->getTotalCount(); ?>">
                <meta itemprop="genre" content="<?= $post->category->title; ?>">
                <meta itemprop="articleSection" content="<?= $post->category->title; ?>">
                <meta itemprop="inLanguage" content="<?= Yii::$app->language; ?>">
                <meta itemprop="discussionUrl" content="<?= $post->getAbsoluteUrl(); ?>">
                <?php if ($post->banner) : ?>
                    <div itemscope itemprop="image" itemtype="http://schema.org/ImageObject" class="blog-post__img">
                        <meta itemprop="url" content="<?= $post->getThumbFileUrl('banner', 'thumb'); ?>">
                        <meta itemprop="width" content="400">
                        <meta itemprop="height" content="300">
                    </div>
                <?php endif; ?>

                <h1 class="font-size-xxlg tc-primary ml-md-5 mt-md-5 font-bold" itemprop="headline"><?= Html::encode($post->title); ?></h1>

                <time title="<?= Module::t('blog', 'Create Time'); ?>" itemprop="datePublished"
                      datetime="<?= date_format(date_timestamp_set(new DateTime(), $post->created_at), 'c') ?>"
                      class="font-size-md tc-secundary ml-md-5 mb-5"
                >
                    <?= Yii::$app->formatter->asDate($post->created_at); ?> by <?= $post_user->{$username_attribute}; ?>
                </time>

                <div class="blog-content" itemprop="articleBody"><?= \yii\helpers\HtmlPurifier::process($post->content); ?></div>

                <?php if (isset($post->module->schemaOrg) && isset($post->module->schemaOrg['publisher'])) : ?>
                    <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="blog-post__publisher">
                        <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                            <meta itemprop="url image" content="<?= Yii::$app->urlManager->createAbsoluteUrl($post->module->schemaOrg['publisher']['logo']); ?>"/>
                            <meta itemprop="width" content="<?= $post->module->schemaOrg['publisher']['logoWidth']; ?>">
                            <meta itemprop="height" content="<?= $post->module->schemaOrg['publisher']['logoHeight']; ?>">
                        </div>
                        <meta itemprop="name" content="<?= $post->module->schemaOrg['publisher']['name'] ?>">
                        <meta itemprop="telephone" content="<?= $post->module->schemaOrg['publisher']['phone']; ?>">
                        <meta itemprop="address" content="<?= $post->module->schemaOrg['publisher']['address']; ?>">
                    </div>
                <?php endif; ?>
            </article>
        </div>

        <?php if(!empty($recentNews)) { ?>
            <div class="row">
                <div class="col-12">
                    <h3 class="font-size-xlg read-text tc-primary font-light">Read next on DevsPush Blog:</h3>
                </div>

                <?php
                foreach ($recentNews as $news) {
                    echo $this->render('_brief', ['model' => $news]);
                }
                ?>
            </div>
        <?php } ?>
    </div>
</section>
