<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\wrappers\ItemWrapper */
$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $model->description]);
$this->registerMetaTag(['property' => 'og:title', 'content' => $model->title]);

$this->title = $model->title;
$categoryModel = $model->category;
if (isset($categoryModel) && $categoryModel->top == true) {
    $this->params['breadcrumbs'] = $categoryModel->getBreadcrumbs(true);
}
$this->params['breadcrumbs'][] = ['label' => Yii::$app->controller->truncate($model->title, 8, 65)];

$href = $model->url;
$author = (isset($model->author) && strlen(trim($model->author)) > 0) ? $model->author : $model->create_username;
$date = $model->renderDateToWord($model->date_created);

$path = $model->getThumbPath();
list($width, $height) = getimagesize($path);
if ($width>=840) {
    $path = $model->getThumbPath(400, 320, 'w', true, false);
}



//$dataProviderRelated = $categoryModel->code;
$dataProvider = $searchModel->search([]);
$this->registerLinkTag(['rel' => 'image_src', 'href' => $model->getThumbPath(500,300, 'w')]);
$this->registerMetaTag(['property' => 'og:image', 'itemprop' => 'image', 'content' => $model->getThumbPath(500,300, 'w')]);
?>

<div class="content" style="margin-top: 40px;">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="view_aticle">
                    <span class="date" style="margin-right: 10px;">
                        <?php
//                        echo Yii::$app->formatter->asDate(substr($model->date_created,0,10), 'dd-MM-Y')
                        ?>
                    </span>
                    <span class="time">
                        <?php
//                        echo substr($model->date_created,-9,6)
                        ?>
                    </span>
                    <span class="visited_count date hidden-xs" style="margin-left: 10px; float: right"><?=$model->visited_count?>  <i class="fa fa-eye"></i></span>
                    <h2 class="article_title" style="margin-bottom: 40px;"><?=Html::encode($model->title)?></h2>
                    <div class="view_calendar_content">
                    </div>
                    <?=$model->content?>
                </div>
                <div class="divider"></div>
                <div class="like_articles last_record">
<!--                    <h3 style="margin: 0;margin-bottom: 30px; margin-top: 20px;">--><?//=YII::t('app','Similar articles')?><!--</h3>-->
                    <div class="row">
                            <?=common\widgets\items\similar_articles\SimilarArticles::widget([
                                    'category' => 'literates',
                                    'limit' => 3
                            ]) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 right_column">
                <div class="fixed_bar">
                    <div class="col-md-12 col-sm-6" style="padding:0;">
                        <div class="popular">
                            <h3 class="text-center"><?= Yii::t('app', 'Top read') ?></h3>
                            <div class="divider"></div>
                            <?php echo common\widgets\items\topnews\TopPosts::widget([
                                'limit' => 5,
                                'category' => $categoryModel->code,
                            ]); ?>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6" style="border: 1px solid #000;margin: 40px 0;">
                        <div class="near_event">
                            <h3><?=Yii::t('app' ,'Calendar')?></h3>
                            <?= \common\widgets\items\recent\RecentPosts::widget([
                                'limit' => 10,
                                'category' => 'event',
                            ]) ?>
                            <p class="text-center" style="margin-top: 20px;">
                                <a class="all_events" href="\business-instrument\kalendar"><?=yii::t('app', 'All Events')?></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


