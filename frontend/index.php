<?php
    include_once 'HelperFields.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link
            rel="stylesheet"
            href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
    />
    <style>
        .wrapper{
            max-width: 600px;
        }
        img{
            max-width: 100%;
        }
    </style>
</head>
<body>
    Главная страница
    <img style="max-width: 100px;max-height: 100px" src="<?=  HelperFields::getGeneralData('logo') ?>" alt="">
    <h2>Телефон <?=  HelperFields::getGeneralData('phone') ?></h2>
    <h3>Почта <?=  HelperFields::getGeneralData('email') ?></h3>
    <?php
        $allSliderData = HelperFields::getAllFieldData("main-slider");
//        print_r($allSliderData);
    ?>
    <div class="wrapper">
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ($allSliderData as $slideKey => $slideValue): ?>
                    <div class="swiper-slide">
                        <h3><?= $slideValue['title'] ?></h3>
                        <img src="<?= $slideValue['img'] ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
    </div>
        <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper('.swiper')
            console.log(swiper)
        </script>
</body>
</html>