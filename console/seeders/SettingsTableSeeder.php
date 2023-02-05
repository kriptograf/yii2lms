<?php

namespace console\seeders;

use common\models\Settings;

class SettingsTableSeeder implements ITableSeeder
{
    /**
     * @inheritDoc
     * @throws \yii\db\Exception
     */
    public function run()
    {
        \Yii::$app->db->createCommand()->truncateTable(Settings::tableName())->execute();

        $items = $this->getData();

        foreach ($items as $item) {
            $setting = new Settings();
            $setting->page = $item['page'];
            $setting->name = $item['name'];
            $setting->save();
        }
    }

    /**
     * Возвращает массив с настройками
     * @return \string[][]
     * @author Виталий Москвин <foreach@mail.ru>
     */
    private function getData(): array
    {
        return [
            [
                'page' => 'seo',
                'name' => 'seo_metas',
            ],
            [
                'page' => 'general',
                'name' => 'socials',
            ],
            [
                'page' => 'other',
                'name' => 'footer',
            ],
            [
                'page' => 'general',
                'name' => 'general',
            ],
            [
                'page' => 'financial',
                'name' => 'financial',
            ],
            [
                'page' => 'personalization',
                'name' => 'home_hero',
            ],
            [
                'page' => 'customization',
                'name' => 'custom_css_js',
            ],
            [
                'page' => 'personalization',
                'name' => 'page_background',
            ],
            [
                'page' => 'personalization',
                'name' => 'home_hero2',
            ],
            [
                'page' => 'other',
                'name' => 'report_reasons',
            ],
            [
                'page' => 'notifications',
                'name' => 'notifications',
            ],
            [
                'page' => 'financial',
                'name' => 'site_bank_accounts',
            ],
            [
                'page' => 'other',
                'name' => 'contact_us',
            ],
            [
                'page' => 'personalization',
                'name' => 'home_sections',
            ],
            [
                'page' => 'other',
                'name' => 'navbar_links',
            ],
            [
                'page' => 'personalization',
                'name' => 'home_video_or_image_box',
            ],
            [
                'page' => 'other',
                'name' => '404',
            ],
            [
                'page' => 'personalization',
                'name' => 'panel_sidebar',
            ],
            [
                'page' => 'financial',
                'name' => 'referral',
            ],
            [
                'page' => 'general',
                'name' => 'features',
            ],
            [
                'page' => 'personalization',
                'name' => 'find_instructors',
            ],
            [
                'page' => 'personalization',
                'name' => 'reward_program',
            ],
            [
                'page' => 'general',
                'name' => 'rewards_settings',
            ],
            [
                'page' => 'financial',
                'name' => 'registration_packages_general',
            ],
            [
                'page' => 'financial',
                'name' => 'registration_packages_instructors',
            ],
            [
                'page' => 'financial',
                'name' => 'registration_packages_organizations',
            ],
            [
                'page' => 'personalization',
                'name' => 'become_instructor_section',
            ],
        ];
    }
}