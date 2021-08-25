<?php
/**
 * Created by PhpStorm.
 * User: batyr
 * Date: 1/10/2020
 * Time: 11:59 PM
 */

namespace common\components;


use yii\rest\Serializer;
use yii\web\Link;

class RestSerializer extends Serializer
{


    protected function serializePagination($pagination)
    {
        return [
            'total' => $pagination->totalCount,
            'success' => true,
//            $this->linksEnvelope => Link::serialize($pagination->getLinks(true)),
//            $this->metaEnvelope => [
//                'totalCount' => $pagination->totalCount,
//                'pageCount' => $pagination->getPageCount(),
//                'currentPage' => $pagination->getPage() + 1,
//                'perPage' => $pagination->getPageSize(),
//            ],
        ];
    }

}