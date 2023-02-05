<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $subject
 * @property string|null $message
 * @property string|null $reply
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message', 'reply'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email', 'phone', 'subject', 'status'], 'string', 'max' => 255],
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
            'subject' => 'Subject',
            'message' => 'Message',
            'reply' => 'Reply',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ContactsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ContactsQuery(get_called_class());
    }
}
