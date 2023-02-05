<?php

namespace console\seeders;

use common\models\PaymentChannels;

/**
 * Class PaymentChannelsTableSeeder
 * Наполнение данными о платежных каналах
 *
 * @package console\seeders
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class PaymentChannelsTableSeeder implements ITableSeeder
{
    /**
     * @inheritDoc
     */
    public function run()
    {
        \Yii::$app->db->createCommand()->truncateTable(PaymentChannels::tableName())->execute();

        $items = $this->getData();

        foreach ($items as $item) {
            $channel = new PaymentChannels();
            $channel->title = $item['title'];
            $channel->class_name = $item['class_name'];
            $channel->status = $item['status'];
            $channel->image = $item['image'];
            $channel->settings = $item['settings'];
            $channel->save();
        }
    }

    /**
     * Получить платежные каналы для вставки в БД
     * @return \string[][]
     * @author Виталий Москвин <foreach@mail.ru>
     */
    private function getData(): array
    {
        return [
            [
                'title'      => 'paypal',
                'class_name' => 'Paypal',
                'status'     => 'active',
                'image'      => '/img/default/charge/paypal.png',
                'settings'   => '',
            ],
            [
                'title'      => 'paystack',
                'class_name' => 'Paystack',
                'status'     => 'active',
                'image'      => '/img/default/charge/stripe.png',
                'settings'   => '',
            ],
            [
                'title'      => 'paytm',
                'class_name' => 'Paytm',
                'status'     => 'active',
                'image'      => '/img/default/charge/paytm.png',
                'settings'   => '',
            ],
            [
                'title'      => 'payu',
                'class_name' => 'Payu',
                'status'     => 'active',
                'image'      => '/img/default/charge/paytu.png',
                'settings'   => '',
            ],
            [
                'title'      => 'Razorpay',
                'class_name' => 'Razorpay',
                'status'     => 'active',
                'image'      => '/img/default/charge/paytu.png',
                'settings'   => '',
            ],
            [
                'title'      => 'Zarinpal',
                'class_name' => 'Zarinpal',
                'status'     => 'active',
                'image'      => '/img/default/charge/paytu.png',
                'settings'   => '',
            ],
            [
                'title'      => 'Stripe',
                'class_name' => 'Stripe',
                'status'     => 'active',
                'image'      => '/img/default/charge/paytu.png',
                'settings'   => '',
            ],
            [
                'title'      => 'Paysera',
                'class_name' => 'Paysera',
                'status'     => 'active',
                'image'      => '/img/default/charge/paytu.png',
                'settings'   => '',
            ],
            [
                'title'      => 'Yandex checkout',
                'class_name' => 'YandexCheckout',
                'status'     => 'active',
                'image'      => '/img/default/charge/paytu.png',
                'settings'   => '',
            ],
            [
                'title'      => 'Bitpay',
                'class_name' => 'Bitpay',
                'status'     => 'active',
                'image'      => '/img/default/charge/paytu.png',
                'settings'   => '',
            ],
            [
                'title'      => 'Midtrans',
                'class_name' => 'Midtrans',
                'status'     => 'active',
                'image'      => '/img/default/charge/paytu.png',
                'settings'   => '',
            ],
            [
                'title'      => 'Adyen',
                'class_name' => 'Adyen',
                'status'     => 'active',
                'image'      => '/img/default/charge/paytu.png',
                'settings'   => '',
            ],
            [
                'title'      => 'Flutterwave',
                'class_name' => 'Flutterwave',
                'status'     => 'active',
                'image'      => '/img/default/charge/paytu.png',
                'settings'   => '',
            ],
            [
                'title'      => 'Payfort',
                'class_name' => 'Payfort',
                'status'     => 'active',
                'image'      => '/img/default/charge/paytu.png',
                'settings'   => '',
            ],
        ];
    }
}