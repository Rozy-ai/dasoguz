<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace backend\controllers\user;

use common\models\user\Profile;
use common\models\UserLocation;
use common\models\wrappers\UserLocationWrapper;
use dektrium\user\controllers\AdminController as BaseAdminController;
use dektrium\user\Finder;
use dektrium\user\models\RecoveryForm;
use dektrium\user\models\Token;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RecoveryController manages password recovery process.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class AdminController extends BaseAdminController
{

    public function actionLocations($id)
    {
        $user = $this->findModel($id);
        Url::remember('', 'actions-redirect');

        if (\Yii::$app->request->post()) {
            $post = \Yii::$app->request->post();
            $post = $post['User'];
            if (isset($post['locs']))
                $user->locs = $post['locs'];

            $user->save();
        }

        return $this->render('_locations', [
            'user' => $user,
        ]);
    }
}
