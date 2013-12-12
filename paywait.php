<h1>Ожидание платежа</h1>
<?php
//DebugBreak();
    $filename = 'saveddata.json';
    if (is_file($filename)) {
        $data = file_get_contents($filename);
        $data = json_decode($data, true);
        $ik_lastpay_num = $data['ik_lastpay_num'];
    } else {
        $ik_lastpay_num = 0;
        
    }
    $ik_lastpay_num = $ik_lastpay_num + 1;
    $data = array('ik_lastpay_num'=>$ik_lastpay_num);
    $data = json_encode($data);
    file_put_contents($filename, $data);

    if (!empty($_POST)) {
        //чтото делаем
        //print_r($_POST); ?>
        <table>
            <tbody>
            <?php 
            foreach($_POST as $key=>$value) { 
                if ($key != 'ik_co_id') { ?>
                <tr>
                    <td><?=$key?></td>
                    <td><?=$value?></td>
                </tr>
            <?php } } ?>
            <tbody>
        </table>
<?php } ?>
