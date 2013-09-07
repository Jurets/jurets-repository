<?php
/* @var $this SiteController */

//Yii::app()->getClientScript()->registerScriptFile('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');
//Yii::app()->getClientScript()->registerScript('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');

//Yii::app()->getClientScript()->registerCssFile('title.css');

$this->pageTitle=Yii::app()->name;
$imgpath = Yii::app()->baseUrl.'/images/logo/';
$docpath = Yii::app()->baseUrl.'/document/';
?>

<?php 
//DebugBreak();
$notCached = $this->beginCache('tkdcard_mainpage', array('duration'=>90));
if($notCached) 
{ 
    $competition = Competition::loadModel();    
    ?>


        <div class="sideLeft">
            <div class="partnspon">
                <h3>СПОНСОРИ:</h3>
                <a target="_blank" href="http://www.bubnovsky.com.ua//">
                    <img width="85" height="86" title="" alt="" src="<?php echo $imgpath?>bubnovsky.png"> 
                    <!--<div class="t12">Медицинский центр доктора Бубновского</div>-->
                    <!--<div class="t28">Бубновского</div>-->
                </a><br>
                <div class="t12">Медичний центр доктора Бубновського</div>
            </div>
            <div class="partnspon">
                <!--<a target="_blank" href="http://www.peyvoda.com.ua/">
                    <img width="120" title="" alt="" src="<?php echo $imgpath?>peyvoda.jpg">
                </a><br>-->
                <img width="120" title="" alt="" src="<?php echo $imgpath?>vybor.jpg">
            </div>

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
                <!--<div class="t12">Компанія Ukraine Taekwondo Promotion</div>-->
            </div>
            <div class="partnspon">
                <!--<a target="_blank" href="mailto:poltavatkd@yandex.ru">-->
                <a target="_blank" href="http://poltavawtf.blogspot.com/">
                    <img width="124" height="126" title="" alt="" src="<?php echo $imgpath?>poltava.png">
                </a>  <!--<br>-->
            </div>
        </div><!-- .sidebar#sideLeft -->

        <div class="sideRight">
            <div class="partnspon">
                <h3>Організатори:</h3>
                <a target="_blank" href="#">
                    <img width="124" height="91" title="" alt="" src="<?php echo $imgpath?>armada.png">
                </a><br>
            </div>
            <div class="partnspon">
                <a target="_blank" href="http://ftu.com.ua/contact">
                    <img width="124" height="" title="" alt="" src="<?php echo $imgpath?>kharkov.png">
                </a> <!--<br>-->
            </div>
            <div class="partnspon">
                <a target="_blank" href="http://gusms.kharkivoda.gov.ua/">
                    <img width="100" title="" alt="" src="<?php echo $imgpath?>sk_kwon.jpg">
                </a>
            </div>
            <div class="partnspon">
                <h3>Керівництво:</h3>
                <a target="_blank" href="http://ftu.com.ua/">
                    <img width="88" height="116" title="" alt="" src="<?php echo $imgpath?>ftu.png">
                </a><br>
            </div>
            <div class="partnspon">
                <h3>Підтримка:</h3>
                <a target="_blank" href="http://gusms.kharkivoda.gov.ua/">
                    <img width="100" title="" alt="" src="<?php echo $imgpath?>ODA.png">
                </a>  <!--<br>-->
                <!--<div class="t12">Департамент у справах сім’ї, молоді та спорту Харківської облдержадміністрації</div>-->
            </div>
        </div><!-- .sidebar#sideRight -->


     <div id="contentText">
       <div id="middle">
                    <p style="text-align: center;">Запрошуємо на</p>
                    <h1 class="centext colblue1 text23" style="text-align: center;">
                        <?php echo CHtml::encode($competition->title /*Competition::getCompetitionParam('title')*/); ?>
                    </h1>
                    <h1 class="text17" style="text-align: center;"><?php echo $competition->title /*CHtml::encode(Competition::getCompetitionParam('addinfo'))*/; ?></h1>
                    
                    <p class="centext colblue1 text14">Безпосередня організація змагань здійснюється <br>КЗ «КДЮСШ «Металіст» ХОР» та ХГО «Армада» <br>
                    Загальне керівництво змаганням здійснюється федерацією тхеквондо (ВТФ) України <br>за підтримки 
                    Департаменту у справах сім’ї, молоді та спорту Харківської облдержадміністрації,
                    Південної залізниці та <br>Управління МВС України на Південній залізниці</p>
                    
                    <p style="text-align: center;"> Змагання проводяться згідно правил тхеквондо (ВТФ) на електронній системі DaeDo</p>
                    <p class="text15 uptext" style="text-align: center;">Запрошуємо усіх бажаючих! Вхід до трибун безкоштовний! </p>
                    
                    <h2 class="text17" style="text-align: center;">ЧАС ПРОВЕДЕННЯ<br><!--</h2>
                    <h2 class="text17" style="text-align: center;">-->
                        <?php 
                            $date1 = $competition->begindate;
                            $date2 = $competition->enddate;
                            $date1 = Yii::app()->dateToUkr($date1/*, '%DAYWEEK%, j %MONTH% Y, G:i'*/);
                            $date2 = Yii::app()->dateToUkr($date2);
                            echo CHtml::encode($date1).' - '.CHtml::encode($date2);
                        ?>
                    </h2>

                    <h2 class="text17" style="text-align: center;">МІСЦЕ ПРОВЕДЕННЯ<br>
                        <?php echo CHtml::encode($competition->place); ?>
                    </h2>
                    <!--<p style="text-align: center;"><a target="_blank" href="<?php echo Yii::app()->createUrl('/site/pages/map.html') ?>">Дивитись схему проїзду</a></p>-->
                    <p style="text-align: center;"><a target="_blank" href="<?php echo Yii::app()->baseUrl.'/map.html' ?>">Дивитись схему проїзду</a></p>
                    
                    <!--(для цього потрібно перейти до пункту <?php echo CHtml::link('Реєстрація', Yii::app()->createUrl('/users/create'), array('class'=>'search-button')); ?>)-->
                    <p class="centext colblue1 text14">
                        Попередні заявки на участь у змаганнях із зазначенням кількісного складу команди необхідно подавати
                        <br>до <strong>
                            <?php 
                                $date1 = $competition->filingbegin;
                                $date2 = $competition->filingend;
                                $date2 = Yii::app()->dateToUkr($date2);
                                echo CHtml::encode($date2); 
                            ?>
                        </strong>
                        <br>на цьому сайті або висилати електронною поштою на e-mail: jurets75@rambler.ru, vadosrbd@rambler.ru 
                        <br>
                        <?php if (Yii::app()->user->isGuest) { ?>
                            <br>Якщо Ви не ще зареєстровані на нашому сайті - пропонуємо це зробити (для цього виберіть відповідний пункт меню вгорі)
                            <br>Якщо зареєстровані - Ви можете увійти за допомогою відповідного пункту меню 
                        <?php } ?>
                        <br>
                        <!--або за адресою: м. Харків вул. Плеханівська 65, (в електронному вигляді в програмі Microsoft Office Excel), <br>зразок електронної заявки можна отримати за вище вказаними адресами <br>-->
                    </p>
                   
                    <p class="centext colblue1 text14" style="color: red;">
                        <strong>УВАГА!</strong><br> Благодійні стартові внески за учасників змагань, які пройшли мандатну комісію та зважування, <strong>НЕ ПОВЕРТАЮТЬСЯ</strong>
                    </p>
                    
                    <p class="centext colblue1 text14">
                        <!--<br> Над даний момент введення заявок на чемпіонат <strong>ПРИПИНЕНО</strong>!--> 
                        Для вирішення питань повязаних з мандатною комісію та жеребкуванням, звертайтесь 
                        до організаторів змагань; протоколи жеребкування можна завантажити у розділі 
                        <?php echo CHtml::link('Жеребкування', Yii::app()->createUrl('/weightcategory/tosser'), array('class'=>'search-button')); ?>
                    </p>

                    <p class="centext colblue1 text14">
                        Регламент змагань на сайті ФТУ:
                        <a class="button1" target="_blank" href="http://www.ftu.com.ua/news/908">Дивитись</a> <br>
                        Завантажити положення: 
                        <!--<a class="button1" href="<?php echo $docpath.'KubMetalist-2013apr(rus).doc'?>">Положение(рус)</a>-->
                        <a class="button1" href="<?php echo $docpath.'KubArmada-2013stp(ukr).doc'?>">Положення(укр)</a>
                    </p>
      </div>
</div>

<?php 
$this->endCache(); 
} ?>