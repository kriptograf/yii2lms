<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Newsletters]].
 *
 * @see \common\models\Newsletters
 */
class NewslettersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Newsletters[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Newsletters|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
