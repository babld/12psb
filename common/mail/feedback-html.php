<h1>Здравствуйте. На вашем сайте <?= \Yii::$app->name ?> был оставлен отзыв:</h1>
<?= !empty($post['name']) ? '<p>Имя: ' . $post['name'] . '</p>': '' ?>
<?= !empty($post['phone']) ? '<p>Телефон: ' . $post['phone'] . '</p>': '' ?>
<?= !empty($post['email']) ? '<p>Эл. почта: ' . $post['email'] . '</p>': '' ?>
<?= !empty($post['message']) ? '<p>Сообщение: ' . $post['message'] . '</p>': '' ?>
