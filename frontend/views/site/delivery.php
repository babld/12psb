<?php
use yii\widgets\Breadcrumbs;
$title = "Доставка и оплата";
$this->params['breadcrumbs'][] = $title;
$this->title = $title;
$this->registerMetaTag(['description' => "Условия доставки и оплаты оборудования для тестирования ТНВД и Common Rail"]);
$this->registerMetaTag(['og:title' => $title]);
?>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
</div>
<div class="container content article">
    <h1>Заказ, доставка и оплата</h1>

    <h2>Заказ оборудования</h2>
    <h3>Заказ топливного оборудования у производителя</h3>
    <ol>
        <li>Для формирования заказа достаточно выбрать заинтересовавшую вас модель топливного оборудования и оставить
            запрос на почту или позвонить на указанный номер телефона (бесплатно по всей России)</li>
        <li>В течение одного рабочего дня, с вами свяжется специалист Компании для согласования заказа и сроков его
            выполнения.</li>
    </ol>
    <p>Ориентировочный срок выполнения одного заказа от производителя и доставки до склада клиента:
        <strong>24-30 дней</strong>.
    </p>
    <h3>Заказ оборудования с нашего склада</h3>
    <p>При заказе оборудования, имеющегося в наличии, следует указать его наименование. Менеджер свяжется с Вами,
        согласует условия оплаты и доставки. После получения оплаты оборудование будет отправлено в ваш город.
    </p>
    <h2>Условия оплаты</h2>
    <p>Оплата выставленного счета или договора на поставку осуществляется банковским переводом с расчетного счета
        Вашей компании. Для выставления счета и договора на поставку оборудования необходимы данные Вашей организации:
    </p>
    <p>Наименование организации, ИНН, КПП, юридический и фактический адрес, расчетный и корреспондентский счет, БИК
        банка, контактные телефоны.</p>
    <h2>Информация по доставке товара</h2>
    <h3>Доставка в регионы РФ транспортными компаниями</h3>
    <p>Доставка топливного оборудования производится в любой город России с помощью услуг, предоставляемых
        транспортно-экспедиционных компаний. Свяжитесь с нами, и мы предложим Вам наиболее выгодный по сроку
        доставке и стоимости вариант для доставки до вашего города. Вы также всегда можете выбрать самостоятельно
        транспортную компанию, которая привезет вам оборудование. До терминала транспортной компании мы доставим ваш
        заказ бесплатно!
    </p>
    <p>
        <strong>Обратите внимание!</strong>
        Мы отправляем оборудование в другие города только после поступления 100% оплаты!
    </p>
    <p>После получения оплаты менеджер свяжется с Вами и согласует отправку оборудования с вами. После передачи
        оборудования транспортной компании, менеджер вышлет Вам уникальный номер накладной, по которому вы сможете
        отслеживать отправление на сайте ТК.</p>
    <p>Стоимость перевозки должна быть оплачена транспортной компании в момент получения вашего оборудования. В
        некоторых случаях стоимость доставки может оплачиваться нашей компанией: следите за акциями на сайте! Также
        компенсация стоимости доставки возможна при заказе 3 и более единиц топливного оборудования. В этом случае
        компенсацию необходимо согласовать и обсудить с менеджером.
    </p>
    <p>Оплата за перевозку должна быть выплачена вами в момент получения заказа. Иногда стоимость доставки может быть
        включена в стоимость продукции, но такие моменты обговариваются с менеджером в индивидуальном порядке.
    </p>
    <p>При перевозке грузов транспортными компаниями крайне желательно страховать ваше оборудование. Мы не несем
        ответственность за повреждение оборудование при их перевозке транспортными компаниями.
    </p>
    <h3>Получение топливного оборудования на вашем складе</h3>
    <p>Для того чтобы получить товар, вам необходимо предъявить документы удостоверяющие личность или доверенность.</p>
    <p>Внимательно изучите комплектацию получаемого оборудования, убедитесь в отсутствии на изделии дефектов.</p>
    <p>Сотрудник, доставивший вам оборудование, должен выбать товарный чек при наличном расчете за доставку. При
        безналичном расчете вы должны получить все сопутствующие документы с заполненными данными, печатями и
        подписями..
    </p>
    <p>Вы имеете право предъявить претензии к получаемому товару по статье 458 и 459 ГК РФ, но только до подписания
        акта приемки-передачи. Внимательно проверяйте ваше оборудование до подписания акта, т.к. в случае наличия
        повреждений, отсутствия части комплекта претензии приниматься не будут.
    </p>
    <p>Для того, чтобы получить более подробную информацию о заказе топливного оборудования, условиях оплаты,
        доставке и получении товара на вашем складе, свяжитесь с нами с помощью формы обратной связи, по телефонам или
        электронной почте.
    </p>
</div>