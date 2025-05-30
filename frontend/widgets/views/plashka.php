<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<style>
    #plashka {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #1E242E;
        padding: 10px;
        text-align: center;
        display: none; 
        z-index: 999;
    }
    .plashka-all {
        display: flex;
        margin-left: 320.5px;
        padding-top: 13.5px;
        height: 64px;
        width: 100%;
    }
    .plashka-text {
        font-family: Open Sans;
        font-size: 16px;
        font-weight: 400;
        line-height: 21.79px;
        text-align: center;
        color: #FFFFFF;
        width: 1112px;
        margin-right: 70px;
    }
    .plashka-text a {
        color: #ff6624;
        text-decoration: none; 
        cursor: pointer;
    }

    .plashka-text a:hover {
        color: #ff9263;
    }
    #closeplashka {
        background-color: #FFFFFF; 
        color: #4A5A72; 
        border: 1px solid #4A5A72; 
        text-align: center; 
        text-decoration: none;
        display: inline-block; 
        font-family: Open Sans;
        font-size: 14px;
        font-weight: 600;
        line-height: 19.07px;
        cursor: pointer; 
        border-radius: 30px; 
        width: 97px;
        height: 47px;
    }

    #closeplashka:hover {
        border: 1px solid #3B485B;
        color: #3B485B;
    }
    @media (max-width: 1700px) {
        .plashka-all {
            margin-left: 215px;
        }
    }
    @media (max-width: 1510px) {
        .plashka-all {
            margin-left: 153px;
        }
    }
      @media (max-width: 1510px) {
        .plashka-all {
            margin-left: 153px;
        }
    }
    @media (max-width: 1510px) {
        .plashka-all {
            margin-left: 65px;
        }
    }
    @media (max-width: 1400px) {
        .plashka-text { 
            margin-right: 35px;
        }
    }
    @media (max-width: 1330px) {
        .plashka-all {
            margin-left: 25px;
        }
        .plashka-text { 
            margin-right: 10px;
        }
    }
    @media (max-width: 1220px) {
        .plashka-all {
            margin-left: 18px;
        }
        .plashka-text { 
            margin-right: 10px;
        }
        .plashka-text {
            width: 650px;
        }
    }
    @media (max-width: 900px) {
        .plashka-text {
            width: 600px;
            font-size: 13px;
        }
    }
    @media (max-width: 750px) {
        .plashka-text {
            width: 560px;
        }
        .plashka-all {
            padding-top: 0px;
        }
    }
    @media (max-width: 560px) {
        #closeplashka {
            margin-top: 10px;
        }
    }
    @media (max-width: 530px) {
        .plashka-all {
            height: 115px;
        }
        .plashka-text{ 
            width: 370px;
        }
    }
    @media (max-width: 450px) {
        .plashka-text{ 
            font-size: 13px;
            font-weight: 300;
            line-height: 20px;
            text-align: left;
            width: 245px;
            margin-top: 10px;
        }
        #plashka {
            padding-top: 5px;
            padding-right: 0px;
        }
        #closeplashka {
            margin-top: 30px;
        }
        .plashka-all {
            margin-left: 16px;
        }
    }
    @media (max-width: 380px) {
        .plashka-text{
            margin-right: 0px;
            width: 212px;
        }
    }
    @media (max-width: 361px) {

    }
</style>

<div id="plashka">
    <div class="plashka-all">
        <div class="plashka-text">
            Мы используем файлы cookie для вашего удобства пользования сайтом. Оставаясь на сайте, вы соглашаетесь с 
            <a href="https://12psb.ru/doc/politic.pdf" target="_blank">
                условиями использования файлов cookies.
            </a>
        </div>
        <button id="closeplashka">Хорошо</button>
    </div>
</div>

<script>
    function showplashka() {
        document.getElementById('plashka').style.display = 'block';
    }

    const lastClosed = localStorage.getItem('plashkaClosed');
    const now = new Date().getTime();
    const oneHour = 60 * 60 * 1000;

    if (!lastClosed || (now - lastClosed > oneHour)) {
        showplashka();
    }

    document.getElementById('closeplashka').onclick = function() {
        document.getElementById('plashka').style.display = 'none';
        localStorage.setItem('plashkaClosed', now);
    };
</script>