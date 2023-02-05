<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Certificates]].
 *
 * @see \common\models\Certificates
 */
class CertificatesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Certificates[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Certificates|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
