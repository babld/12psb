<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Каталог', 'url'=>['/shop/product/index']],
                    ['label' => 'Категории', 'url'=>['/shop/category/index']],
                    ['label' => 'Пользователи', 'url'=>['/user/admin/index'],],
                    ['label' => 'Email tracking', 'url'=>['/email-tracking'],],
                    ['label' => 'Отзывы', 'url'=>['/product-review']],
                    ['label' => 'Сервис', 'url'=>['/service']],
                    ['label' => 'Гарантии', 'url'=>['/maintenance']],
                    ['label' => 'Видео', 'url'=>['/video'], 'icon' => 'youtube']
                ],
            ]
        ) ?>

    </section>

</aside>
