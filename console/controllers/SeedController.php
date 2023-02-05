<?php

namespace console\controllers;

use console\seeders\BlogTableSeeder;
use console\seeders\CategoryTableSeeder;
use console\seeders\FeatureWebinarTableSeeder;
use console\seeders\FiltersTableSeeder;
use console\seeders\PaymentChannelsTableSeeder;
use console\seeders\RolesTableSeeder;
use console\seeders\SectionsTableSeeder;
use console\seeders\SettingsTableSeeder;
use console\seeders\UsersTableSeeder;
use console\seeders\WebinarsTableSeeder;
use yii\console\Controller;

class SeedController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function actionIndex(): int
    {
        try {
            \Yii::$app->db->createCommand('SET foreign_key_checks = 0;')->execute();

            (new SectionsTableSeeder())->run();
            (new CategoryTableSeeder())->run();
            (new SettingsTableSeeder())->run();
            (new RolesTableSeeder())->run();
            (new UsersTableSeeder())->run();
            (new BlogTableSeeder())->run();
            (new PaymentChannelsTableSeeder())->run();
            (new FiltersTableSeeder())->run();
            (new WebinarsTableSeeder())->run();
            (new FeatureWebinarTableSeeder())->run();

            \Yii::$app->db->createCommand('SET foreign_key_checks = 1;')->execute();

            $this->stdout('Тестовые данные успешно добавлены!' . PHP_EOL);
        } catch(\Throwable $e) {
            $this->stdout($e->getMessage() . PHP_EOL);
            return 1;
        }

        return 0;
    }

}
