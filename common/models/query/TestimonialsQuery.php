<?php

namespace common\models\query;

use common\models\Testimonials;

/**
 * This is the ActiveQuery class for [[\common\models\Testimonials]].
 *
 * @see \common\models\Testimonials
 */
class TestimonialsQuery extends \yii\db\ActiveQuery
{
    /**
     * @return \common\models\query\TestimonialsQuery
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function active(): TestimonialsQuery
    {
        return $this->andWhere(['status' => Testimonials::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Testimonials[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Testimonials|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
