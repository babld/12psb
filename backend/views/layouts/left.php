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
                    [
                        'label'=> 'Справочники',
                        'url' => '#',
                        'icon' => 'list',
                        'items'=>[

                            #['label'=>'Промокоды', 'url'=>['/promocode/promo-code/index']],

                        ]
                    ],
                    ['label'=>'Витрина', 'url'=>['/shop/product/index']],
                    ['label'=>'Пользователи', 'url'=>['/user/admin/index'],],
                    ['label' => 'Клиенты', 'url' => ['/client/client/index']],
                    ['label'=>'Email tracking', 'url'=>['/email-tracking'],]
                    /*[
                        'label'=> 'Поля',
                        'icon' => 'cog',
                        'url' => '#',
                        'items'=>[
                            #['label' => 'Фильтры', 'url'=>['/filter/filter']],
                            #['label' => 'Поля магазина', 'url'=>['/field/field']],
                            #['label' => 'Поля заказа', 'url' => ['/order/field/index']],
                        ]
                    ],*/
                ],
            ]
        ) ?>

    </section>

</aside>
