<?php $this->renderPartial('application.views.mail.hello'); ?>

<p style="color: #000; font-size: medium;">
    Для Вас автоматически сгенерирован новый пароль<br>
    Ваши Регистрационные данные:<br>
</p>
<hr>
<p style="color: #000; font-size: medium;">
    Логин: <?=$user->UserName?><br>
    Пароль: <?=$user->new_password?>
</p>
<hr>
<p style="color: #000; font-size: medium;">
    Проверьте ещё раз эти данные, и в случае необходимости свяжитесь с организаторами.
    Вы можете авторизоваться на сайте, используя логин и пароль, указанные выше.
    После авторизации вы сможете сменить пароль в Кабинете.
</p>

<?php $this->renderPartial('application.views.mail.regards'); ?>