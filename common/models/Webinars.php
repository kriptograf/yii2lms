<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "webinars".
 *
 * @property int $id
 * @property int|null $teacher_id
 * @property int|null $creator_id
 * @property int|null $category_id
 * @property string|null $type
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $start_date
 * @property int|null $duration
 * @property string|null $seo_description
 * @property string|null $thumbnail
 * @property string|null $image_cover
 * @property string|null $video_demo
 * @property int|null $capacity
 * @property int|null $price
 * @property string|null $description
 * @property int|null $support
 * @property int|null $downloadable
 * @property int|null $partner_instructor
 * @property int|null $subscribe
 * @property int|null $points
 * @property int|null $private
 * @property string|null $message_for_reviewer
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Accounting[] $accountings
 * @property Cart[] $carts
 * @property Categories $category
 * @property User $creator
 * @property Faqs[] $faqs
 * @property Favorites[] $favorites
 * @property FeatureWebinars[] $featureWebinars
 * @property Files[] $files
 * @property OrderItems[] $orderItems
 * @property Prerequisites[] $prerequisites
 * @property Purchases[] $purchases
 * @property Quizzes[] $quizzes
 * @property Sales[] $sales
 * @property Sessions[] $sessions
 * @property SpecialOffers[] $specialOffers
 * @property SubscribeUses[] $subscribeUses
 * @property Supports[] $supports
 * @property Tags[] $tags
 * @property User $teacher
 * @property TextLessons[] $textLessons
 * @property Tickets[] $tickets
 * @property WebinarFilterOption[] $webinarFilterOptions
 * @property WebinarPartnerTeacher[] $webinarPartnerTeachers
 * @property WebinarReports[] $webinarReports
 * @property WebinarReviews[] $webinarReviews
 */
class Webinars extends \yii\db\ActiveRecord
{
    const TYPE_WEBINAR = 'webinar';
    const TYPE_COURSE = 'course';
    const TYPE_TEXT_LESSON = 'text_lesson';

    const STATUS_ACTIVE = 'active';
    const STATUS_PENDING = 'pending';
    const STATUS_DRAFT = 'is_draft';
    const STATUS_INACTIVE = 'inactive';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'webinars';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_id', 'creator_id', 'category_id', 'duration', 'capacity', 'price', 'support', 'downloadable', 'points'], 'integer'],
            [['private'], 'boolean'],
            [['start_date', 'created_at', 'updated_at', 'partner_instructor', 'subscribe',], 'safe'],
            [['seo_description', 'description', 'message_for_reviewer'], 'string'],
            [['type', 'title', 'slug', 'thumbnail', 'image_cover', 'video_demo', 'status'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teacher_id' => 'Teacher ID',
            'creator_id' => 'Creator ID',
            'category_id' => 'Category ID',
            'type' => 'Type',
            'title' => 'Title',
            'slug' => 'Slug',
            'start_date' => 'Start Date',
            'duration' => 'Duration',
            'seo_description' => 'Seo Description',
            'thumbnail' => 'Thumbnail',
            'image_cover' => 'Image Cover',
            'video_demo' => 'Video Demo',
            'capacity' => 'Capacity',
            'price' => 'Price',
            'description' => 'Description',
            'support' => 'Support',
            'downloadable' => 'Downloadable',
            'partner_instructor' => 'Partner Instructor',
            'subscribe' => 'Subscribe',
            'points' => 'Points',
            'private' => 'Private',
            'message_for_reviewer' => 'Message For Reviewer',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function fields()
    {
        $fields = parent::fields();

        $fields['teacher'] = function () {
            return $this->teacher;
        };

        $fields['rate'] = function () {
            $sum = 0;
            foreach ($this->webinarReviews as $webinarReview) {
                $sum += $webinarReview->rates;
            }
        };

        return $fields;
    }

    /**
     * Gets query for [[Accountings]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AccountingQuery
     */
    public function getAccountings()
    {
        return $this->hasMany(Accounting::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CartQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CategoriesQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Creator]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    /**
     * Gets query for [[Faqs]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FaqsQuery
     */
    public function getFaqs()
    {
        return $this->hasMany(Faqs::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FavoritesQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorites::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[FeatureWebinars]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FeatureWebinarsQuery
     */
    public function getFeatureWebinars()
    {
        return $this->hasMany(FeatureWebinars::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FilesQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderItemsQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[Prerequisites]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PrerequisitesQuery
     */
    public function getPrerequisites()
    {
        return $this->hasMany(Prerequisites::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PurchasesQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchases::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[Quizzes]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\QuizzesQuery
     */
    public function getQuizzes()
    {
        return $this->hasMany(Quizzes::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SalesQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[Sessions]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SessionsQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Sessions::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[SpecialOffers]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SpecialOffersQuery
     */
    public function getSpecialOffers()
    {
        return $this->hasMany(SpecialOffers::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[SubscribeUses]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SubscribeUsesQuery
     */
    public function getSubscribeUses()
    {
        return $this->hasMany(SubscribeUses::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[Supports]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SupportsQuery
     */
    public function getSupports()
    {
        return $this->hasMany(Supports::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TagsQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tags::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(User::class, ['id' => 'teacher_id']);
    }

    /**
     * Gets query for [[TextLessons]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TextLessonsQuery
     */
    public function getTextLessons()
    {
        return $this->hasMany(TextLessons::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TicketsQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[WebinarFilterOptions]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WebinarFilterOptionQuery
     */
    public function getWebinarFilterOptions()
    {
        return $this->hasMany(WebinarFilterOption::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[WebinarPartnerTeachers]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WebinarPartnerTeacherQuery
     */
    public function getWebinarPartnerTeachers()
    {
        return $this->hasMany(WebinarPartnerTeacher::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[WebinarReports]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WebinarReportsQuery
     */
    public function getWebinarReports()
    {
        return $this->hasMany(WebinarReports::class, ['webinar_id' => 'id']);
    }

    /**
     * Gets query for [[WebinarReviews]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WebinarReviewsQuery
     */
    public function getWebinarReviews()
    {
        return $this->hasMany(WebinarReviews::class, ['webinar_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\WebinarsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\WebinarsQuery(get_called_class());
    }
}
