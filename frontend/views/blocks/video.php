<div class="video gradient-bg">
    <div class="container">
        <h3>Видео по работе стендов</h3>
        <div class="video-owl-carousel owl-carousel owl-theme">
            <?php foreach($videos as $video): ?>
                <div class="video__item fa">
                    <a class="video__item-link" href="<?= $video->url ?>">
                        <img
                            itemprop="contentUrl"
                            src="https://img.youtube.com/vi/<?= explode('watch?v=', $video->url)[1] ?>/maxresdefault.jpg"
                        />
                        <div class="video__item-title"><?= $video->title ?></div>
                    </a>

                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>