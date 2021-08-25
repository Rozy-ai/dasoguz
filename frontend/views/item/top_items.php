<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


if (isset($modelCategory)) {
    $this->title = $title = $modelCategory->name;
    $this->params['breadcrumbs'] = $modelCategory->getBreadcrumbs();
}
$this->params['breadcrumbs'][] = Yii::$app->controller->truncate($model->title, 8, 65);


?>



<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-12 px-0">
                <?php foreach ($items as $item):?>
                    <div class="item">
                        <div class="item_articles col-md-12">
                            <div class="col-md-5 col-sm-5 px-0">
                                <?php
                                $imgsrc = $item->getThumbPath(323, 205, 'w', true);
                                echo Html::a(Html::img($imgsrc, ['alt' => '', 'class' => 'img100']), $href);
                                ?>
                            </div>
                            <div class="col-md-7 col-sm-7 ">
                                <div class="entry-header">
                                    <div class="about">
                                        <span class="category"><?=$item->category->name?></span>
                                        <span class="date" ><?=Yii::$app->formatter->asDate(substr($item->date_created,0,10), 'dd-MM-Y')?></span>
                                        <span class="time"><?=substr($item->date_created,-9,6)?></span>
                                        <span class="visited_count date" ><?=$item->visited_count?>  <i class="fa fa-eye"></i></span>

                                    </div>
                                    <div class="title">
                                        <h3 class="item_title"><?= Html::a($item->title, $href) ?></h3>
                                    </div>
                                </div>

                                <div class="text">
                                    <p><?php
                                        $desc = Yii::$app->controller->truncate($item->description, 20, 300);
                                        echo $desc;
                                        ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>

                <?php
                echo LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
            <div class="col-md-3 left_column">
                <div class="fixed_bar">
                    <div class="col-md-12 col-sm-6" style="padding:0;">
                        <div class="popular">
                            <a class="top_items" href="/item/tops">
                            <h3 class="text-center"><?= Yii::t('app', 'Top read') ?></h3>
                            <div class="divider"></div>
                            </a>
                            <?php echo common\widgets\items\topnews\TopPosts::widget([
                                'limit' => 5,
                                'category' => ' '
                            ]); ?>
                        </div>
                    </div>
                    <div class="text-center col-md-12 col-sm-6">
                        <div class="near_event">
                            <h3><?=Yii::t('app' ,'Upcoming events')?></h3>
                            <?= \common\widgets\items\recent\RecentPosts::widget([
                                'limit' => 10,
                                'category' => 'event',
                            ]) ?>
                            <a class="all_events" href="item\events"><?=yii::t('app', 'All Events')?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
