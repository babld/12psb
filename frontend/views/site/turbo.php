<?php
use yii\helpers\HtmlPurifier;
use pistol88\shop\models\Category;

/**
 * @var \pistol88\shop\models\Product[] $products
 */
?>
<rss
    xmlns:yandex="http://news.yandex.ru"
    xmlns:media="http://search.yahoo.com/mrss/"
    xmlns:turbo="http://turbo.yandex.ru"
    version="2.0">
    <channel>
        <title>Оборудование для ремонта ТНВД и форсунок купить в Новосибирске</title>
        <link>https://12psb.ru</link>
        <description>Продажа оборудования для ремонта и регулировки топливной аппаратуры в Новосибирске. Низкие цены на стенды для ТНВД и форсунок. Доставка по всей России ☎️ 8-800-775-6758</description>
        <?php foreach($products as $item) :?>
            <?php foreach ($item['product'] as $product):
                $tmpUrl = '';

                if(Category::findOne(['id' => Category::findOne(['id' => $product->category->parent_id])->parent_id])) {
                    $tmpUrl = Category::findOne(['id' => Category::findOne(['id' => $product->category->parent_id])->parent_id])->slug . '/';
                }

                $detailUrl = '/' .
                    $tmpUrl .
                    Category::findOne(['id' => $product->category->parent_id])->slug . '/' .
                    $product->category->slug . '/' .
                    $product->slug;
                ?>
                <item turbo="true">
                    <link>//12psb.ru/<?= $detailUrl ?></link>
                    <category>Каталог</category>
                    <pubDate><?= date('r')?></pubDate>
                    <turbo:content>
                        <![CDATA[
                        <header>
                            <h1><?= $product->name ?></h1>
                        </header>
                        <?= HtmlPurifier::process($product->text, [
                            'HTML.ForbiddenAttributes' => ['style', 'class', 'align', 'title', 'alt'],
                            'HTML.ForbiddenElements' => ['<!--', '-->']
                        ]) ?>
                        ]]>
                    </turbo:content>
                </item>
            <?php endforeach ?>
        <?php endforeach?>
    </channel>
</rss>
