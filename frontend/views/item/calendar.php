<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->registerMetaTag(['name' => 'description', 'content' => yii::t('app', 'Site description')]);

$this->title = yii::t('app', 'All Events');
if (isset($categoryModel)) {
    $this->params['breadcrumbs'] = $categoryModel->getBreadcrumbs();
}
$this->params['breadcrumbs'][] = Yii::$app->controller->truncate('', 8, 65);

//$this->params['breadcrumbs'][] = ['label' => Yii::$app->controller->truncate($model->title, 8, 65), 'url' => '/item/'.$model->id];


?>

<div class="news_content">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 pl-3">
                                    <?php
                    foreach ($events as $event):
                        $href = $event->url;
                        $path = $event->getThumbPath();
                        ?>
                <a href="<?= $href ?>" class="row pb-4 my-4 pr-4">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <?=\yii\helpers\Html::img($path, ['alt' => "$event->title", 'class' => 'singleNews-img'])?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12"> 
                        <div class="pb-1 pl-0" style="color: #000">
                                     <?php
                                         $date = New DateTime($event->date_created);
                                         echo $date->format('d-m-Y');
                               ?>
                        </div>
                        <div class="news-list-title" style="color: #000"><?=$event->title ?></div>
                        <div class="news-list-description"><p style="color: #000">
                            <?php 
                            $desc = Yii::$app->controller->truncate($event->description, 26, 280);
                              echo $desc;
                            ?></p></div>
                    </div>
                </a>
                <?php endforeach;?>
                    <?php
                    echo 
                    LinkPager::widget([
                        'pagination' => $pages,
                    ]);
                    ?>


            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 alike-content-wrapper">
                <div class="pl-3">
                    <div class="py-2 border-bottom font-weight-bold">
                            <?= Yii::t('app', 'Top read') ?>
                    </div>
                            <?php $eventCategory->code = 'news'; ?>

                            <?php echo common\widgets\items\topnews\TopPosts::widget([
                                'limit' => 3,
                                'category' => $eventCategory->code,
                            ]); ?>

                    </div>
                </div>
        </div>
    </div>
</div>
<?php 
$this->registerCssFile("@web/source/css/style.css");
 ?>