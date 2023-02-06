<?php

namespace common\models\query;

use common\models\Webinars;

/**
 * This is the ActiveQuery class for [[\common\models\Webinars]].
 *
 * @see \common\models\Webinars
 */
class WebinarsQuery extends \yii\db\ActiveQuery
{
    public function active(): WebinarsQuery
    {
        return $this->andWhere(['status' => Webinars::STATUS_ACTIVE]);
    }

    public function noPrivate(): WebinarsQuery
    {
        return $this->andWhere(['private' => false]);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Webinars[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Webinars|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
