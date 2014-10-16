<?php $this->renderPartial('application.views.mail.hello'); ?>

<p style="color: #000; font-size: medium;">
    Ваша учётная запись активирована! Теперь Вы можете:
</p>
<ul>
    <li>редактировать персональные данные</li>
    <li>подать заявку на соревнование</li>
</ul>

<?php $this->renderPartial('application.views.mail.needmessage'); ?>
<hr>

<?php $this->renderPartial('application.views.mail.regards'); ?>