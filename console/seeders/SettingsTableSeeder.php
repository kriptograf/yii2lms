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
            $setting->value = $item['value'];
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
                'value' => null,
            ],
            [
                'page' => 'general',
                'name' => 'socials',
                'value' => null,
            ],
            [
                'page' => 'other',
                'name' => 'footer',
                'value' => null,
            ],
            [
                'page' => 'general',
                'name' => 'general',
                'value' => '{"site_name":"Platform Title Lms","site_email":"foreach@mail.ru","site_phone":"123456789","site_language":"RU","register_method":"email","user_languages":["RU"],"fav_icon":"/store/favicon.png","logo":"/store/logo1.svg","footer_logo":"/store/logo.png","webinar_reminder_schedule":"1","preloading":"1","hero_section1":"1"}'
            ],
            [
                'page' => 'financial',
                'name' => 'financial',
                'value' => null,
            ],
            [
                'page' => 'personalization',
                'name' => 'home_hero',
                'value' => '{"title":"Test","description":"Description","hero_background":"\/store\/people.png"}'
            ],
            [
                'page' => 'customization',
                'name' => 'custom_css_js',
                'value' => null,
            ],
            [
                'page' => 'personalization',
                'name' => 'page_background',
                'value' => null,
            ],
            [
                'page' => 'personalization',
                'name' => 'home_hero2',
                'value' => null,
            ],
            [
                'page' => 'other',
                'name' => 'report_reasons',
                'value' => null,
            ],
            [
                'page' => 'notifications',
                'name' => 'notifications',
                'value' => null,
            ],
            [
                'page' => 'financial',
                'name' => 'site_bank_accounts',
                'value' => null,
            ],
            [
                'page' => 'other',
                'name' => 'contact_us',
                'value' => null,
            ],
            [
                'page' => 'personalization',
                'name' => 'home_sections',
                'value' => '{"trend_categories":"1","testimonials":"1","subscribes":"1","organizations":"1","instructors":"1"}'
            ],
            [
                'page' => 'other',
                'name' => 'navbar_links',
                'value' => null,
            ],
            [
                'page' => 'personalization',
                'name' => 'home_video_or_image_box',
                'value' => null,
            ],
            [
                'page' => 'other',
                'name' => '404',
                'value' => null,
            ],
            [
                'page' => 'personalization',
                'name' => 'panel_sidebar',
                'value' => null,
            ],
            [
                'page' => 'financial',
                'name' => 'referral',
                'value' => null,
            ],
            [
                'page' => 'general',
                'name' => 'features',
                'value' => null,
            ],
            [
                'page' => 'personalization',
                'name' => 'find_instructors',
                'value' => null,
            ],
            [
                'page' => 'personalization',
                'name' => 'reward_program',
                'value' => null,
            ],
            [
                'page' => 'general',
                'name' => 'rewards_settings',
                'value' => null,
            ],
            [
                'page' => 'financial',
                'name' => 'registration_packages_general',
                'value' => null,
            ],
            [
                'page' => 'financial',
                'name' => 'registration_packages_instructors',
                'value' => null,
            ],
            [
                'page' => 'financial',
                'name' => 'registration_packages_organizations',
                'value' => null,
            ],
            [
                'page' => 'personalization',
                'name' => 'become_instructor_section',
                'value' => null,
            ],
        ];
    }
}