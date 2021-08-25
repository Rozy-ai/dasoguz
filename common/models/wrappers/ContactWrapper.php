<?php

namespace common\models\wrappers;

use arogachev\ManyToMany\behaviors\ManyToManyBehavior;
use common\models\Album;
use common\models\Contact;
use common\models\Music;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%tbl_contact}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $subject
 * @property string $message
 * @property string $date_added
 * @property string $date_modified
 * @property string $edited_username
 * @property string $create_username
 */
class ContactWrapper extends Contact
{
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->message)
            ->send();
    }


}
