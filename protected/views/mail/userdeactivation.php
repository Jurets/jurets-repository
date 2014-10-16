<?php $this->renderPartial('application.views.mail.hello'); ?>

<p style="color: #000; font-size: medium;">
    Ваша учётная запись временно деактивирована! На данный момент Вы можете только:
</p>
<ul>
    <li>просматривать свои персональные данные</li>
</ul>

<?php $this->renderPartial('application.views.mail.needmessage'); ?>
<hr>

<?php $this->renderPartial('application.views.mail.regards'); ?>