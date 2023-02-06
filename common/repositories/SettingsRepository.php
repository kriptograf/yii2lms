<?php

namespace common\repositories;

use common\models\Settings;
use yii\helpers\VarDumper;

/**
 * Репозиторий настроек фронтенда
 *
 *
 * @package common\repositories
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class SettingsRepository
{
    public static int $tax        = 12;
    public static int $commission = 10;

    // Результат сохраняется в этих переменных
    // Если вы используете каждую функцию более одного раза на странице, база данных будет запрошена только один раз.
    public static $seoMetas, $socials,
        $footer, $general, $homeSections,
        $financial, $siteBankAccounts,
        $homeHero, $homeHero2, $homeVideoOrImage,
        $pageBackground, $customCssJs,
        $reportReasons, $notificationTemplates,
        $contactPage, $Error404Page, $navbarLink, $panelSidebar;

    // -- Имя настройки, С помощью этих ключей значения берутся из таблицы настроек
    public static string $seoMetasName              = 'seo_metas';
    public static string $socialsName               = 'socials';
    public static string $footerName                = 'footer';
    public static string $generalName               = 'general';
    public static string $homeSectionsName          = 'home_sections';
    public static string $financialName             = 'financial';
    public static string $siteBankAccountsName      = 'site_bank_accounts';
    public static string $homeHeroName              = 'home_hero';
    public static string $homeHeroName2             = 'home_hero2';
    public static string $homeVideoOrImageName      = 'home_video_or_image_box';
    public static string $pageBackgroundName        = 'page_background';
    public static string $customCssJsName           = 'custom_css_js';
    public static string $reportReasonsName         = 'report_reasons';
    public static string $notificationTemplatesName = 'notifications';
    public static string $contactPageName           = 'contact_us';
    public static string $Error404PageName          = '404';
    public static string $navbarLinkName            = 'navbar_links';
    public static string $panelSidebarName          = 'panel_sidebar';

    //statics
    public static array $pagesSeoMetas       = ['home', 'search', 'categories', 'classes', 'login', 'register', 'contact', 'blog', 'certificate_validation', 'instructors', 'organizations'];
    public static array $mainSettingSections = ['general', 'financial', 'payment', 'home_hero', 'home_hero2', 'page_background', 'home_video_or_image_box'];
    public static array $mainSettingPages    = ['general', 'financial', 'personalization', 'notifications', 'seo', 'customization', 'other'];

    /**
     * Получить настройки для главной страницы фронтенда
     *
     * @param string|null $key
     *
     * @return array|mixed|string|null
     * @throws \Throwable
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getHomeSectionsSettings(?string $key = null)
    {
        return $this->getSetting(static::$homeSections, self::$homeSectionsName, $key);
    }

    /**
     * Получить настройки сео для главной страницы
     *
     * @param string|null $key
     *
     * @return array|mixed|string|null
     * @throws \Throwable
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function getSeoHomeSettings(?string $key = null)
    {
        return $this->getSetting(self::$seoMetas, self::$seoMetasName, $key);
    }

    /**
     * Получить настройки в зависимости от переданных параметров
     *
     * @param $static
     * @param $name
     * @param $key
     *
     * @return array|mixed|string|null
     * @throws \Throwable
     * @author Виталий Москвин <foreach@mail.ru>
     */
    private function getSetting(&$static, $name, $key = null)
    {
        if (!isset($static)) {
            $static = Settings::getDb()->cache(function ($db) use ($name) {
                return Settings::findOne(['name' => $name]);
            }, 24 * 60 * 60);
        }

        $value = [];

        if (!empty($static) && isset($static->value)) {
            $value = json_decode($static->value, true);
        }

        if (!empty($value) and !empty($key)) {
            if (!empty($value[$key])) {
                return $value[$key];
            } else {
                return null;
            }
        }

        if (count($value) < 1 and !empty($key)) {
            return '';
        }

        return $value;
    }
}