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

if (isset($_POST)) {
    print_r($_POST);
}
?>
