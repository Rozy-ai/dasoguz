<?php
namespace frontend\controllers;

use common\models\Item;
use common\models\ItemLang;
use common\models\PageContent;
use common\models\search\ItemLangSearch;
use common\models\search\ItemSearch;
use common\models\search\RouteSearch;
use common\models\security\User;
use common\models\Subscribe;
use common\models\SubscribedUsers;
use common\models\TmWord;
use common\models\wrappers\AlbumWrapper;
use common\models\wrappers\ContactWrapper;
use common\models\wrappers\OrderWrapper;
use common\models\wrappers\FreelancerWrapper;
use common\models\wrappers\ItemWrapper;
use common\models\wrappers\CategoryWrapper;
use common\models\wrappers\ImageWrapper;
use common\models\wrappers\OwnerContactWrapper;
use common\models\wrappers\RouteWrapper;
use common\models\wrappers\SubscriberWrapper;
use common\rbac\UserProfileOwnerRule;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\base\InvalidParamException;
use yii\data\Pagination;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use common\components\CommonController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\components\Common;
use common\models\wrappers\PointWrapper;

ini_set('max_execution_time', 6000);

/**
 * Site controller
 */

class SiteController extends CommonController
{
    public $layout = 'bootstrap';
    public $languages = ['tk', 'ru'];
    public $sitemap = '';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
//        return \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['logout', 'signup', 'search'],
////                'rules' => [
////                    [
////                        'actions' => ['index','error','contact','about'],
////                        'allow' => true,
////                        'roles' => ['@'],
////                    ],
////                ],
//                'rules' => [
//                    [
//                        'actions' => ['search'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'actions' => ['index', 'error', 'contact', 'about'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ]
//        ]);

//
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'search'],
                'rules' => [
                    [
                        'actions' => ['signup', 'search', 'error'],
                        'allow' => true,
//                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'error'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $ownInfo = OwnerContactWrapper::find()->one();
        $model = new ContactWrapper();
       

   
        if ($model->load(Yii::$app->request->post())) {
        
         
                if ($model->save()) {
//            \Yii::$app->common->sendMail('testSubject','test text body','batya224@mail.ru');
//            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('success', 'Biz bilen habarlaşanyňyz üçin sag boluň. Size mümkin boldugyça gysga wagtda jogap bereris');
//            } else {
//                Yii::$app->session->setFlash('error', 'There was an error sending email.');
//            }

            return $this->refresh();
        } 
        }

        return $this->render('index', [
            'model' => $model,
            'ownInfo' => $ownInfo,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sliderImages' => $sliderImages,
            'routes_from' => $routes_from,
            'routes_to' => $routes_to,
            'routes' => $routes,
            'transfers' => $transfers,
            'search' => $search,

        ]);

    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
//        } else {
//            return $this->render('login', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
//    public function actionLogout()
//    {
//        Yii::$app->user->logout();
//
//        return $this->goHome();
//    }


    /**
     * Displays contact page.
     *
     * @return mixed
     */


        public function actionContact()
    {
        $model = new ContactWrapper();
        $ownInfo = OwnerContactWrapper::find()->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            \Yii::$app->common->sendMail('testSubject','test text body','batya224@mail.ru');
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
                'ownInfo' => $ownInfo,
            ]);
        }
    }





    public function actionSubscribe()
    {
        $model = new SubscriberWrapper();
        $model->date = \Yii::$app->formatter->asDate(new \DateTime(), 'yyyy-MM-dd HH:mm:ss');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'There was an error sending email.');
        }

        return $this->redirect(Yii::$app->homeUrl);
    }


    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {


        return $this->render('about');
    }

    public function actionSearch()
    {
        if (isset($_GET['query'])) {
            $searchWord = $_GET['query'];
            $query = ItemLang::find();
            // add conditions that should always apply here

            $query = $query
                ->andWhere(['language' => Yii::$app->language]);
            if (isset($searchWord) && strlen(trim($searchWord))) {
                $query = $query->andWhere(['or',
                    ['like', 'title', $searchWord],
                    ['like', 'description', $searchWord],
                    ['like', 'content', $searchWord]
                ])->asArray()->all();
            }


            $model = new TmWord();

            $model = $model->find()
                ->orwhere("`word` LIKE '%".$searchWord."%'")
//                ->orwhere("`description` LIKE '%".$searchWord."%'")
//                ->orwhere("`example` LIKE '%".$searchWord."%'")
                ->andWhere('status = 1')
                ->orderBy('word', ASC)
                ->asArray()
                ->all();
            $model = $query + $model;

            $i = 0;

            foreach ( $query as $key => $value){
                $i++;
                $arr[$i] =['id' => $value['item_id'], 'title' => $value['title'], 'description' => $value['description']];
            }
            foreach ( $model as $key => $value){
                $i++;
                $arr[$i] =['id' => $value['id'], 'word' => $value['word'], 'description' => $value['description']];
            }

            return $this->render('search', [
                'model' => $model,
                'query' => $_GET['query']
            ]);
        }
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
//    public function actionSignup()
//    {
//        $model = new SignupForm();
//        if ($model->load(Yii::$app->request->post())) {
//            if ($user = $model->signup()) {
//                if (Yii::$app->getUser()->login($user)) {
//                    return $this->goHome();
//                }
//            }
//        }
//
//        return $this->render('signup', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
//    public function actionRequestPasswordReset()
//    {
//        $model = new PasswordResetRequestForm();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail()) {
//                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
//
//                return $this->goHome();
//            } else {
//                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
//            }
//        }
//
//        return $this->render('requestPasswordResetToken', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
//    public function actionResetPassword($token)
//    {
//        try {
//            $model = new ResetPasswordForm($token);
//        } catch (InvalidParamException $e) {
//            throw new BadRequestHttpException($e->getMessage());
//        }
//
//        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
//            Yii::$app->session->setFlash('success', 'New password was saved.');
//
//            return $this->goHome();
//        }
//
//        return $this->render('resetPassword', [
//            'model' => $model,
//        ]);
//    }

    public function subscriber($email){
        $model  =  new SubscribedUsers;
        $model->email = $email;
        $model->date_edited = date('Y-m-d h:m:s');
        $model->save();
        $this->sendMessage($model->email);
    }

    public function sendMessage($email)
    {
        return yii::$app->mailer->compose('subscribe')
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($email)
            ->setSubject('Subscribe')
            ->send();
    }



    public function actionSitemap()
    {
        $languages = $this->languages;
        if (is_array($languages)){
            foreach ($languages as $lang){
                yii::$app->language = $lang;
                $this->Category();
                $this->Item();
                $this->Freelance();
            }
        }
        $this->Dictionary();
        $this->sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    ' .
            $this->sitemap
            .'</urlset> ';
        echo "<pre>";
//        var_dump(dirname(dirname(__DIR__))."/uploads/sitemap.xml");
//        var_dump(dirname(dirname(__DIR__))."/sitemap.xml");die;
        $file = @fopen(dirname(dirname(__DIR__))."/uploads/sitemap.xml","w");
//        $file = @fopen(dirname(dirname(__DIR__))."/sitemap.xml","w");
//        var_dump($file);die;
        $resutl = @fwrite($file, $this->sitemap);
//
        @fclose($resutl);
        $this->redirect('/sitemap.xml');
    }

    public function Category()
    {

        $db = Yii::$app->db;// or Category::getDb()
        $model = $db->cache(function ($db){
            return CategoryWrapper::find()->where(['status' => '1', 'top' => '1'])->all();
        });

        foreach ($model  as $item ){
            $this->sitemap = $this->sitemap
                .'<url>'
                .'<loc>'
                .'http://ozisim.com'.$item->url
                .'</loc>'
                .'<changefreq>'
                .'monthly'
                .'</changefreq>'
                .'<priority>'
                .'1'
                .'</priority>'
                .'</url>';

        }
    }

    public function Item()
    {
        $homeUrl = 'http://ozisim.com';

        $db = Yii::$app->db;// or Category::getDb()
        $model = $db->cache(function ($db){
            return ItemWrapper::find()->where(['status' => '1'])->all();
        });
        foreach ($model  as $item ){
            if (yii::$app->language == 'tk')
                $url = $homeUrl.'/item/'.$item->id;
            else
                $url = $homeUrl.'/'.yii::$app->language.'/item/'.$item->id;
            $this->sitemap = $this->sitemap
                .'<url>'
                .'<loc>'
                .$url
                .'</loc>'
                .'<changefreq>'
                .'monthly'
                .'</changefreq>'
                .'<priority>'
                .'0.9'
                .'</priority>'
                .'</url>';

        }
    }


    public function Freelance()
    {
        $homeUrl = 'http://ozisim.com';
        $db = Yii::$app->db;// or Category::getDb()
        $model = $db->cache(function ($db){
            return FreelancerWrapper::find()->where(['status' => '1'])->all();
        });

        foreach ($model  as $item ){
            if (yii::$app->language == 'tk')
                $url = $homeUrl.'/freelance/'.$item->id;
            else
                $url = $homeUrl.'/'.yii::$app->language.'/freelance/'.$item->id;
            $this->sitemap = $this->sitemap
                .'<url>'
                .'<loc>'
                .$url
                .'</loc>'
                .'<changefreq>'
                .'monthly'
                .'</changefreq>'
                .'<priority>'
                .'0.8'
                .'</priority>'
                .'</url>';

        }
    }

    public function Dictionary()
    {
        $homeUrl = 'http://ozisim.com';

        $db = Yii::$app->db;// or Category::getDb()
        $model = $db->cache(function ($db){
            return TmWord::find()->where(['status' => '1'])->all();
        });
        foreach ($model  as $item ){
            $url = $homeUrl.'/business-instrument/dictionary-search?id='.$item->id;
            $this->sitemap = $this->sitemap
                .'<url>'
                .'<loc>'
                .$url
                .'</loc>'
                .'<changefreq>'
                .'yearly'
                .'</changefreq>'
                .'<priority>'
                .'0.7'
                .'</priority>'
                .'</url>';

        }
    }

    public function actionPrivacyPolicy()
    {
        return $this->render('privacy-policy');
    }

}
