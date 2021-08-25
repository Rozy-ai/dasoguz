<?php
namespace frontend\controllers;

use common\components\CommonController;


/**
 * Site controller
 */
class SubscribeController extends CommonController
{

    public function actionIndex(){

        $model = new User();
        $model->find()->where(['subscribe' => 1]);
        $users = \yii\helpers\ArrayHelper::map($model, '', 'email');
        return $this->render('index',[
           'users' => $users,
        ]);

    }

}
