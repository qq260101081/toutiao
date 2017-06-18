<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;


class User extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }


    /**
     * Finds user by openid
     *
     * @param string $openid
     * @return static|null
     */
    public static function findByOpenid($openid)
    {
        return static::findOne(['openid' => $openid]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

}
