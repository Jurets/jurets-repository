<?php $this->renderPartial('application.views.mail.hello'); ?>

<p style="color: #000; font-size: medium;">
    Ваша заявка подтверждена! Теперь Вы можете:
</p>
<ul>
    <li>редактировать персональные данные</li>
    <li>вводить тренеров</li>
    <li>вводить спортсменов</li>
</ul>

<hr>
<p style="color: #000; font-size: medium;">
    В случае необходимости свяжитесь с организаторами
</p>
<hr>

<?php $this->renderPartial('application.views.mail.regards'); ?>