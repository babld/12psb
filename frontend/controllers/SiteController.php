<?php
namespace frontend\controllers;

use app\components\SendToBitrix;
use app\models\SearchForm;
use common\models\FeedbackForm;
use common\models\Page;
use common\models\UserReview;
use common\models\Video;
use frontend\components\Helpers;
use frontend\models\ContactForm;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use pistol88\shop\models\Category;
use yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;
use pistol88\shop\models\Product;
use common\models\ProductReview;
use common\models\Service;
use common\models\Maintenance;
use common\models\Blog;
use app\components\Helper;


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
        return $this->render('index', [
            'products'      => Product::find()->all(),
            'videos'        => Video::findAll(['active' => 'yes']),
            'instImages'    => $this->instagramPhotos(),
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

    public function actionTurbo()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'text/xml');


        $categoryIds = $this->categoryIds('catalog');
        foreach($categoryIds as $id) {
            $products[] = [
                'product' => Product::find()->where(['category_id' => $id])->orderBy('sort')->all()
            ];
        }

        return $this->renderPartial('turbo', [
            'products' => $products,
        ]);
    }

    public function actionDelivery() {
        return $this->render('delivery');
    }

    public function actionZakaz($name) {
        $model = new ContactForm();

        return $this->renderAjax('zakaz', [
            'name' => $name,
//            'model' => $model,
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

        $sitemap = $this->sitemapGen();
        return $this->renderPartial('sitemap', ['sitemap' => $sitemap]);
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
        $protocol = 'https://';
        $host = '12psb.ru';

        foreach($products as $product):
            $return .= '<url>';
            $return .= "<loc>$protocol$host/" . $product->category->getUrl() . '/' . $product->slug . '</loc>';
            $return .= '<lastmod>' . date('Y-m-d', $product->updated_at) . '</lastmod>';
            $return .= '<changefreq>daily</changefreq>';
            $return .= '<priority>0.8</priority>';
            $return .= '</url>';
        endforeach;

        foreach($categories as $category):
            $return .= '<url>';
            $return .= "<loc>$protocol$host/$category->url</loc>";
            $return .= '<lastmod>' . date('Y-m-d', $product->updated_at) . '</lastmod>';
            $return .= '<changefreq>daily</changefreq>';
            $return .= '<priority>0.8</priority>';
            $return .= '</url>';
        endforeach;

        $return .= '<url>';
        $return .= "<loc>$protocol$host/delivery</loc>";
        $return .= '<priority>0.8</priority>';
        $return .= '</url>';

        $return .= '<url>';
        $return .= "<loc>$protocol$host/contacts</loc>";
        $return .= '<priority>0.8</priority>';
        $return .= '</url>';

        $return .= '<url>';
        $return .= "<loc>$protocol$host/blog</loc>";
        $return .= '<priority>0.8</priority>';
        $return .= '</url>';

        foreach(Blog::findAll(['active' => 'yes']) as $item) {
            $return .= '<url>';
            $return .= "<loc>$protocol$host/blog/$item->slug</loc>";
            $return .= '<lastmod>' . date('Y-m-d', $product->updated_at) . '</lastmod>';
            $return .= '<changefreq>daily</changefreq>';
            $return .= '<priority>0.8</priority>';
            $return .= '</url>';
        }

        $return .= '</urlset>';
        return $return;
    }

    public function actionReview() {

        return $this->render('review', [
            'productReviews' => ProductReview::find()->where(['is_active' => 'yes'])->orderBy('rand()')->all()
        ]);
    }

    public function actionService() {
        $goods = Product::findAll(['is_popular' => 'yes']);
        return $this->render('service', ['model' => Service::findOne(1), 'goods' => $goods]);
    }

    public function actionMaintenance() {
        $goods = Product::findAll(['is_popular' => 'yes']);
        return $this->render('maintenance', ['model' => Maintenance::findOne(1), 'goods' => $goods]);
    }

    public function actionFeedback() {
        if (!$postData = yii::$app->request->post()) {
            throw new HttpException(404 ,'Страница не найдена');
        }

        $modelName = $postData['modelName'];
        $formName = array_reverse(explode('\\', $modelName))[0];
        $formData = $postData[$formName];
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // Спам защита. Если пусто скрытое поле значит форму заполнял не бот
        if(!empty($formData['fullname'])) {
            return ['success' => 'ok'];
        }

        $model = new $modelName();
        if (!$model->load($postData)) {
            throw new HttpException(404 ,'Ошибка загрузки данных формы');
        }

        $formName = Helper::formName($postData);
        $modelFrom = $model->from ?? '';
        $to = $model->to ?? '';

        $name = ArrayHelper::getValue($model, 'name', 'Нет имени');
        $phone = Helper::getDigits(ArrayHelper::getValue($model, 'phone'));
        $email = ArrayHelper::getValue($model, 'email');
        $weight = ArrayHelper::getValue($model, 'weight');
        $volume = ArrayHelper::getValue($model, 'volume');

        $bitrixData = [
            'title' => $formName,
            'name' => $name,
            'status_id' => 'NEW',
            'opened' => 'Y',
            'assigned_by_id' => 18,
            'source_id' => 5,
            'source_description' => $formName,
            'comments' => '',
            'phone' => [
                ['VALUE' => $phone, 'VALUE_TYPE' => 'WORK']
            ],
            'email' => [
                ['VALUE' => $email, 'VALUE_TYPE' => 'WORK'],
            ],
            'from' => $modelFrom, // Пункт отправления (если есть)
            'to' => $to, // Пункт назначения (если есть)
            'weight' => $weight, // Вес (строка) (если есть)
            'volume' => $volume, // Объем (строка) (если есть)
        ];

        (new SendToBitrix())->send($bitrixData);

        if (!method_exists($model, 'save')) {
            return $this->sendEmails($formData, 'feedback');
        }

        if (!$model->save()) {
            return;
        }

        return $this->sendEmails($formData, 'review');
    }

    public function sendEmails($formData, $requestType) {
        if($adminEmail = \Yii::$app->params['adminEmail']) {
            if(self::adminEmail($formData, $requestType)) {
                if(!empty($formData['email']) and self::clientEmail($formData, $requestType)) {
                    $return = ['success' => 'success'];
                } else {
                    $return = ['success' => 'false', 'message' => 'client send error'];
                }
            } else {
                $return = ['success' => 'false', 'message' => 'send to admin error'];
            }
        } else {
            $return = ['success' => 'false', 'message' => 'admin email empty'];
        }

        return $return;
    }

    public static function adminEmail($data, $requestType = 'review') {
        $mailer = Yii::$app->mailer->compose([
            'html' => 'feedback-html',
            'text' => 'feedback-text'
        ], [
            'post' => $data,
            'requestType' => $requestType
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

    public static function clientEmail($data, $requestType = 'review') {
        if (YII_ENV_DEV) {
            return true;
        }

        $mailer = Yii::$app->mailer->compose([
            'html' => 'feedbackClient-html',
            'text' => 'feedbackClient-text'
        ], [
            'post' => $data,
            'requestType' => $requestType
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

    public function instagramPhotos()
    {
        return [];
        if(!stripos(get_headers(yii::$app->params['instagram'])[0], '50')) {
            $pageContent = file_get_contents(yii::$app->params['instagram']);
            $pageContent = explode("window._sharedData", $pageContent)[1];
            $pageContent = explode("</script>", $pageContent);
            $pageContent = substr($pageContent[0], 3);
            $pageContent = rtrim($pageContent, ";");
            $pageContent = json_decode($pageContent);
            return $pageContent->entry_data->ProfilePage[0]->graphql->user->edge_owner_to_timeline_media->edges;
        }
    }

    public function actionPartners() {
        return $this->render('partners', [
            'model' => Page::findOne(['type' => 'partners']),
            'goods' => Product::findAll(['is_popular' => 'yes'])
        ]);
    }


}
