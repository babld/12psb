
<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
    <channel>
        <title>Стенды ТНВД и Common Rail по низким ценам</title>
        <link>http://12psb.ru</link>
        <description>Топливное оборудование для тестирования ТНВД и Common Rail в наличии и под заказ.</description>
        <?php foreach($products as $product) :?>
            <item>
                <title><?=$product->name?></title>
                <link>http://12psb.ru</link>
                <description><?=strip_tags($product->short_text)?></description>
                <g:image_link>
                    http://12psb.ru/images/store/<?=$product->image->filePath;?>
                </g:image_link>
                <g:price><?=number_format($product->price, 0, '','')?></g:price>
                <g:condition>новый</g:condition>
                <g:id><?=$product->id?></g:id>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>