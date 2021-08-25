<?php

namespace common\models\wrappers;

use common\models\Tag;
use sjaakp\taggable\TagBehavior;
use Yii;


class TagWrapper extends Tag
{
    public function behaviors()
    {
//        return [
//            'tag' => [
//                'class' => TagBehavior::class,
//                'junctionTable' => 'article_tag',
//                'modelClass' => Article::class,
//            ]
//        ];
    }
}
