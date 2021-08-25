<?php

namespace common\models\wrappers;

use arogachev\ManyToMany\behaviors\ManyToManyBehavior;
use common\models\Album;
use common\models\Item;
use common\models\Comment;
use common\models\Music;
use Yii;
use yii\helpers\Url;

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
class CommentWrapper extends Comment
{
    public $items_rel = [];

    private $_url;

    public function getUrl($absolute = false)
    {
        if ($this->_url === null)
            $this->_url = Url::to(['comment/view', 'id' => $this->id]);

        if ($absolute == true)
            $this->_url = Yii::app()->createAbsoluteUrl($this->_url);
        return $this->_url;
    }


    public function behaviors()
    {
        return [
            [
                'class' => ManyToManyBehavior::className(),
                'relations' => [
                    [
                        'editableAttribute' => 'items_rel', // Editable attribute name
                        'name' => 'items',
                    ],
                ],
            ],
        ];
    }


    public function getItems()
    {
        return $this->hasMany(ItemWrapper::className(), ['id' => 'item_id'])
            ->viaTable('tbl_item_to_comment', ['comment_id' => 'id']);
    }


}
