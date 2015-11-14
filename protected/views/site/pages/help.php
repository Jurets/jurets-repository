<?php
/* @var $this CommandController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('fullnames', 'Help'),
);

//$this->renderPartial('/site/_delegate');
?>

<div class="sideLeft">
    <div class="partnspon">
        <!--<p class="centext colblue1 text14">Організатори:</p>-->
        <a target="_blank" href="http://ftu.com.ua/" title="Федерація тхеквондо України">
            <img width="125" alt="" src="http://ftu.com.ua/wp-content/themes/fru/css/../images/logo.png">
        </a>
    </div>

<!--    <div class="partnspon">
        <a target="_blank" href="" title="Харківська обласна федерація тхеквондо (ВТФ)">
            <img width="125" alt="Харківська обласна федерація тхеквондо (ВТФ)" src="http://test-ftu.dial.com.ua/wp-content/uploads/2014/03/Харьков.png"  title="Харківська обласна федерація тхеквондо (ВТФ)">
        </a>
    </div>-->

    <div class="partnspon">
        <a target="_blank" href="http://armada-kharkov.at.ua/" title="Харківська міська обласна організація Армада">
            <img alt="" src="/images/logo/armada.png" title="Харківська міська обласна організація Армада"><br>
            <p>ХГОО "Армада"</p>
        </a>
    </div>
    
    <div class="partnspon">
        <!--<p class="centext colblue1 text14">Партнери:</p>-->
        <a target="_blank" href="http://www.mti.ua/ru/" title="Група компаній MTI">
            <img width="125"  title="Група компаній MTI" alt="Група MTI" src="/images/logo/MTI_.png">
        </a>
    </div>

    <div class="partnspon">
        <a target="_blank" href="http://utp-daedo.uaprom.net/">
            <img width="125" title="" alt="" src="/images/logo/utp.png">
        </a><br>
    </div>

    <div class="clear"></div>

</div>


<div id="contentText" style="border: 2px solid #A6D9D5 !important; background: none !important;">
    <div id="middle">
             <!--<img src="/images/logo/olimpic_small.jpg" style="float: left; width: 54px;">-->

            <h1 class="centext colblue1 text23" style="text-align: center;line-height: 22px;">
                 Рекомендації по роботі з сайтом
            </h1>
            
            <ul>
                <li>Якщо ви вже реєструвались на цьому сайті, то просто <a href="/site/login">авторизуйтесь у системі</a></li>
                <li>Якщо ви вперше на ньому, пропонуємо <a href="/users/create">зареєструвати</a> свій постійний аккаунт, використовуючи реальний E-mail. 
                   У подальшому можна використовувати аккаунт для подачі заявок на майбутні змагання.
                   E-mail використовується як логін. Пароль або вводиться вручну під час реєстрації, або буде сгенерований автоматично.</li>
                <li>У подальшому пароль можна змінити, використовуючи <a href="/users/mycabinet">Мій кабінет</a>. У кабінет можна ввійти тільки після правильного введеня логіну та паролю</li>
                <li>Також у кабінеті можна змінити свої особисті дані, та <a href="/proposal/create">Подати заявку</a> на змагання. Тільки після того, як заявка буде підтверджена, ви зможете вводити інформацію про учасників</li>
            </ul>
            
            <p class="centext colblue1 text14">Наступні сторінки сайту можна переглядати без реєстрації, що дає змогу отримувати інформацію про змагання будь-якому користувачеві Інтернет</p>
            <ul>
                <li><a href="/command/index">Команди</a> - тут можна подивитися кількісній склад команд - учасниць змагань</li>
                <li><a href="/weightcategory/category">Категорії</a> - кількісній склад учасників за віковими групами та ваговими категоріями. 
                    На цій сторінці (а також на наступній) тренери та представники команд можуть контролювати знаходження свого спортсмена у конкретній категорії, беручи до уваги кількість суперників у ній</li>
                <li><a href="/weightcategory/list">Зважування</a> - повний склад учасників по категоріям, із зазначенням прізвищ спортсменів, найменування команди та іншої інформації.</li>
                <li><a href="/weightcategory/tosser">Жеребкування</a> - сторінка з розпаровками попереднього жеребкування (у форматі PDF) усіх категорій. <strong>Увага!</strong> Ці розпаровки можуть бути не остаточними та можуть змінюватись</li>
                <li><a href="/weightcategory/results">Результати</a> - тут будуть представлені (у форматі PDF) остаточні результати змагань: розпаровки та протоколи зайнятих місць</li>
                <li><a href="/weightcategory/archive">Архів</a> - результати попередніх змагань, проведених за допомогою цього сайту</li>
            </ul>

            <p class="centext colblue1 text14">Корисні ресурси</p>
            <ul id="yw0" class="navigation nav">
                <li>
                    <a class="" href="http://youtu.be/XIaWEN4dvAk" title="Відео-допомога: Реєстрація на сайті" target="_blank" >
                        <i class="icon-facetime-video"></i>&nbsp;Відео-допомога: Реєстрація на сайті
                    </a>
                </li>            
                <li>
                    <a class="" href="http://youtu.be/kvAYbqXYNys" title="Відео-допомога: Додати нового учасника змагань" target="_blank" >
                        <i class="icon-facetime-video"></i>&nbsp;Відео-допомога: Додати нового учасника змагань
                    </a>
                </li>            
            
<!-- <div style="float:left;">


            <div class="right-column">
                        <p class="centext colblue1 text14">Програма змагань:</p>
                        <ul>
                            <strong>П’ятниця – 22 травня:</strong><br>
                            <li>14:00-19:00 – реєстрація учасників</li>
                            <li>17:00-19:00 – зважування учасників на 14 листопада</li>
                            <li>19:00-20:00 – жеребкування та загальні збори представників команд</li>
                            <br>
                            <strong>Субота – 23 травня:<br>
                            Чоловіки: -54, -58, -80, +87<br>
                            Жінки: -49, -53, -57, +73</strong><br>
                            <li>09:00-13:00 – попередні поєдинки</li>
                            <li>13:00-14:00 – обідня перерва</li>
                            <li>14:00-18:00 – попередні поєдинки, півфінали, фінали</li>
                            <li>18:00-19:00 – церемонія нагородження чемпіонів та призерів</li>
                            <br>
                            <strong>Неділя – 24 травня:<br>
                            Чоловіки: -63, -68, -74, -87<br>
                            Жінки: -46, -62, -67 -73</strong><br>
                            <li>09:00-13:00 – попередні поєдинки</li>
                            <li>13:00-14:00 – обідня перерва</li>
                            <li>14:00-18:00 – попередні, півфінали, фінали</li>
                            <li>18:00-19:00 – церемонія нагородження чемпіонів та призерів, закриття змагань</li>
                        </ul>
            </div>
             

            <div class="left-column">
                <p class="centext colblue1 text14">Інформація:</p>
                <ul>
                    <li><a class="button1" target="_blank" href="/document/molod2015_official.pdf">Регламент</a> змагань</li>
                    <li><a class="button1" target="_blank" href="/document/molod2015_official(p).pdf">Регламент підписаний з печаткою</a> змагань</li>
                    <li>вік учасників - 1995-1999 р.н.</li>
                    <li>вагові категорії:<br>
                    <ul>
                    <li>чоловіки:    -54, -58, -63, -68, -74, -80, -87, понад 87 кг</li>
                    <li>жінки:    -46, -49, -53, -57, -62, -67, -73, понад 73 кг</li>
                    </ul>
</li>
                    <li>допуск на змагання – 1 розряд та 1 дан</li>
                    <li>Після закінчення реєстрації можливі зміни у програмі проведення змагань</li>
                    <li>Після офіційного зважування, зміна вагової категорії забороняється</li>
                    <!--<li>змагання проводяться на електронних жилетах DAE DO та систем відео повтору (для кадетів)</li>
                    <li>Кожна команда має надати не менше одного судді</li>
                    <li>Реєстрація закінчується 22 квітня 2015 року</li>
                    <li>Максимальна кількість учасників турніру 900</li>
                </ul>
            <div role="alert" class="alert alert-danger" style="margin-left: 10px; margin-right: 20px; text-align: center;">
                     <strong>Увага!</strong>&nbsp&nbspБлагодійний внесок складає  <strong>---</strong> грн
            </div>
            </div>-->


            <div class="">
                <p class="centext colblue1 text14">Контакти:</p>
                <ul>
                    <li>+38(066)72-3333-1 - Кулик Вадим Юрійович (адміністрація сайта)</li>
                    <!--<li>+38 095 91 777 85,  +38 093 770 77 55 Шапошник Олександр Едуардович</li>
                    <li>(057)731-26-45, (050)447-45-13, <a target="_blank" href="mailto:office@ftu.com.ua">office@ftu.com.ua</a> - офіс <a class="button1" target="_blank" href="http://ftu.com.ua/">ФТУ</a></li>-->
                    <li>+38(068)60-55-923, <a target="_blank" href="mailto:jurets75@gmail.com">jurets75@gmail.com</a> - Гетманський Юрій (технічні питання роботи сайта)</li>
                </ul>
            </div>

            <div class="clear"></div>
    </div>
</div>


<div class="sideRight">

    <div class="partnspon">
        <a target="_blank" href="http://prometey.tkd-card.com.ua">
            <p class="centext colblue1 text14">Прометей-2015</p>
            <img width="" title="регистрация на турнир 'Прометей' (Днепродзержинск)" alt="Прометей-2015" src="http://tkd-card.com.ua/images/tkd_57x60.png">
        </a>
    </div>

    <div class="partnspon">
        <a target="_blank" href="http://palmira.tkd-card.com.ua">
            <p class="centext colblue1 text14">Пальмира-2015</p>
            <img width="" title="регистрация на турнир 'Южная Пальмира' (Одесса)" alt="Пальмира-2015" src="http://tkd-card.com.ua/images/tkd_57x60.png">
        </a>
    </div>

    <div class="partnspon">
        <a target="_blank" href="http://cadet.tkd-card.com.ua">
            <p class="centext colblue1 text14">ЧУ кадеты-2015</p>
            <img width="" title="регистрация на Чемпионат Украины по кадетам (Одесса)" alt="ЧУ кадеты-2015" src="http://tkd-card.com.ua/images/tkd_57x60.png">
        </a>
    </div>

     <div class="clear"></div>
</div>   


