<?php

namespace common\models\query;

use common\models\Blog;

/**
 * This is the ActiveQuery class for [[\common\models\Blog]].
 *
 * @see \common\models\Blog
 */
class BlogQuery extends \yii\db\ActiveQuery
{
    /**
     * @return \common\models\query\BlogQuery
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function publish(): BlogQuery
    {
        return $this->andWhere(['status' => Blog::STATUS_PUBLISH]);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Blog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Blog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
