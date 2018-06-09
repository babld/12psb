<?php
namespace frontend\controllers;

use app\models\SearchForm;
use yii\web\HttpException;
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
use common\models\ProductReview;
use common\models\Service;
use common\models\Maintenance;

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
        if (preg_match('|index.php|', $_SERVER['REQUEST_URI'])){
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: /');
            exit();
        }

        $products = Product::find()->all();
        $goods = [];

        foreach($products as $good) {
            $category = [];
            $mainImage = Image::find()->where(['itemid' => $good->id, 'isMain' => 1])->one();
            $images = Image::find()->where(['itemid' => $good->id])->all();
            $price = Price::find()->where(['product_id' => $good->id])->all();

            if(!$mainImage) $mainImage = $images[0];
            $categoryId = $good->category_id;
            $categoryData = Category::find()->
                select('slug, parent_id')->
                where(['id' => $categoryId])->
                one();

            $category[] = $categoryData->slug;

            $categoryData = Category::find()->
                select('slug, parent_id')->
                where(['id' => $categoryData->parent_id])->
                one();

            $detailUrl = '/' . Category::findOne($categoryId)->getUrl() . '/' . $good->slug;

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
                'is_popular'    => $good->is_popular,
                'product'       => $good,
            ];
        }

        return $this->render('index', [
            'goods'         => $goods,
            'products'      => $products
        ]);
    }

    /**
     * @param $catalog
     * @return string
     * @throws HttpException
     */
    public function actionCatalog($catalog) {
        $category = $this->urlcheck($catalog);

        if($categoryIds = $this->categoryIds($category)){
            foreach($categoryIds as $id) {
                $products[] = [
                    'product' => Product::find()->where(['category_id' => $id])->orderBy('sort')->all()
                ];
            }

            foreach(array_filter(explode('/', $catalog)) as $item) {
                $breadcrumbs[] = $this->breadcrumb($item);
            }

            return $this->render('catalog', [
                'breadcrumbs' => $breadcrumbs,
                'products' => $products,
                'category' => Category::findOne(['slug' => $category]),
                'catalog' => $category == 'catalog' ? true : false
            ]);
        } else {
            $path = array_filter(explode('/', $catalog));
            array_pop($path);
            foreach($path as $item) {
                $breadcrumbs[] = $this->breadcrumb($item);
            }

            return $this->render('view', [
                'product' => Product::findOne(['slug' => $category]),
                'breadcrumbs' => $breadcrumbs
            ]);
        }
    }

    public function actionDelivery() {
        return $this->render('delivery');
    }

    public function actionZakaz($name) {

        return $this->renderAjax('zakaz', [
            'name' => $name
        ]);
    }

    public function breadcrumb($category) {
        $id = Category::findOne(['slug' => $category])->id;
        $link = [];
        $breadcrumbsname = [];
        $breadcrumbslinks = [];
        while($breadcrumb = Category::findOne(['id' => $id])) {
            $id = $breadcrumb->parent_id;
            $link[] = $breadcrumb->slug ;

            $breadcrumbsname[] = $breadcrumb->name;
            $breadcrumbslinks[] = implode("/", array_reverse($link));
        }

        $breadcrumbs = [
            'name' => $breadcrumbsname[0],
            'link' => array_reverse($breadcrumbslinks)[0]
        ];

        return $breadcrumbs;
    }

    /*
     * Проверка урла на сущестование всех подкаталогов (/catalog/stendy-tnvd/dop/ или /asdasdf/stendy/).
     * Если одного нет то выдает 404
     */
    public function urlcheck($catalog) {
        $i = 0;
        foreach(array_filter(explode('/', $catalog)) as $item){
            if(!Category::findOne(['slug' => $item])) {
                if(!$product = Product::findOne(['slug' => $item]))
                    throw new HttpException(404 ,'Страница не найдена');
            } else if($i++ == 0 && Category::findOne(['slug' => $item])->parent_id != NULL) {
                # Устраняем косяк с открытием одной и той же странице по разным ссылкам
                # Пример: /catalog/stendy-tnvd и /stendy-tnvd
                throw new HttpException(404 ,'Страница не найдена');
            }
        }
        return $item;
    }

    public function categoryIds($category) {
        # Находим в базе id категории
        if(!$categoryData = Category::findOne(['slug' => $category])) return null;

        $categoryIds[] = $categoryData->id;

        $this->testids($categoryData->id, $categoryIds);

        return $categoryIds;
    }

    public function testids($id, &$categoryIds) {
        #Находим подкатегории текущей категории
        $subcategories = Category::find()->
            where(['parent_id' => $id])->
            all();

        foreach($subcategories as $category) {
            if($category->parent_id) {
                $categoryIds[] = $category->id;
                $this->testids($category->id, $categoryIds);
            }
        }
    }

    public function debug($var) {
        echo "<pre>";
        var_dump($var);
        exit;
    }

    public function actionView($catalog, $id) {
        $model = new Product();
        return $this->render('view', ["id" => $id, 'model' => $model]);
    }

    public function actionContacts() {
        return $this->render('contact');
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
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionGoogleFeed() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'text/xml');

        return $this->renderPartial('google-feed', [
            'products' => Product::find()->all()
        ]);
    }
    
    public function actionYmlFeed() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'text/xml');

        return $this->renderPartial('yml', [
            'products' => Product::find()->all()
        ]);
    }

    public function actionSitemap() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'text/xml');

        $this->sitemapGen();
        /*$file = 'files/sitemap.xml';
        if(filectime($file) - 86400 > 0) {
            $fp = fopen($file, 'w+');

            fwrite($fp, 'file content');
            fclose($fp);
        }

        return $this->render('@frontend/web/files/sitemap.xml');*/
    }

    public function sitemapGen() {
        $products = Product::find()->all();
        $categories = Category::find()->all();
        $return = '<?xml version="1.0" encoding="UTF-8"?>';
        $return .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach($products as $product):
            $return .= '<url>';
            $return .= '<loc>http://12psb.ru/' . $product->category->getUrl() . '/' . $product->slug . '</loc>';
            $return .= '<lastmod>' . date('Y-m-d', $product->updated_at) . '</lastmod>';
            $return .= '<changefreq>daily</changefreq>';
            $return .= '<priority>0.8</priority>';
            $return .= '</url>';
        endforeach;

        foreach($categories as $category):
            $return .= '<url>';
            $return .= "<loc>http://12psb.ru/$category->url</loc>";
            $return .= '<lastmod>' . date('Y-m-d', $product->updated_at) . '</lastmod>';
            $return .= '<changefreq>daily</changefreq>';
            $return .= '<priority>0.8</priority>';
            $return .= '</url>';
        endforeach;

        $return .= '<url>';
        $return .= "<loc>http://12psb.ru/delivery</loc>";
        $return .= '<priority>0.8</priority>';
        $return .= '</url>';

        $return .= '<url>';
        $return .= "<loc>http://12psb.ru/contacts</loc>";
        $return .= '<priority>0.8</priority>';
        $return .= '</url>';


        $return .= '</urlset>';
        echo $return;
    }

    public function actionReview() {
        return $this->render('review');
    }

    public function actionService() {
        $goods = Product::findAll(['is_popular' => 'yes']);
        return $this->render('service', ['model' => Service::findOne(1), 'goods' => $goods]);
    }

    public function actionMaintenance() {
        $goods = Product::findAll(['is_popular' => 'yes']);
        return $this->render('maintenance', ['model' => Maintenance::findOne(1), 'goods' => $goods]);
    }

    public function actionFeedbackReview() {
        if($postData = yii::$app->request->post()) {
            $formData = $postData['ProductReview'];
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            // Спам защита. Если пусто скрытое поле значит форму заполнял не бот
            if(empty($formData['fullname'])) {
                $model = new ProductReview();

                if($model->load($postData) and $model->save()) {
                    if($adminEmail = \Yii::$app->params['adminEmail']) {
                        if(self::adminEmail($formData)) {
                            if(self::clientEmail($formData))
                                return ['success' => 'success'];

                            return ['success' => 'false', 'message' => 'client send error'];
                        } else {
                            return ['success' => 'false', 'message' => 'send to admin error'];
                        }
                    }
                    return ['success' => 'false', 'message' => 'admin email empty'];
                } else {
                    throw new HttpException(404 ,'Ошибка загрузки данных формы');
                }
            }
            return ['success' => 'ok'];
        }
        throw new HttpException(404 ,'Страница не найдена');
    }

    public static function adminEmail($data) {
        $mailer = Yii::$app->mailer->compose([
            'html' => 'feedback-html',
            'text' => 'feedback-text'
        ], [
            'post' => $data
        ])
            ->setTo([
                yii::$app->params['adminEmail']
            ])
            ->setFrom([yii::$app->params['robotEmail'] => 'Автоматическое уведомление'])
            ->setSubject(yii::$app->params['feedbackSubject'])
            ->send();
        if($mailer)
            return true;

        return false;
    }

    public static function clientEmail($data) {
        $mailer = Yii::$app->mailer->compose([
            'html' => 'feedbackClient-html',
            'text' => 'feedbackClient-text'
        ], [
            'post' => $data
        ])
            ->setTo([
                $data['email']
            ])
            ->setFrom([\Yii::$app->params['robotEmail'] => '12psb'])
            ->setSubject(yii::$app->params['feedbackSubject'])
            ->send();

        if($mailer)
            return true;

        return false;
    }
}
