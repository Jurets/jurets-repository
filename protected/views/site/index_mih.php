<?php
/* @var $this SiteController */

//Yii::app()->getClientScript()->registerScriptFile('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');
//Yii::app()->getClientScript()->registerScript('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');

$this->pageTitle=Yii::app()->name;
$imgpath = Yii::app()->baseUrl.'/images/logo/';
$docpath = Yii::app()->baseUrl.'/document/';
?>


<div class="sideLeft">
            <div class="partnspon">
                <h3>Партнери:</h3>
                <a target="_blank" href="http://www.mti.ua/ru/">
                    <img width="103" height="44" title="" alt="" src="<?php echo $imgpath?>MTI_.png">
                </a><br>
                <div class="t12">Група компаній MTI</div>
            </div>
            <div class="partnspon">
                <a href="http://utp-daedo.uaprom.net/">
                    <img width="82" height="75" title="" alt="" src="<?php echo $imgpath?>utp.png">
                </a><br>
            </div>
            <div class="partnspon">
                <h3>Підтримка:</h3>
                <a target="_blank" href="http://gusms.kharkivoda.gov.ua/">
                    <img width="100" title="" alt="" src="<?php echo $imgpath?>ODA.png">
                </a><br>
            </div>
        </div><!-- .sidebar#sideLeft -->

        <div class="sideRight">
            <div class="partnspon">
                <h3>Партнери:</h3>
                <a target="_blank" href="#">
                    <img width="124" height="91" title="" alt="" src="<?php echo $imgpath?>armada.png">
                </a>
            </div>
            <div class="partnspon">
                <a target="_blank" href="http://ftu.com.ua/contact">
                    <img width="124" height="" title="" alt="" src="<?php echo $imgpath?>kharkov.png">
                </a>
            </div>
            <div class="partnspon">
                <a target="_blank" href="http://poltavawtf.blogspot.com/">
                    <img width="124" height="126" title="" alt="" src="<?php echo $imgpath?>poltava.png">
                </a>
            </div>
        </div><!-- .sidebar#sideRight -->


<div id="contentText">
       <div id="middle">
                    <p style="text-align: center;">Добро пожаловать на</p>
                    <h1 class="centext colblue1 text23 uptext" style="text-align: center;">
                        Открытый портал проведения соревнований<br>Федерации тхеквондо(ВТФ) Украины
                    </h1>
                    
                    <p class="centext colblue1 text14">С помощью данного портала будет возможено удаленный ввод заявок на различные соревнования,
                    проводимые под руководством Федерации тхеквондо(ВТФ) Украины</p>
                    
                    <p class="centext colblue1 text14">Для открытия нового соревнования необходимо обратиться к организаторам сайта. После этого Вам будет выдан логин и пароль как администратора соревнования</p>

                    <p class="centext colblue1 text14">
                        Попередні заявки на участь у змаганнях із зазначенням кількісного складу команди необхідно подавати на цьому сайті 
                        (для цього потрібно перейти до пункту <strong>Реєстрація</strong>)
                        <br>або висилати електронною поштою на e-mail: jurets75@rambler.ru
                    </p>
                   
                    <p class="centext colblue1 text14">
                        <br> Над даний момент інформацію про <strong>Чемпіонат ДЮСШ Металіст 2013</strong> можна дивитися на 
                        <a target="_blank" href="http://metallist2013.pp.ua/index.php">сторінці чемпіонату</a>
                    </p>

                    <p class="centext colblue1 text14">
                        Календар змагань на сайті ФТУ:
                        <a class="button1" target="_blank" href="http://www.ftu.com.ua/calendar">Дивитись</a> <br>
                        Правила змагань, які діють на даний момент:
                        <a class="button1" href="<?php echo $docpath.'ftu_rules2013.doc'?>">Завантажити</a>
                    </p>
      </div>
</div>

