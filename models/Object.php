<?php

namespace app\models;

use \yii\db\ActiveRecord;

/**
 * This is the abstract base model class for objects
 *
 * @property integer $id
 */

abstract class Object extends ActiveRecord
{
    public static $classes = [
        Sms::class,
        Task::class,
        Call::class,
        Fax::class,
    ];

    public const DIRECTION_INCOMING = 0;
    public const DIRECTION_OUTGOING = 1;

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}