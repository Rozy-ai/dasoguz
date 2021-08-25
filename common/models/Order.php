<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_order".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $time
 * @property int $date
 * @property string $where
 * @property string $price
 * @property string $date_created
 * @property string $date_modified
 * @property string $create_username
 * @property string $message
 */
class Order extends CommonActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['name', 'date', 'where', 'price', 'message'], 'required'],
            // [['name', 'date', 'where', 'price', 'message'], 'required'],
            [['time', 'date_created'], 'safe'],
            [ [ 'time' ], 'compare', 'compareValue' => 4, 'operator' => '>=' ],
            [['date'], 'date', 'format'=>'php:Y-m-d'],
            [['where', 'message'], 'string'],
            [['price'], 'number'],
            [['name', 'email', 'phone'], 'string', 'max' => 250],
            [['date_created', 'date_modified'], 'safe'],
            [['create_username'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'time' => 'Time',
            'date' => 'Date',
            'where' => 'Where',
            'price' => 'Price',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
            'create_username' => 'Create Username',
            'message' => 'Message',
        ];
    }
}
