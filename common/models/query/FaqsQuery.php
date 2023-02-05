<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Faqs]].
 *
 * @see \common\models\Faqs
 */
class FaqsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Faqs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Faqs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
