<?php $this->renderPartial('application.views.mail.hello'); ?>

<p style="color: #000; font-size: medium;">
    Ваши Регистрационные данные были изменены:<br>
</p>
<hr>
<p style="color: #000; font-size: medium;">
    Фамилия: <?=$user->lastname?><br>
    Имя: <?=$user->firstname?>
</p>
<hr>
<p style="color: #000; font-size: medium;">
    Проверьте ещё раз эти данные, и в случае необходимости свяжитесь с организаторами
</p>

<?php $this->renderPartial('application.views.mail.regards'); ?>