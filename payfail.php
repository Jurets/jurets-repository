<h1>Ошибка при совершении платежа!</h1>
<?php
//DebugBreak();
    if (!empty($_POST)) {
        //чтото делаем
        //print_r($_POST); ?>
        <table>
            <tbody>
            <?php foreach($_POST as $key=>$value) { ?>
                <tr>
                    <td><?=$key?></td>
                    <td><?=$value?></td>
                </tr>
            <?php } ?>
            <tbody>
        </table>
<?php } ?>
