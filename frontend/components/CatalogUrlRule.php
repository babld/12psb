<?php
namespace app\components;

use yii\web\UrlRuleInterface;
use yii\base\Object;
use pistol88\shop\models\Category;
use pistol88\shop\models\Product;

class CatalogUrlRule extends Object implements UrlRuleInterface
{

    public function createUrl($manager, $route, $params)
    {
        #echo "<pre>"; var_dump($params, $route, $manager); exit;
        /*if ($route === 'catalog/index') {
            return $params['catalog'] . '?page=' . $params['page'];
        }*/
        return false;  // данное правило не применимо
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        if (preg_match('%^([\w-\/])+$%', $pathInfo, $matches) and Category::findOne([
            'slug' => array_reverse(explode('/', $matches[0]))[0]])
        ) {
            return ['site/catalog', ['catalog' => $matches[0]]];
        } elseif(preg_match('%^([\w-\/])+$%', $pathInfo, $matches) and Product::findOne([
            'slug' => array_reverse(explode('/', $matches[0]))[0]
         ])) {
            return ['site/catalog', ['catalog' => $matches[0]]];
        }
        return false;  // данное правило не применимо
    }
}
?>