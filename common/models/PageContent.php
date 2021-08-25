<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_page_content".
 *
 * @property int $id
 * @property string $page
 * @property string $content
 */
class PageContent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_page_content';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page', 'content', 'description'], 'required'],
            [['content', 'content_ru', 'content_en'], 'string'],
            [['page'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page' => 'Page',
            'description' => 'Description',
            'content' => 'Content',
            'content_ru' => 'Content_ru',
            'content_en' => 'Content_en',

        ];
    }
}
