<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_comment}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $comment
 * @property string $fullname
 * @property string $email
 * @property string $site
 * @property integer $like_count
 * @property integer $dislike_count
 * @property string $related_to
 * @property integer $status
 * @property string $edited_username
 * @property string $create_username
 * @property string $date_created
 * @property string $date_modified
 * @property string $ip_added
 * @property string $ip_modified
 */
class Comment extends CommonActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'like_count', 'dislike_count', 'status'], 'integer'],
            [['comment'], 'string'],
            [['status'], 'required'],
            [['date_created', 'date_modified'], 'safe'],
            [['fullname', 'email', 'site', 'related_to', 'edited_username', 'create_username'], 'string', 'max' => 255],
            [['ip_added', 'ip_modified'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'comment' => Yii::t('app', 'Comment'),
            'fullname' => Yii::t('app', 'Fullname'),
            'email' => Yii::t('app', 'Email'),
            'site' => Yii::t('app', 'Site'),
            'like_count' => Yii::t('app', 'Like Count'),
            'dislike_count' => Yii::t('app', 'Dislike Count'),
            'related_to' => Yii::t('app', 'Related To'),
            'status' => Yii::t('app', 'Status'),
            'edited_username' => Yii::t('app', 'Edited Username'),
            'create_username' => Yii::t('app', 'Create Username'),
            'date_created' => Yii::t('app', 'Date Created'),
            'date_modified' => Yii::t('app', 'Date Modified'),
            'ip_added' => Yii::t('app', 'Ip Added'),
            'ip_modified' => Yii::t('app', 'Ip Modified'),
        ];
    }
}
