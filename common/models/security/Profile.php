<?php
namespace common\models\security;

use common\models\wrappers\DocumentWrapper;
use dektrium\user\models\Profile as BaseProfile;

class Profile extends BaseProfile
{

    public function rules()
    {
        return [
            'bioString' => ['bio', 'string'],
            'timeZoneValidation' => ['timezone', 'validateTimeZone'],
            'publicEmailPattern' => ['public_email', 'email'],
            'gravatarEmailPattern' => ['gravatar_email', 'email'],
            'websiteUrl' => ['website', 'url'],
            'nameLength' => [['name', 'surname'], 'string', 'max' => 255],
            'publicEmailLength' => ['public_email', 'string', 'max' => 255],
            'gravatarEmailLength' => ['gravatar_email', 'string', 'max' => 255],
            'locationLength' => ['location', 'string', 'max' => 255],
            'websiteLength' => ['website', 'string', 'max' => 255],
            'addressLength' => ['address', 'string', 'max' => 255],
            'phoneLength' => ['phone', 'string', 'max' => 50],
            'companyLength' => ['company', 'string', 'max' => 50],
            [['document_id'], 'integer'],
            [['surname', 'license'], 'safe'],
        ];
    }


    public function attributeLabels()
    {
        return \yii\helpers\ArrayHelper::merge(parent::attributeLabels(), [
            'name' => \Yii::t('app', 'Firstname'),
            'surname' => \Yii::t('app', 'Lastname'),
            'location' => \Yii::t('app', 'House number'),
            'address' => \Yii::t('app', 'Postcode or zipcode'),
            'company' => \Yii::t('app', 'Company\Agency'),
            'bio' => \Yii::t('app', 'Street name'),
            'phone' => \Yii::t('app', 'Mobile number'),
            'license' => \Yii::t('app', 'License'),
        ]);
    }

    public function getDocument()
    {
        return $this->hasOne(DocumentWrapper::className(), ['id' => 'document_id']);
    }

    public function makeMockFiles($document)
    {
        $result = [];
        if (isset($document)) {
            $uploadPath = \Yii::getAlias('@uploads') . DIRECTORY_SEPARATOR . 'userProfile';
            if (is_file($uploadPath . '/' . $document->filename)) {
                $obj['id'] = $document->id;
                $obj['name'] = $document->org_filename;
                $obj['size'] = filesize($uploadPath . '/' . $document->filename);
//                $obj['url'] = Yii::$app->getHomeUrl().'web/uploads/'.$file->filename;
                $obj['url'] = $document->getThumb(120, 120);
                $result[] = $obj;
            }
        }

        return $result;
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['avatarUrl'] = function () {
            return $this->getAvatarUrl(200);
        };
//        $fields['prices'] = function () {
//            return $this->getRoomPrices();
//        };
//        $fields['is_liked'] = function () {
//            $checkActivity = $this->findAdvertActivity(AdvertActivityWrapper::TYPE_LIKE);
//            return isset($checkActivity);
//        };
        unset($fields['document_id'], $fields['gravatar_id']);
        return $fields;
    }

    public function getAvatarUrl($size = 200)
    {
        $doc = $this->document;
        if (isset($doc)) {
            return $doc->getThumb($size, $size, 'auto');
        }
        return 'http://www.gravatar.com/avatar?d=mm&f=y&s=' . $size;
    }


}
