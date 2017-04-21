<?php
namespace frontend\controllers;

use app\models\SearchForm;
use pistol88\shop\models\Category;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use pistol88\shop\models\Product;
use pistol88\shop\models\Image;
use pistol88\shop\models\Price;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $model = new SearchForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $query = Html::encode($model->query);
            return $this->redirect(Yii::$app->urlManager->createUrl(['search', 'query' => $query]));
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $products = Product::getAll();
        $categoryModel = new Category();
        $goods = [];

        foreach($products as $good) {
            $category = [];
            $mainImage = Image::find()->where(['itemid' => $good->id, 'isMain' => 1])->one();
            $images = Image::find()->where(['itemid' => $good->id])->all();
            $price = Price::find()->where(['product_id' => $good->id])->all();

            if(!$mainImage) $mainImage = $images[0];
            $categoryId = $good->category_id;
            $categoryData = $categoryModel->find()->
                select('slug, parent_id')->
                where(['id' => $categoryId])->
                one();

            $category[] = $categoryData->slug;

            $categoryData = $categoryModel->find()->
                select('slug, parent_id')->
                where(['id' => $categoryData->parent_id])->
                one();

            $category[] = $categoryData->slug;

            $category = array_reverse($category);

            $detailUrl = "/";
            foreach($category as $item) $detailUrl .= $item . '/';
            $detailUrl .= $good->slug;

            $goods[] = [
                'mainImage'     => $mainImage,
                'images'        => $images,
                'price'         => $price,
                'is_promo'      => $good->is_promo,
                'category'      => $category,
                'detailUrl'     => $detailUrl,
                'available'     => $good->available,
                'text'          => $good->text,
                'short_text'    => $good->short_text,
                'name'          => $good->name,
                'is_popular'    => $good->is_popular
            ];
        }

        return $this->render('index', [
            'goods'         => $goods
        ]);
    }

    public function actionCatalog($catalog) {
        $productModel = new Product();

        # Вытаскиваем из url категорию
        $currentCategory = array_reverse(array_filter(explode('/', $catalog)))[0];

        # Находим в базе id этой категории
        $model = new Category();

        $categoryData = $model->find()->
            select('id, text, name, cond')->
            where(["slug" => $currentCategory])->
            one();

        if($categoryData != null){
            $categoryId = $categoryData->id;

            $categoryIds[] = $categoryId;
            $queryIds = $model->find()->
                select('id, slug, name')->
                where(['parent_id' => $categoryId])->
                all();

            if(!empty($queryIds)){
                foreach($queryIds as $item) {
                    $categoryIds[] = $item->id;
                }

                $categoryIdTNVD = 13;
                $productsTNVD = $productModel->find()->where(['category_id' => $categoryIdTNVD])->limit(4)->all();

                $productsIdCR = 14;
                $productsCR = $productModel->find()->where(['category_id' => $productsIdCR])->limit(10)->all();

                $productsIdDopTNVD = 15;
                $productsDopTNVD = $productModel->find()->where(['category_id' => $productsIdDopTNVD])->limit(2)->all();

                $productsIdDopCR = 16;
                $productsDopCR = $productModel->find()->where(['category_id' => $productsIdDopCR])->limit(2)->all();

                return $this->render('catalog', [
                    'catalog'           => $catalog,
                    'categoryId'        => $categoryId,
                    'productsTNVD'      => $productsTNVD,
                    'productsCR'        => $productsCR,
                    'productsDopTNVD'   => $productsDopTNVD,
                    'productsDopCR'     => $productsDopCR,
                    'categoryText'      => $categoryData->text,
                    'categoryTitle'     => $categoryData->name
                ]);
            } else {
                $categoryId = $categoryIds;
                $products = $productModel->find()->where(["category_id" => $categoryId])->limit(10)->all();

                return $this->render('subcatalog',[
                    'catalog'       => $catalog,
                    'products'      => $products,
                    'categoryTitle' => $categoryData->name,
                ]);
            }
        } else {
            $model = new Product();

            $modelData = $model->find()->
                select('id, text, name')->
                where(["slug" => $currentCategory])->
                one();

            $model = $model::findOne($modelData->id);
            #echo "<pre>"; var_dump($model->getFieldValues('seson')); exit;

            #var_dump($modelData);
            return $this->render('view', ["id" => $modelData->id, 'model' => $model]);
        }
    }

    public function actionView($catalog, $id) {
        $model = new Product();
        return $this->render('view', ["id" => $id, 'model' => $model]);
    }

    public function actionContacts() {
        return $this->render('contact', [

        ]);
    }

    public function actionSearch() {
        $query = Yii::$app->getRequest()->getQueryParam('query');

        $products = Product::find()->where("`name` like '%$query%' or `text` like '%$query%' or `short_text` like '%$query%' or `characteristics` like '%$query%' or `equipment` like '%$query%'")->all();

        return $this->render('search',[
            'query' => $query,
            'products' => $products
        ]);
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
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
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
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
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
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
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
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
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
        } catch (InvalidParamException $e) {
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
}
