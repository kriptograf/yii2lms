<?php

namespace frontend\components\shared;

use common\repositories\SettingsRepository;
use Yii;
use yii\base\Application;

class Footer implements \yii\base\BootstrapInterface
{
    private SettingsRepository $settingsRepository;

    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        Yii::$app->params['footerColumns'] = $this->settingsRepository->getFooterColumns();
        Yii::$app->params['footerSocials'] = $this->settingsRepository->getSocials();
    }
}