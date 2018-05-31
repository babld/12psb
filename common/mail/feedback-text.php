Здравствуйте. На вашем сайте <?= \Yii::$app->name ?> была оставлена заявка:\n
<?= !empty($post['name']) ? 'Имя: ' . $post['name'] . '\n': '' ?>
<?= !empty($post['phone']) ? 'Телефон: ' . $post['phone'] . '\n': '' ?>
<?= !empty($post['email']) ? 'Эл. почта: ' . $post['email'] . '\n': '' ?>
<?= !empty($post['message']) ? 'Сообщение: ' . $post['message'] . '\n': '' ?>
\n\n
