<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\wrappers\ItemWrapper */

$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
$this->registerMetaTag(['property' => 'og:title', 'content' => $model->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $model->description]);

$this->title = $model->title;
$categoryModel = $model->category;
if (isset($categoryModel) && $categoryModel->top == true) {
    $this->params['breadcrumbs'] = $categoryModel->getBreadcrumbs(true);
}
$this->params['breadcrumbs'][] = ['label' => Yii::$app->controller->truncate($model->title, 8, 65)];

$href = $model->url;
$author = (isset($model->author) && strlen(trim($model->author)) > 0) ? $model->author : $model->create_username;
// $date = $model->renderDateToWord($model->date_created);
$date = Yii::$app->controller->renderDateToWord($model->date_created); 

$path = $model->getThumbPath();
list($width, $height) = getimagesize($path);
if ($width>=840) {
    $path = $model->getThumbPath(600, 350, 'w', true, false);
}



//$dataProviderRelated = $categoryModel->code;
$dataProvider = $searchModel->search([]);
$this->registerLinkTag(['rel' => 'image_src', 'href' => $model->getThumbPath(500,300, 'w')]);
$this->registerMetaTag(['property' => 'og:image', 'itemprop' => 'image', 'content' => $model->getThumbPath(500,300, 'w')]);
?>

<div class="content" style="padding: 50px 0;">
    <div class="container">
        <div class="row position-relative">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <?php if($categoryModel->code !=  about && $categoryModel->code !=  service): ?>
                <div class="news-details_title">
        <?=Html::encode($model->title)?>
      </div>
      <p style="color: #0099e5;font-size: 14px"><?=$date ?></p>
  <?php endif; ?>

                <div class="news-details">
                    <div class="news-details-text">
                        <?php 
                        $category = $model->category;
if ($category->parent_id){
    while ($category->parent_id){
        $category = \common\models\wrappers\CategoryWrapper::findOne($category->parent_id);
        $catCode = $category->code;
    }
} else{
    $catCode = $category->code;
}
                         ?>
                        <?php if ($catCode == 'service') : ?>
                                        <div style="margin: 3% 0 4% 0" class="row text-center">
                <div class="col-md-6 col-lg-4 cards">
          
                        <div class="func_cards">
                            <div class="func_card_title ">
                                <i class="service-one__icon  fa fa-cubes"></i>
                            </div>
                            <h4 style="color: #fff"><?= yii::t('app', 'Shipping')?> </h4>

                        </div>
              
                </div>
                <div class="col-md-6 col-lg-4 cards">
             
                        <div class="func_cards">
                            <div class="func_card_title">
                                <i class="service-one__icon  fa fa-group"></i>
                            </div>
                            <h4 style="color: #fff"><?= yii::t('app', 'Passenger Transportation')?></h4>
                        </div>
              
                </div>
                <div class="col-md-6 col-lg-4 cards">
             
                        <div class="func_cards box-koire move">
                            <div class="func_card_title">
                                <i class="service-one__icon  fa fa-life-ring"></i>
                            </div>
                            <h4 style="color: #fff"><?= yii::t('app', 'Vehicle ordering')?></h4>
                        </div>
           
                </div>

            </div>
                        <?php endif; ?>
<?php if(!empty($path)): ?>
                        <div class="news-details-image_wrapper">
                            <div class="d-flex justify-content-start py-2">     <div class="small text-info float-left">
                                <?php
                                         // $date = New DateTime($model->date_created);
                                         // echo $date->format('d-m-Y');
                                ?>
                                </div>
                            </div>
        <div class="col-lg-5 col-xs-12" style="margin-bottom: 50px">
                <a class="institution-link" href="<?= $path ?>">
                    <article class="grid-blog-post" style="border: none;">
                        <div class="post-thumbnail">
                            <?=html::img($path, ['class' => 'img100 w-100 h-100', 'style' => 'border-radius:5px;min-height:225px'])?>
                        </div>

                    </article>
                </a>
            </div>
                        

                         </div>
                    <?php endif; ?>
                    
                    <div class="news-contenta">
                        <?php
                        echo  $model->content;
                        ?>
                    </div>
                </div>
            </div>
            <?php if($categoryModel->code !=  about && $categoryModel->code !=  service): ?>
            <div class="border-bottom my-4" style="font-family: 'Rubik Regular'; font-size: 1.8rem">
        <?= yii::t('app','Related') ?>
      </div>
      <div>
                          <div class="d-flex flex-wrap">

                    
                            <?=common\widgets\items\similar_articles\SimilarArticles::widget([
                                    'category' => $categoryModel->code,
                                    'limit' => 3
                            ]) ?>
                   
                </div>
      </div>
  <?php endif; ?>
</div>
                  <div class="col-lg-3 col-md-3 col-sm-12 alike-content-wrapper">
                <div class="pl-3">
                    <div class="py-2 border-bottom font-weight-bold">
                            <?= Yii::t('app', 'Top read') ?>
                    </div>
                            <?php $eventCategory->code = 'news'; ?>

                            <?php
                                            $unset_id = $model->id;
                    ?>
                            <?php echo common\widgets\items\topnews\TopPosts::widget([
                                'limit' => 3,
                                'category' => $eventCategory->code,
                                'message' => $unset_id
                            ]); ?>

                    </div>
                </div>

        </div>
    </div>
</div>
<?php 
$this->registerCssFile("@web/source/css/style.css");
 ?>


