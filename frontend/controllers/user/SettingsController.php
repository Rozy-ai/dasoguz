<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace frontend\controllers\user;


use common\components\CommonController;
use common\models\ItemLang;
use common\models\search\FreelancerSearch;
use common\models\search\ItemSearch;
use common\models\security\Profile;
use common\models\wrappers\DocumentWrapper;
use common\models\wrappers\FreelancerWrapper;
use common\models\wrappers\ItemWrapper;
use dektrium\user\Module;
use dektrium\user\controllers\SettingsController as BaseAdminController;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\User;


/**
 * Controller that manages user authentication process.
 *
 * @property Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class SettingsController extends BaseAdminController
{
    public $layout = 'profilelayout';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'disconnect' => ['post'],
                    'delete'     => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['profile', 'account', 'networks', 'disconnect', 'delete', 'logout', 'freelance', 'fview', 'fupdate', 'fcreate', 'fupdatework', 'fworks', 'fdelete', 'faddwork', 'fdeletework'],
                        'roles'   => ['@'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['confirm'],
                        'roles'   => ['?', '@'],
                    ],
                ],
            ],
        ];
    }


    public function  actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->redirect(yii::$app->getHomeUrl());
    }

    public function actionProfile()
    {
        Url::remember('', 'actions-redirect');
        $user    = $this->findModel(\Yii::$app->user->identity->getId());
        $profile = $user->profile;


        if ($profile == null) {
            $profile = \Yii::createObject(Profile::className());
            $profile->link('user', $user);
        }
        $event = $this->getProfileEvent($profile);

        $this->performAjaxValidation($profile);

        $this->trigger(self::EVENT_BEFORE_PROFILE_UPDATE, $event);

        if ($profile->load(\Yii::$app->request->post()) && $profile->save()) {
            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Profile details have been updated'));
            $this->trigger(self::EVENT_AFTER_PROFILE_UPDATE, $event);
            return $this->refresh();
        }
        return $this->render('profile', [
            'model' => $profile,
        ]);
    }

    public function actionFreelance()
    {
        $searchModel = new FreelancerSearch();
        $sort['FreelancerSearch'] = ['user_id' =>\Yii::$app->user->identity->getId()];
        $dataProvider = $searchModel->search($sort);

        return $this->render('freelancer/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFcreate()
    {
        $model = new FreelancerWrapper();
        $model->user_id = \Yii::$app->user->identity->getId();  
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $model->load($post);

            $post = $post['FreelancerWrapper'];
            if (isset($post['docs']) && strlen(trim($post['docs'])) > 0){
                $model->docs = explode(',', $post['docs']);
            }
            $model->status = 0;
            $model->created_at = time();
            if ($model->save()) {
                $user = \common\models\security\User::findIdentity($model->user_id);
                $senderInfo = 'Okyjynyn ady: '.$model->username.'
                '.'Okyjyny emaily: '.$model->email;
                $lastId = FreelancerWrapper::find()->asArray()->all();
                $lastId = $lastId[count($lastId)-1]['id'];
                $message = $user->username. " atly ulanyjy bildirish goshdy.
                 Seretmek:".yii::getAlias('@mysite')."/backend/freelancer/".$lastId;
                Yii::$app->common->sendMail('info user action', $message,'info@ozisim.com', $senderInfo);
                return $this->redirect('fview?id='.$model->id);
            }
        }

        return $this->render('freelancer/create', [
            'model' => $model,
        ]);
    }

    public function actionFview($id)
    {
        $model = FreelancerWrapper::findOne($id);
        if ($model->user_id != \Yii::$app->user->identity->getId()){
            return die;
        }
        return $this->render('freelancer/view', [
            'model' => $model,
        ]);
    }

    public function actionFupdate($id)
    {
        $model = FreelancerWrapper::findOne($id);
        if ($model->user_id != \Yii::$app->user->identity->getId()){
            return die;
        }
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $model->load($post);
            $post = $post['FreelancerWrapper'];
            if (isset($post['docs']) && strlen(trim($post['docs'])) > 0)
                $model->docs = explode(',', $post['docs']);
            else
                $model->docs = [];
            $model->status = 0;
            if ($model->save()) {
                $user = \common\models\security\User::findIdentity($model->user_id);
                $senderInfo = 'Okyjynyn ady: '.$model->username.'
                '.'Okyjyny emaily: '.$model->email;
                $lastId = FreelancerWrapper::findone($model->id);
                $lastId = $lastId->id;
                $message = $user->username. " atly ulanyjy bildirish tazeledi.
                Seretmek:".yii::getAlias('@mysite')."/backend/freelancer/".$lastId;
                Yii::$app->common->sendMail('info user action',$message,'info@ozisim.com', $senderInfo);
                return $this->redirect(['freelance']);
            }
        }

        $model->docs = implode($this->trimNonexistentDocuments($model->docs), ',');
        return $this->render('freelancer/update', [
            'model' => $model,
        ]);
    }

    public function actionFdelete($id)
    {
        $model = FreelancerWrapper::findOne($id);
        if ($model->user_id != \Yii::$app->user->identity->getId()){
            return die;
        }
        $model->delete();

        return $this->redirect(['freelance']);
    }

    public function actionFaddwork($id){
        $model = new ItemWrapper();
        $model->type = ItemWrapper::TYPE_TEXT;

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $model->load($post);
            $model->user_id = $id;
            $post = $post['ItemWrapper'];
            if (isset($post['docs']) && strlen(trim($post['docs'])) > 0)
                $model->docs = explode(',', $post['docs']);
            if (isset($model->date_event)) {
                $date_event = new \DateTime($model->date_event);
                $model->date_event = $date_event->format('Y-m-d H:i:s');
            }
            $model->status = 0;
            if ($model->save()) {
                $user = \common\models\security\User::findIdentity($model->user_id);
                $senderInfo = 'Okyjynyn ady: '.$user->username.'
                '.'Okyjyny emaily: '.$user->email;
                $lastId = FreelancerWrapper::find()->asArray()->all();
                $lastId = $lastId[count($lastId)-1]['id'];
                $message = $user->username. " atly ulanyjy project goshdy. 
                Seretmek:".yii::getAlias('@mysite')."backend/freelancer/works?id=".$lastId;

                Yii::$app->common->sendMail('info user action',$message,'info@ozisim.com', $senderInfo);
                return $this->redirect(['fworks?id='.$id]);
            }
        }
        $model->docs = implode($model->docs, ',');
        return $this->render('freelancer/addwork', [
            'model' => $model,
        ]);
    }

    public function actionFupdatework($id, $idc)
    {
        $model = ItemWrapper::findone($id);
        $model->type = ItemWrapper::TYPE_TEXT;
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $model->load($post);
            $post = $post['ItemWrapper'];
            if (isset($post['docs']) && strlen(trim($post['docs'])) > 0)
                $model->docs = explode(',', $post['docs']);
            else
                $model->docs = [];
            if (isset($model->date_event)) {
                $date_event = new \DateTime($model->date_event);
                $model->date_event = $date_event->format('Y-m-d H:i:s');
            }
            $model->status = 0;
            if ($model->save()) {
                $user = \common\models\security\User::findIdentity($model->user_id);
                $senderInfo = 'Okyjynyn ady: '.$model->username.'
                '.'Okyjyny emaily: '.$model->email;
                $lastId = FreelancerWrapper::find()->asArray()->all();
                $lastId = $lastId[count($lastId)-1]['id'];
                $message = $user->username. " atly ulanyjy project tazeledi. 
                Seretmek:".yii::getAlias('@mysite')."backend/freelancer/works?id=".$lastId;
                Yii::$app->common->sendMail('info user action',$message,'info@ozisim.com', $senderInfo);
                return $this->redirect(['fworks?id='.$idc]);
            }
        }

//        $model->docs = implode($this->trimNonexistentDocuments($model->docs), ',');
        return $this->render('freelancer/update-work', [
            'model' => $model,
        ]);
    }

    public function actionFworks($id)
    {
        $searchModel = new ItemSearch();
        $searchModel->type = ItemWrapper::TYPE_TEXT;
        $params = Yii::$app->request->queryParams;
        $params['ItemSearch']['user_id'] = $id;
        $dataProvider = $searchModel->search($params);

        return $this->render('freelancer/works', [
            'id' => $id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFdeletework($id, $idc)
    {
        $itemLangModels = ItemLang::find()->where(['item_id' => $id])->all();
        foreach ($itemLangModels as $itemLangModel) {
            if (isset($itemLangModel))
                $itemLangModel->delete();
        }
        $model = ItemWrapper::findOne($id);
        $documents = $model->documents;
        if (isset($documents)) {
            foreach ($documents as $doc) {
                $doc->fullDelete('tbl_item_to_document');
            }
        }
        $model = ItemWrapper::findOne($id);
        $model->delete();

        return $this->redirect(['fworks?id='.$idc]);
    }

    protected function findModel($id)
    {
        $user = $this->finder->findUserById($id);
        if ($user === null) {
            throw new NotFoundHttpException('The requested page does not exist');
        }

        return $user;
    }

    public function trimNonexistentDocuments($docs = [])
    {
        $exists = [];
        if (is_array($docs)) {
            foreach ($docs as $docId) {
                $document = DocumentWrapper::findOne(['id' => $docId]);
                if (isset($document)) {
                    $path = $document->getFullPath();
                    if (isset($path) && strlen(trim($path)) > 0) {
                        $exists[] = $docId;
                    }
                }
            }
        }
        return $exists;
    }
}
