<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Tags]].
 *
 * @see \common\models\Tags
 */
class TagsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Tags[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Tags|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
