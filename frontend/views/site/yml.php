<?php
use pistol88\shop\models\Category;
?>
<yml_catalog date="<?= date('Y-m-d h:i') ?>">
    <shop>
		<name>12PSB.RU</name>
		<company>12PSB.RU</company>
		<url>http://12psb.ru</url>
		<currencies>
			<currency id="RUB" rate="1"/>
		</currencies>
		<categories>
			<category id="1">Оборудование для автосервисов</category>
			<category id="2" parentId="1">Оборудование ТНВД и Common Rail</category>
		</categories>
		<offers>		
			<?php foreach($products as $product) :?>
                <?php
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
				<offer id='<?=$product->id?>'>
					<url>http://12psb.ru<?= $detailUrl ?></url>
					<name><?=$product->name?></name>
					<model><?=$product->name?></model>
					<price><?=number_format($product->price, 0, '','')?></price>
					<currencyId>RUB</currencyId>
					<local_delivery_cost>0</local_delivery_cost>
					<categoryId>2</categoryId>
					<vendor>12PSB.RU</vendor>
					<vendorCode>12PSB.RU</vendorCode>					
					<param name="Артикул"><?=$product->code?></param>
					<description><?=html_entity_decode(strip_tags($product->short_text))?></description>
					<?php foreach($product->getImages() as $image) : ?>
                    <picture>
					    http://12psb.ru/images/store/<?= $image->filePath ?>
                    </picture>
                    <?php endforeach; ?>
				</offer>
			<?php endforeach; ?>
		</offers>
	</shop>
</yml_catalog>