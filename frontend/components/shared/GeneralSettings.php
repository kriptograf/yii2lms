<?php
namespace frontend\components\shared;

use common\repositories\SettingsRepository;
use Yii;

class GeneralSettings implements \yii\base\BootstrapInterface
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
        Yii::$app->params['generalSettings'] = $this->settingsRepository->getGeneralSettings();
    }
}