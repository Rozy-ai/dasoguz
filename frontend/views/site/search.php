<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Search Page');
$this->params['breadcrumbs'][] = Yii::t('app', 'Search Page');
$perPage = 5;
$countItems = count($model);
$pages = round($countItems / $perPage, 0, PHP_ROUND_HALF_UP);
if (isset($_GET['page'])){
    $page = $_GET['page'];
} else {
    $page = 1;
};
$count = 0;

//echo "<pre>";
//echo $countItems."<br>";
//echo $pages."<br>";
//echo $perPage."<br>";
//echo $page."<br>";
//die;
//echo "<pre>";/
//var_dump($model);die;
?>


<div class="container" style="padding-top:30px; ">
    <!-- Item Page -->
    <!--<div class="container">-->
    <div class="row">
        <div class="col-md-9 col-sm-8">
            <h4 class="search_query_title"> <?php echo Yii::t('app', 'search_query') . ' <span class="query">"' . Html::encode($query) . '" </span>'; ?></h4>

            <div class="total-event">
                <div class="total-product">
                    <div class="row">
                        <?php
                        foreach ($model as $item){
                            if ($count <= $page * $perPage && $count >= ($page-1) * $perPage){
                            $count ++;
                        ?>


                                <div class="col-md-12">
                                    <h4 class="search_title">
                                        <a href="<?php
                                            if ($item['title']){
                                                echo "/item/".$item['item_id'];
                                            } else {
                                                echo "/business-instrument/dictionary-search?id=".$item['id'];
                                            }
                                        ?>"><?php echo $item['title'].$item['word'] ?></a>
                                    </h4>
                                    <p class="search_content"><?php echo Yii::$app->controller->getFragment(strip_tags($item['description']), $query); ?></p>

                                </div>
                        <?php } else{
                            $count++;
                        }}?>
                        <ul class="pagination">
                            <?php
                                if ($page-3 > 1){
                            ?>
                                    <li class="prev"><a href="/site/a/search?query=<?=$_GET['query']?>&amp;page=<?=$page-1?>&amp;per-page=5" data-page="<?=$page-1;?>">«</a></li>

                             <?php
                             }
                            ?>
                            <?php
                                if ($pages >= 7){
                                    $i = 6;
                                } else {
                                    $i = $pages-1;
                                }
                                $start = $page;
                                $stop = $page;
                                while ($i > 0){
                                    if ($start>1){
                                        $start--;
                                        $i--;
                                    }
                                    if ($stop<$pages){
                                        $stop++;
                                        $i--;
                                    }
                                }
                                for ($i = $start; $i <= $stop; $i++){
                                    if ($i == $page){
                                        $add = 'class = "active"';
                                    } else{
                                        $add = '';
                                    }
                            ?>
                            <li <?=$add?>><a href="/site/a/search?query=<?=$_GET['query']?>&amp;page=<?=$i?>&amp;per-page=5" data-page="<?=$i?>"><?=$i?></a></li>
                            <?php
                                }
                            ?>
                            <?php
                                if ($page+3 < $pages):
                            ?>
                                <li class="next"><a href="/site/a/search?query=<?=$_GET['query']?>&amp;page=<?=$page+1?>&amp;per-page=5" data-page="<?=$page+1?>">»</a></li>
                            <?php
                                endif;
                            ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4">
            <div class="total-aside">
                <aside>
                    <!--                --><?php
                    //                echo \common\widgets\items\recent\RecentPosts::widget([
                    //                    'count' => 6,
                    //                    'category' => 'news',
                    //                ]);
                    //                ?>
                </aside>


                <aside>
                    <div class="widget-title">
                        <?php
                        $servicesCategory = \common\models\wrappers\CategoryWrapper::find()->where(['code' => 'service'])->andWhere(['OR', 'parent_id is null', 'parent_id=0'])->one();
                        ?>
                        <h2><?= Html::a($servicesCategory->name, $servicesCategory->url) ?></h2>
                    </div>
                    <?php
                    echo \common\widgets\items\listview\ListWidget::widget([
                        'category' => 'service',
                        'view' => 'service-list',
                        'limit' => 6
                    ]);
                    ?>
                </aside>


                <aside>
                    <!--                --><?php
                    //                echo \common\widgets\gallery\Gallery::widget([
                    //                    'count' => 2
                    //                ]);
                    //                ?>
                </aside>

            </div>
        </div>
        <!--    </div>-->
    </div>
</div>
