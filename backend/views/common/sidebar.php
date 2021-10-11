<?php

use yii\helpers\Url;

$user = Yii::$app->user->identity;

$module_id = Yii::$app->controller->module->id;
$controller_id = Yii::$app->controller->id;
$action_id = Yii::$app->controller->action->id;

?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <ul class="sidebar-menu">
            <li class="nav-item  ">
                <a href="<?= yii\helpers\Url::to(['/site/index']); ?>" class="nav-link ">
                    <i class="fa fa-home"></i>
                    <span class="title"><?= Yii::t('backend', 'Main page') ?></span>
                </a>
            </li>

            <?php if (
                Yii::$app->user->can('app-backend/item/index') || Yii::$app->user->can('app-backend/item/*')
                || Yii::$app->user->can('app-backend/category/index') || Yii::$app->user->can('app-backend/category/*')
                || Yii::$app->user->can('app-backend/event/index') || Yii::$app->user->can('app-backend/event/*')
                || Yii::$app->user->can('app-backend/show/index') || Yii::$app->user->can('app-backend/show/*')
                || Yii::$app->user->can('app-backend/image/index') || Yii::$app->user->can('app-backend/image/*')
            ) { ?>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file"></i>
                        <span><?= Yii::t('backend', 'Content') ?></span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">

                        <?php if (Yii::$app->user->can('app-backend/item/index') || Yii::$app->user->can('app-backend/item/*')) { ?>
                            <li class="nav-item  ">
                                <a href="<?= yii\helpers\Url::to(['/item/index']); ?>" class="nav-link ">
                                    <i class="fa fa-file-o"></i>
                                    <span class="title"><?= Yii::t('backend', 'Items') ?></span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (Yii::$app->user->can('app-backend/category/index') || Yii::$app->user->can('app-backend/category/*')) { ?>
                            <li class="nav-item  ">
                                <a href="<?= yii\helpers\Url::to(['/category/index']); ?>" class="nav-link ">
                                    <i class="fa fa-file-o"></i>
                                    <span class="title"><?= Yii::t('backend', 'Categories') ?></span>
                                </a>
                            </li>
                        <?php } ?>


                        <li class="nav-item  ">
                            <a href="<?= yii\helpers\Url::to(['/image/index', 'ImageSearch[type]' => \common\models\wrappers\ImageWrapper::IMAGE_VIDEO]); ?>"
                               class="nav-link ">
                                <i class="fa fa-file-image-o"></i>
                                <span class="title"><?= Yii::t('backend', 'Gallery') ?></span>
                            </a>
                        </li>

                        <li class="nav-item  ">
                            <a href="<?= yii\helpers\Url::to(['/image/index', 'ImageSearch[type]' => \common\models\wrappers\ImageWrapper::IMAGE_GALLERY]); ?>"
                               class="nav-link ">
                                <i class="fa fa-file-image-o"></i>
                                <span class="title"><?= Yii::t('backend', 'Parallax') ?></span>
                            </a>
                        </li>


                    </ul>
                </li>
            <?php } ?>


            <?php 
            // if (Yii::$app->user->can('app-backend/route/index') || Yii::$app->user->can('app-backend/route/*')) { 
                ?>
         <!--        <li class="nav-item  ">
                    <a href="<?php //echo yii\helpers\Url::to(['/route/index']); ?>"
                       class="nav-link ">
                        <i class="fa fa-bus"></i>
                        <span class="title"><?php// echo Yii::t('backend', 'route') ?></span>
                    </a>
                </li> -->
            <?php// } ?>

             <?php
              // if (Yii::$app->user->can('app-backend/point/index') || Yii::$app->user->can('app-backend/point/*')) { 
                ?>
<!--                 <li class="nav-item  ">
                    <a href="<?php //echo yii\helpers\Url::to(['/point/index']); ?>"
                       class="nav-link ">
                        <i class="fa fa-map-marker"></i>
                        <span class="title"><?php //echo Yii::t('backend', 'point') ?></span>
                    </a>
                </li> -->
            <?php// } ?>


            <?php if (Yii::$app->user->can('app-backend/owner-contact/index') || Yii::$app->user->can('app-backend/owner-contact/*')) { ?>
                <li class="nav-item  ">
                    <a href="<?= yii\helpers\Url::to(['/owner-contact/index']); ?>" class="nav-link ">
                        <i class="fa fa-globe"></i>
                        <span class="title"><?= Yii::t('backend', 'Owner Contact') ?></span>
                    </a>
                </li>
            <?php } ?>




            <?php if (Yii::$app->user->can('user/admin/index') || Yii::$app->user->can('user/admin/*')) { ?>
                <li class="nav-item start  ">
                    <a href="<?= yii\helpers\Url::to(['/user/admin/index']); ?>">
                        <i class="fa fa-users"></i>
                        <span class="title"><?= Yii::t('backend', 'User/Role Management') ?></span>
                        <span class="selected"></span>
                    </a>
                </li>
            <?php } ?>


            <?php if (Yii::$app->user->can('backuprestore/*')) { ?>
                <li class="nav-item  ">
                    <a href="<?= yii\helpers\Url::to(['/backuprestore']); ?>" class="nav-link ">
                        <i class="fa fa-database"></i>
                        <span class="title"><?= Yii::t('backend', 'Database backup/restore') ?></span>
                    </a>
                </li>
            <?php } ?>

            <?php if (Yii::$app->user->can('app-backend/setting/index') || Yii::$app->user->can('app-backend/setting/*')) { ?>
                <li class="nav-item start  ">
                    <a href="<?= yii\helpers\Url::to(['/setting/index']); ?>">
                        <i class="fa fa-cog"></i>
                        <span class="title"><?= Yii::t('backend', 'Settings') ?></span>
                    </a>
                </li>
            <?php } ?>

            <li class="nav-item  ">
                <a href="<?= yii\helpers\Url::to(['/user/security/logout']); ?>" data-method="post" class="nav-link ">
                    <i class="fa fa-power-off"></i>
                    <span class="title"><?= Yii::t('backend', 'Sign out') ?></span>
                </a>
            </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>