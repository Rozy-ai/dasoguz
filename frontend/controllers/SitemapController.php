<?php

namespace frontend\controllers;

use common\models\wrappers\CategoryWrapper;
use common\models\wrappers\FreelancerWrapper;
use common\models\wrappers\ItemWrapper;
use Yii;
use yii\console\Controller;
use yii\helpers\Url;

class SitemapController extends Controller
{
    public $languages = ['tk', 'ru'];
    public $sitemap = '';

    public function actionIndex()
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

        $this->sitemap = '<?xml version="1.0" encoding="utf-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    ' .
            $this->sitemap
            .'</urlset> ';

        $file = fopen("frontend/web/sitemap.xml","w");

        fwrite($file, $this->sitemap);


        fclose($file);

    }

    public function Category()
    {

        $model  = CategoryWrapper::find()->where(['status' => '1', 'top' => '1'])->all();
        foreach ($model  as $item ){
            $this->sitemap = $this->sitemap
                .'<url>'
                .'<loc>'
                .$item->url
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
        $homeUrl = 'http::/ozisim.com';
        $model  = ItemWrapper::find()->where(['status' => '1'])->all();
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
        $homeUrl = 'http::/ozisim.com';

        $model  = FreelancerWrapper::find()->where(['status' => '1'])->all();
        foreach ($model  as $item ){
            if (yii::$app->language == 'tk')
                $url = $homeUrl.'/freelance/'.$item->id;
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
                .'0.8'
                .'</priority>'
                .'</url>';

        }
    }


}
