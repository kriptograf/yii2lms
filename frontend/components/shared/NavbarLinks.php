<?php

namespace frontend\components\shared;

use common\repositories\SettingsRepository;
use yii\base\Application;
use Yii;

class NavbarLinks implements \yii\base\BootstrapInterface
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
        Yii::$app->params['navBarLinks'] = $this->settingsRepository->getNavbarLinksSettings();
    }
}