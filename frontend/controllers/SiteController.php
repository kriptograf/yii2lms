<?php

namespace frontend\controllers;

use common\models\Subscribes;
use common\repositories\AdvertisingBannerRepository;
use common\repositories\BlogRepository;
use common\repositories\FeatureWebinarsRepository;
use common\repositories\SalesRepository;
use common\repositories\SettingsRepository;
use common\repositories\TestimonialsRepository;
use common\repositories\TrendCategoriesRepository;
use common\repositories\UserRepository;
use common\repositories\WebinarsRepository;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\rest\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    private FeatureWebinarsRepository $featureWebinarsRepository;
    private SettingsRepository $settingsRepository;
    private WebinarsRepository $webinarsRepository;
    private SalesRepository           $salesRepository;
    private TrendCategoriesRepository $trendCategoryRepository;
    private BlogRepository $blogRepository;
    private UserRepository         $userRepository;
    private TestimonialsRepository      $testimonialsRepository;
    private AdvertisingBannerRepository $advertisingBannerRepository;

    public function __construct(
        $id,
        $module,
        FeatureWebinarsRepository $featureWebinarsRepository,
        SettingsRepository $settingsRepository,
        WebinarsRepository $webinarsRepository,
        SalesRepository $salesRepository,
        TrendCategoriesRepository $trendCategoryRepository,
        BlogRepository $blogRepository,
        UserRepository $userRepository,
        TestimonialsRepository $testimonialsRepository,
        AdvertisingBannerRepository $advertisingBannerRepository,
        $config = []
    )
    {
        $this->featureWebinarsRepository = $featureWebinarsRepository;
        $this->settingsRepository = $settingsRepository;
        $this->webinarsRepository = $webinarsRepository;
        $this->salesRepository = $salesRepository;
        $this->trendCategoryRepository = $trendCategoryRepository;
        $this->blogRepository = $blogRepository;
        $this->userRepository = $userRepository;
        $this->testimonialsRepository = $testimonialsRepository;
        $this->advertisingBannerRepository = $advertisingBannerRepository;

        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
                'cors' => [
                    // -- Прописываем откуда придет запрос - @todo вынести в файл env когда будет подключено расширение
                    'Origin' => ['http://localhost:3000'],
                    // Разрешить доступ к учетным данным (файлы cookie, заголовки авторизации и т. д.) в браузере.
                    'Access-Control-Allow-Credentials' => true,
                    //'Access-Control-Allow-Origin' => '*',
                ],

            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     * @throws \Throwable
     */
    public function actionIndex()
    {
        $homeSectionsSettings = $this->settingsRepository->getHomeSectionsSettings();

        $featureWebinars = $this->featureWebinarsRepository->getFeatureForHomePage();

        if (!empty($homeSectionsSettings) && !empty($homeSectionsSettings['latest_classes'])) {
            $latestWebinars = $this->webinarsRepository->getLatest();
        }

        if (!empty($homeSectionsSettings) && !empty($homeSectionsSettings['best_sellers'])) {
            $bestSaleWebinarsIds = $this->salesRepository->getBestSaleWebinarsIds();
            $bestSaleWebinars = $this->webinarsRepository->getBestSales($bestSaleWebinarsIds);
        }

        if (!empty($homeSectionsSettings) && !empty($homeSectionsSettings['best_rates'])) {
            $bestRateWebinars = $this->webinarsRepository->getBestRate();
        }

        if (!empty($homeSectionsSettings) && !empty($homeSectionsSettings['discount_classes'])) {
            $hasDiscountWebinars = $this->webinarsRepository->getHasDiscountWebinars();
        }

        if (!empty($homeSectionsSettings) && !empty($homeSectionsSettings['free_classes'])) {
            $freeWebinars = $this->webinarsRepository->getFree();
        }

        if (!empty($homeSectionsSettings) && !empty($homeSectionsSettings['trend_categories'])) {
            $trendCategories = $this->trendCategoryRepository->getForHomepage();
        }

        if (!empty($homeSectionsSettings) && !empty($homeSectionsSettings['blog'])) {
            $blog = $this->blogRepository->getForHomepage();
        }

        if (!empty($homeSectionsSettings) && !empty($homeSectionsSettings['instructors'])) {
            $instructors = $this->userRepository->getInstructors();
        }

        if (!empty($homeSectionsSettings) && !empty($homeSectionsSettings['organizations'])) {
            $organizations = $this->userRepository->getOrganizations();
        }

        if (!empty($homeSectionsSettings) && !empty($homeSectionsSettings['testimonials'])) {
            $testimonials = $this->testimonialsRepository->getAllActive();
        }

        if (!empty($homeSectionsSettings) && !empty($homeSectionsSettings['subscribes'])) {
            $subscribes = Subscribes::find()->all();
        }

        $advertisingBanners = $this->advertisingBannerRepository->getForHomepage();

        $skillfulTeachersCount = $this->userRepository->getSkillfulTeachersCount();

        $studentsCount = $this->userRepository->getStudentCount();

        $liveClassCount = $this->webinarsRepository->getLiveClassCount();

        $offlineCourseCount = $this->webinarsRepository->getOfflineCourseCount();

        $seoSettings = $this->settingsRepository->getSeoHomeSettings('home');

        return $this->asJson(['data' => [
            'site' => 'this is rest response',
            'homeSectionsSettings' => $homeSectionsSettings,
            'featureWebinars' => $featureWebinars,
            'latestWebinars' => $latestWebinars ?? [],
            'bestSaleWebinars' => $bestSaleWebinars ?? [],
            'bestRateWebinars' => $bestRateWebinars ?? [],
            'hasDiscountWebinars' => $hasDiscountWebinars ?? [],
            'freeWebinars' => $freeWebinars ?? [],
            'trendCategories' => $trendCategories ?? [],
            'blog' => $blog ?? [],
            'instructors' => $instructors ?? [],
            'organizations' => $organizations ?? [],
            'testimonials' => $testimonials ?? [],
            'subscribes' => $subscribes ?? [],
            'advertisingBanners' => $advertisingBanners,
            'skillfulTeachersCount' => $skillfulTeachersCount,
            'studentsCount' => $studentsCount,
            'liveClassCount' => $liveClassCount,
            'offlineCourseCount' => $offlineCourseCount,
            'seoSettings' => $seoSettings,
        ]]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
