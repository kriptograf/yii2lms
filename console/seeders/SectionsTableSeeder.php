<?php

namespace console\seeders;

use common\models\Sections;
use yii\db\QueryBuilder;

/**
 * Class SectionsTableSeeder
 * Наполнение данными таблицы разделов
 *
 * @package console\seeders
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class SectionsTableSeeder implements ITableSeeder
{
    /**
     * Запуск массовой вставки данных в БД
     *
     * @return mixed|void
     * @throws \yii\db\Exception
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function run()
    {
        \Yii::$app->db->createCommand()->truncateTable(Sections::tableName())->execute();

        Sections::create(1, 'admin_general_dashboard', 'Основная панель');
        Sections::create(2, 'admin_general_dashboard_show', 'Страница общей панели', 1);
        Sections::create(3, 'admin_general_dashboard_quick_access_links', 'Ссылки быстрого доступа на общей панели', 1);
        Sections::create(4, 'admin_general_dashboard_daily_sales_statistics', 'Раздел статистики типов ежедневных продаж', 1);
        Sections::create(5, 'admin_general_dashboard_income_statistics', 'Раздел статистики доходов', 1);
        Sections::create(6, 'admin_general_dashboard_total_sales_statistics', 'Общий раздел статистики продаж', 1);
        Sections::create(7, 'admin_general_dashboard_new_sales', 'Раздел новых продаж', 1);
        Sections::create(8, 'admin_general_dashboard_new_comments', 'Раздел новых комментариев', 1);
        Sections::create(9, 'admin_general_dashboard_new_tickets', 'Раздел новых тикетов', 1);
        Sections::create(10, 'admin_general_dashboard_new_reviews', 'Раздел новых отзывов', 1);
        Sections::create(11, 'admin_general_dashboard_sales_statistics_chart', 'График статистики продаж', 1);
        Sections::create(12, 'admin_general_dashboard_recent_comments', 'Раздел недавних комментариев', 1);
        Sections::create(13, 'admin_general_dashboard_recent_tickets', 'Раздел последних тикетов', 1);
        Sections::create(14, 'admin_general_dashboard_recent_webinars', 'Раздел недавних вебинаров', 1);
        Sections::create(15, 'admin_general_dashboard_recent_courses', 'Раздел «Недавние курсы»', 1);
        Sections::create(16, 'admin_general_dashboard_users_statistics_chart', 'График статистики пользователей', 1);
        Sections::create(17, 'admin_clear_cache', 'Очистить кэш');

        Sections::create(25, 'admin_marketing_dashboard', 'Маркетинговая панель');
        Sections::create(26, 'admin_marketing_dashboard_show', 'Страница маркетинговой панели', 25);

        Sections::create(50, 'admin_roles', 'Роли');
        Sections::create(51, 'admin_roles_list', 'Список ролей', 50);
        Sections::create(52, 'admin_roles_create', 'Создание роли', 50);
        Sections::create(53, 'admin_roles_edit', 'Редактирование роли', 50);
        Sections::create(54, 'admin_roles_delete', 'Удаление роли', 50);

        Sections::create(100, 'admin_users', 'Пользователи');
        Sections::create(101, 'admin_staffs_list', 'Список сотрудников', 100);
        Sections::create(102, 'admin_users_list', 'Список студентов', 100);
        Sections::create(103, 'admin_instructors_list', 'Список преподавателей', 100);
        Sections::create(104, 'admin_organizations_list', 'Список организаций', 100);
        Sections::create(105, 'admin_users_create', 'Добавление пользователя', 100);
        Sections::create(106, 'admin_users_edit', 'Редактирование пользователя', 100);
        Sections::create(107, 'admin_users_delete', 'Удаление пользователя', 100);
        Sections::create(108, 'admin_users_export_excel', 'Экспорт списка в Excel', 100);
        Sections::create(109, 'admin_users_badges', 'Значки пользователей', 100);
        Sections::create(110, 'admin_users_badges_edit', 'Редактирование значков', 100);
        Sections::create(111, 'admin_users_badges_delete', 'Удаление значков', 100);
        Sections::create(112, 'admin_users_impersonate', 'Вход под другим пользователем', 100);
        Sections::create(113, 'admin_become_instructors_list', 'Списки заявок на получение статуса преподавателя', 100);
        Sections::create(114, 'admin_become_instructors_reject', 'Отклонение запросов на получение статуса преподавателя', 100);
        Sections::create(115, 'admin_become_instructors_delete', 'Удаление заявок на получение статуса преподавателя', 100);

        Sections::create(150, 'admin_webinars', 'Вебинары');
        Sections::create(151, 'admin_webinars_list', 'Список вебинаров', 150);
        Sections::create(152, 'admin_webinars_create', 'Создание вебинара', 150);
        Sections::create(153, 'admin_webinars_edit', 'Редактирование вебинара', 150);
        Sections::create(154, 'admin_webinars_delete', 'Удаление вебинара', 150);
        Sections::create(155, 'admin_webinars_export_excel', 'Экспорт списка в Excel', 150);
        Sections::create(156, 'admin_feature_webinars', 'Список тематических вебинаров', 150);
        Sections::create(157, 'admin_feature_webinars_create', 'Создание тематического вебинара', 150);
        Sections::create(158, 'admin_feature_webinars_export_excel', 'Экспорт списка в Excel', 150);

        Sections::create(200, 'admin_categories', 'Категории');
        Sections::create(201, 'admin_categories_list', 'Список категорий', 200);
        Sections::create(202, 'admin_categories_create', 'Создание категории', 200);
        Sections::create(203, 'admin_categories_edit', 'Редактирование категории', 200);
        Sections::create(204, 'admin_categories_delete', 'Удаление категории', 200);
        Sections::create(205, 'admin_trending_categories', 'Список категорий направлений', 200);
        Sections::create(206, 'admin_create_trending_categories', 'Создание категорий направлений', 200);
        Sections::create(207, 'admin_edit_trending_categories', 'Редактирование категорий направлений', 200);
        Sections::create(208, 'admin_delete_trending_categories', 'Удаление категорий направлений', 200);

        Sections::create(250, 'admin_tags', 'Теги');
        Sections::create(251, 'admin_tags_list', 'Список тегов', 250);
        Sections::create(252, 'admin_tags_create', 'Создание тегов', 250);
        Sections::create(253, 'admin_tags_edit', 'Редактирование тегов', 250);
        Sections::create(254, 'admin_tags_delete', 'Удаление тегов', 250);

        Sections::create(300, 'admin_filters', 'Фильтры');
        Sections::create(301, 'admin_filters_list', 'Список фильтров', 300);
        Sections::create(302, 'admin_filters_create', 'Создание фильтров', 300);
        Sections::create(303, 'admin_filters_edit', 'Редактирование фильтров', 300);
        Sections::create(304, 'admin_filters_delete', 'Удаление фильтров', 300);

        Sections::create(350, 'admin_quizzes', 'Опросы');
        Sections::create(351, 'admin_quizzes_list', 'Список опросов', 350);
        Sections::create(352, 'admin_quizzes_edit', 'Редактирование опросов', 350);
        Sections::create(353, 'admin_quizzes_delete', 'Удаление опросов', 350);
        Sections::create(354, 'admin_quizzes_results', 'Результаты опросов', 350);
        Sections::create(355, 'admin_quizzes_results_delete', 'Удаление результатов', 350);
        Sections::create(356, 'admin_quizzes_lists_excel', 'Экспорт опросов в Excel', 350);

        Sections::create(400, 'admin_quiz_result', 'Результаты опросов');
        Sections::create(401, 'admin_quiz_result_list', 'Список результатов опросов', 400);
        Sections::create(402, 'admin_quiz_result_create', 'Создание результатов опросов', 400);
        Sections::create(403, 'admin_quiz_result_edit', 'Редактирование результатов опросов', 400);
        Sections::create(404, 'admin_quiz_result_delete', 'Удаление результатов опросов', 400);
        Sections::create(405, 'admin_quiz_result_export_excel', 'Экспорт результатов в Excel', 400);

        Sections::create(450, 'admin_certificate', 'Сертификаты');
        Sections::create(451, 'admin_certificate_list', 'Список сертификатов', 450);
        Sections::create(452, 'admin_certificate_create', 'Создание сертификата', 450);
        Sections::create(453, 'admin_certificate_edit', 'Редактирование сертификата', 450);
        Sections::create(454, 'admin_certificate_delete', 'Удаление сертификата', 450);

        Sections::create(455, 'admin_certificate_template_list', 'Список шаблонов сертификатов');
        Sections::create(456, 'admin_certificate_template_create', 'Создание шаблона сертификата', 455);
        Sections::create(457, 'admin_certificate_template_edit', 'Редактирование шаблона сертификата', 455);
        Sections::create(458, 'admin_certificate_template_delete', 'Удаление шаблона сертификата', 455);
        Sections::create(459, 'admin_certificate_export_excel', 'Экспорт шаблонов в Excel', 455);

        Sections::create(500, 'admin_discount_codes', 'Скидочные коды');
        Sections::create(501, 'admin_discount_codes_list', 'Список скидочных кодов', 500);
        Sections::create(502, 'admin_discount_codes_create', 'Создание скидочных кодов', 500);
        Sections::create(503, 'admin_discount_codes_edit', 'Редактирование скидочных кодов', 500);
        Sections::create(504, 'admin_discount_codes_delete', 'Удаление скидочных кодов', 500);
        Sections::create(505, 'admin_discount_codes_export', 'Экспорт скидочных кодов в Excel', 500);

        Sections::create(550, 'admin_group', 'Группы');
        Sections::create(551, 'admin_group_list', 'Список групп', 550);
        Sections::create(552, 'admin_group_create', 'Создание групп', 550);
        Sections::create(553, 'admin_group_edit', 'Редактирование групп', 550);
        Sections::create(554, 'admin_group_delete', 'Удаление групп', 550);

        Sections::create(600, 'admin_payment_channel', 'Платежные каналы');
        Sections::create(601, 'admin_payment_channel_list', 'Список платежных каналов', 600);
        Sections::create(602, 'admin_payment_channel_toggle_status', 'активный или неактивный канал', 600);
        Sections::create(603, 'admin_payment_channel_edit', 'Редактирование платежных каналов', 600);

        Sections::create(650, 'admin_settings', 'Настройки');
        Sections::create(651, 'admin_settings_general', 'Основные настройки', 650);
        Sections::create(652, 'admin_settings_financial', 'Настройки финансов', 650);
        Sections::create(653, 'admin_settings_personalization', 'Настройки персонализации', 650);
        Sections::create(654, 'admin_settings_notifications', 'Настройки уведомлений', 650);
        Sections::create(655, 'admin_settings_seo', 'Настройки SEO', 650);
        Sections::create(656, 'admin_settings_customization', 'Настройки кастомизации', 650);

        Sections::create(700, 'admin_blog', 'Блог');
        Sections::create(701, 'admin_blog_lists', 'Список блогов', 700);
        Sections::create(702, 'admin_blog_create', 'Создание блога', 700);
        Sections::create(703, 'admin_blog_edit', 'Редактирование блога', 700);
        Sections::create(704, 'admin_blog_delete', 'Удаление блога', 700);
        Sections::create(705, 'admin_blog_categories', 'Категории блога', 700);
        Sections::create(706, 'admin_blog_categories_create', 'Создание категории блога', 700);
        Sections::create(707, 'admin_blog_categories_edit', 'Редактирование категории блога', 700);
        Sections::create(708, 'admin_blog_categories_delete', 'Удаление категории блога', 700);

        Sections::create(750, 'admin_sales', 'Продажи');
        Sections::create(751, 'admin_sales_list', 'Список продаж', 750);
        Sections::create(752, 'admin_sales_refund', 'Возврат продаж', 750);
        Sections::create(753, 'admin_sales_invoice', 'Счета продаж', 750);
        Sections::create(754, 'admin_sales_export', 'Экспорт продаж в Excel', 750);

        Sections::create(800,'admin_documents', 'Балансы');
        Sections::create(801, 'admin_documents_list', 'Список балансов', 800);
        Sections::create(802, 'admin_documents_create', 'Создание балансов', 800);
        Sections::create(803, 'admin_documents_print', 'Печать балансов', 800);

        Sections::create(850, 'admin_payouts', 'Выплаты');
        Sections::create(851, 'admin_payouts_list', 'Список выплат', 850);
        Sections::create(852, 'admin_payouts_reject', 'Отклоненные выплаты', 850);
        Sections::create(853, 'admin_payouts_payout', 'Принятые выплаты', 850);
        Sections::create(854, 'admin_payouts_export_excel', 'Экспорт выплат в excel', 850);

        Sections::create(900, 'admin_offline_payments', 'Офлайн платежи');
        Sections::create(901, 'admin_offline_payments_list', 'Список офлайн-платежей', 900);
        Sections::create(902, 'admin_offline_payments_reject', 'Отклоненные офлайн-платежи', 900);
        Sections::create(903, 'admin_offline_payments_approved', 'Утвержденные офлайн-платежи', 900);
        Sections::create(904, 'admin_offline_payments_export_excel', 'Экспорт офлайн-платежей в Excel', 900);

        Sections::create(950, 'admin_supports', 'Поддержка');
        Sections::create(951, 'admin_supports_list', 'Список', 950);
        Sections::create(952, 'admin_support_send', 'Отправления', 950);
        Sections::create(953, 'admin_supports_reply', 'Ответы', 950);
        Sections::create(954, 'admin_supports_delete', 'Удалить', 950);
        Sections::create(955, 'admin_support_departments', 'Отделы поддержки', 950);
        Sections::create(956, 'admin_support_department_create', 'Добавить отдел поддержки', 950);
        Sections::create(957, 'admin_support_departments_edit', 'Редактировать отдел поддержки', 950);
        Sections::create(958, 'admin_support_departments_delete', 'Удалить отдел поддержки', 950);
        Sections::create(959, 'admin_support_course_conversations', 'Переписка курсов', 950);

        Sections::create(1000, 'admin_subscribe', 'Подписки');
        Sections::create(1001, 'admin_subscribe_list', 'Список подписок', 1000);
        Sections::create(1002, 'admin_subscribe_create', 'Создание подписок', 1000);
        Sections::create(1003, 'admin_subscribe_edit', 'Редактирование подписок', 1000);
        Sections::create(1004, 'admin_subscribe_delete', 'Удаление подписок', 1000);

        Sections::create(1050, 'admin_notifications', 'Уведомления');
        Sections::create(1051, 'admin_notifications_list', 'Список уведомлений', 1050);
        Sections::create(1052, 'admin_notifications_send', 'Отправка уведомлений', 1050);
        Sections::create(1053, 'admin_notifications_edit', 'Редактирование и просмотр уведомлений', 1050);
        Sections::create(1054, 'admin_notifications_delete', 'Удаление уведомлений', 1050);
        Sections::create(1055, 'admin_notifications_markAllRead', 'Отметить все уведомления как прочитанные', 1050);
        Sections::create(1056, 'admin_notifications_templates', 'Шаблоны уведомлений', 1050);
        Sections::create(1057, 'admin_notifications_template_create', 'Создать шаблон уведомления', 1050);
        Sections::create(1058, 'admin_notifications_template_edit', 'Изменить шаблон уведомления', 1050);
        Sections::create(1059, 'admin_notifications_template_delete', 'Удалить шаблон уведомления', 1050);

        Sections::create(1075, 'admin_noticeboards', 'Объявления');
        Sections::create(1076, 'admin_noticeboards_list', 'Список объявлений', 1075);
        Sections::create(1077, 'admin_noticeboards_send', 'Отправка объявлений', 1075);
        Sections::create(1078, 'admin_noticeboards_edit', 'Редактирование объявлений', 1075);
        Sections::create(1079, 'admin_noticeboards_delete', 'Удаление объявлений', 1075);

        Sections::create(1100, 'admin_promotion', 'Акции');
        Sections::create(1101, 'admin_promotion_list', 'Список акций', 1100);
        Sections::create(1102, 'admin_promotion_create', 'Создание акции', 1100);
        Sections::create(1103, 'admin_promotion_edit', 'Редактирование акции', 1100);
        Sections::create(1104, 'admin_promotion_delete', 'Удаление акции', 1100);

        Sections::create(1150, 'admin_testimonials', 'Отзывы');
        Sections::create(1151, 'admin_testimonials_list', 'Список отзывов', 1150);
        Sections::create(1152, 'admin_testimonials_create', 'Создание отзыва', 1150);
        Sections::create(1153, 'admin_testimonials_edit', 'Редактирование отзыва', 1150);
        Sections::create(1154, 'admin_testimonials_delete', 'Удаление отзыва', 1150);

        Sections::create(1200, 'admin_advertising', 'Реклама');
        Sections::create(1201, 'admin_advertising_banners', 'Список рекламных баннеров', 1200);
        Sections::create(1202, 'admin_advertising_banners_create', 'Создание рекламного баннера', 1200);
        Sections::create(1203, 'admin_advertising_banners_edit', 'Редактирование рекламного баннера', 1200);
        Sections::create(1204, 'admin_advertising_banners_delete', 'Удаление рекламного баннера', 1200);

        Sections::create(1230, 'admin_newsletters', 'Новостная рассылка');
        Sections::create(1231, 'admin_newsletters_lists', 'Список новостных рассылок', 1230);
        Sections::create(1232, 'admin_newsletters_delete', 'Удаление новостных рассылок', 1230);
        Sections::create(1233, 'admin_newsletters_export_excel', 'Экспорт рассылки в Excel', 1230);

        Sections::create(1250, 'admin_contacts', 'Контакты');
        Sections::create(1251, 'admin_contacts_lists', 'Список контактов', 1250);
        Sections::create(1252, 'admin_contacts_reply', 'Ответы', 1250);
        Sections::create(1253, 'admin_contacts_delete', 'Удаление контактов', 1250);

        Sections::create(1300, 'admin_product_discount', 'Скидки на продукт');
        Sections::create(1301, 'admin_product_discount_list', 'Список скидок', 1300);
        Sections::create(1302, 'admin_product_discount_create', 'Создать скидку', 1300);
        Sections::create(1303, 'admin_product_discount_edit', 'Редактировать скидку', 1300);
        Sections::create(1304, 'admin_product_discount_delete', 'Удалить скидку', 1300);
        Sections::create(1305, 'admin_product_discount_export', 'Экспорт скидок в Excel', 1300);

        Sections::create(1350, 'admin_pages', 'Страницы');
        Sections::create(1351, 'admin_pages_list', 'Список страниц', 1350);
        Sections::create(1352, 'admin_pages_create', 'Создание страницы', 1350);
        Sections::create(1353, 'admin_pages_edit', 'Редактирование страницы', 1350);
        Sections::create(1354, 'admin_pages_toggle', 'Переключение страниц между опубликовано/черновик', 1350);
        Sections::create(1355, 'admin_pages_delete', 'Удаление страницы', 1350);

        Sections::create(1400, 'admin_comments', 'Комментарии');
        Sections::create(1401, 'admin_webinar_comments', 'Комментарии к мастер-классам', 1400);
        Sections::create(1402, 'admin_webinar_comments_edit', 'Редактирование комментариев к мастер-классам', 1400);
        Sections::create(1403, 'admin_webinar_comments_reply', 'Ответ на комментарии к мастер-классам', 1400);
        Sections::create(1404, 'admin_webinar_comments_delete', 'Удаление комментариев к мастер-классам', 1400);
        Sections::create(1405, 'admin_webinar_comments_status', 'Статус комментариев к мастер-классам (активные или ожидающие рассмотрения)', 1400);
        Sections::create(1406, 'admin_blog_comments', 'Комментарии в блоге', 1400);
        Sections::create(1407, 'admin_blog_comments_edit', 'Редактировать комментарии в блоге', 1400);
        Sections::create(1408, 'admin_blog_comments_reply', 'Ответы на комментарии в блоге', 1400);
        Sections::create(1409, 'admin_blog_comments_delete', 'Удалить комментарии в блоге', 1400);
        Sections::create(1410, 'admin_blog_comments_status', 'Статус комментариев в блоге (активные или ожидающие рассмотрения)', 1400);

        Sections::create(1450, 'admin_reports', 'Жалобы');
        Sections::create(1451, 'admin_webinar_reports', 'Жалобы на мастер-классы', 1450);
        Sections::create(1452, 'admin_webinar_comments_reports', 'Жалобы на комментарии к мастер-классам', 1450);
        Sections::create(1453, 'admin_webinar_reports_delete', 'Удаление жалоб на мастер-классы', 1450);
        Sections::create(1454, 'admin_blog_comments_reports', 'Жалобы на комментарии в блоге', 1450);
        Sections::create(1455, 'admin_report_reasons', 'Причины жалоб', 1450);

        Sections::create(1500, 'admin_additional_pages', 'Дополнительные страницы');
        Sections::create(1501, 'admin_additional_pages_404', 'Настройки страницы ошибки 404', 1500);
        Sections::create(1502, 'admin_additional_pages_contact_us', 'Настройки страницы контактов', 1500);
        Sections::create(1503, 'admin_additional_pages_footer', 'Настройки футера', 1500);
        Sections::create(1504, 'admin_additional_pages_navbar_links', 'Настройки ссылок верхней панели навигации', 1500);

        Sections::create(1550, 'admin_appointments', 'Встречи');
        Sections::create(1551, 'admin_appointments_lists', 'Список встреч', 1550);
        Sections::create(1552, 'admin_appointments_join', 'Присоединения ко встречам', 1550);
        Sections::create(1553, 'admin_appointments_send_reminder', 'Отправка напоминаний о встречах', 1550);
        Sections::create(1554, 'admin_appointments_cancel', 'Отмененные встречи', 1550);

        Sections::create(1600, 'admin_reviews', 'Отзывы');
        Sections::create(1601, 'admin_reviews_lists', 'Список отзывов', 1600);
        Sections::create(1602, 'admin_reviews_status_toggle', 'Переключение статуса отзывов (опубликовать или скрыть)', 1600);
        Sections::create(1603, 'admin_reviews_detail_show', 'Страница с подробной информацией об отзыве', 1600);
        Sections::create(1604, 'admin_reviews_delete', 'Удаление отзыва', 1600);

        Sections::create(1650, 'admin_consultants', 'Консультанты');
        Sections::create(1651, 'admin_consultants_lists', 'Список консультантов');
        Sections::create(1652, 'admin_consultants_export_excel', 'Экспорт консультантов в Excel');
    }
}