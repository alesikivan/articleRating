<?php

namespace app\models;

use Yii;

class Rating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
     public function rules()
     {
         return [
             [['voice'], 'default', 'value' => '0'],
         ];
     }

}
