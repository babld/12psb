<div class="overlay content metal-bg cleafrix">
    <h1>Интересует покупка стенда <?=$name?>?</h1>
    <div class="border-emul fl-l">
        <div class="overlay__manager">
            <div class="corp-col">Директор</div>
            <div>Балабанов Дмитрий Викторович</div>
            <img src="/i/manager.png" class=""/>
        </div>
    </div>
    <form class="overlay__form send">
        <div class="border-emul mb-10">
            <input type="text" name="name" placeholder="Ваше имя" />
        </div>
        <div class="border-emul mb-10">
            <input type="text" name="phone" placeholder="Ваш телефон" />
        </div>
        <div class="border-emul mb-10">
            <input type="text" name="email" placeholder="Ваша эл. почта" />
        </div>
        <div class="border-emul mb-10">
            <textarea class="overlay-ta" placeholder="Комментарий"></textarea>
        </div>
        <div class="border-emul clearfix">
            <input name="submit" type="submit" value="Связаться со мной" class="but-default"/>
        </div>
    </form>
    <script>

        $("form.overlay__form").staFeedback();

    </script>
    <div class="clear"></div>
</div>