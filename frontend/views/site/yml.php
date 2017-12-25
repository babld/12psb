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
				<offer id='<?=$product->id?>'>
					<url>http://12psb.ru</url>
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
					<picture>
					<?php foreach($product->getImages() as $image) : ?>
					http://12psb.ru/images/store/<?= $image->filePath ?>
                    <?php endforeach; ?>
					</picture>
				</offer>
			<?php endforeach; ?>
		</offers>
	</shop>
</yml_catalog>