<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Word
 * @property integer $id
 * @property string $word
 * @property string $user_ip
 * @property integer $created_at
 */
class Word extends ActiveRecord
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return '{{%words}}';
    }

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['user_ip', 'word'], 'required']
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_ip' => 'IP Адресс пользователя',
            'word' => 'Склоняемое слово',
            'created_at' => 'Дата добавления'
        ];
    }
}
