<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "handler".
 *
 * @property int $id
 * @property int $category
 * @property string $text
 */
class Handler extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'handler';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category','date'], 'integer'],
            [['text'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'category' => 'Category',
            'text' => 'Text',
        ];
    }
}
