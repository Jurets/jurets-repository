<h1>Оплата за работу секретаря</h1>
<p>0.1 USD</p>

<?php //DebugBreak();
    //$num = rand(2, 20);
    $filename = 'saveddata.json';
    if (is_file($filename)) {
        $data = file_get_contents($filename);
        $data = json_decode($data, true);
        $ik_lastpay_num = $data['ik_lastpay_num'];
    } else {
        $ik_lastpay_num = 0;
        $data = array('ik_lastpay_num'=>$ik_lastpay_num);
        $data = json_encode($data);
        file_put_contents($filename, $data);
    }
    $ik_lastpay_num = $ik_lastpay_num + 1;
    //$ik_lastpay_num = 'tc_' . printf("[%04s]\n", $ik_lastpay_num);
    $ik_lastpay_num = 'tc_' . sprintf("%04d", $ik_lastpay_num);
?>

<form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
    <input type="hidden" name="ik_co_id" value="52a86a04bf4efcbb6efd1e6f" />
    <input type="hidden" name="ik_pm_no" value="<?=$ik_lastpay_num?>" />
    <input type="hidden" name="ik_am" value="0.1" />
    <input type="hidden" name="ik_cur" value="USD" />
    <input type="hidden" name="ik_desc" value="оплата работы секретаря" />
    <input type="hidden" name="ik_suc_u" value="http://tkd-card.com.ua/paysuccess.php" />
    <input type="hidden" name="ik_suc_m" value="post" />
    <input type="hidden" name="ik_fal_u" value="http://tkd-card.com.ua/payfail.php" />
    <input type="hidden" name="ik_fal_m" value="post" />
    <!--<input type="hidden" name="ik_pnd_u" value="http://tkd-card.com.ua/paypendinf" />
    <input type="hidden" name="ik_pnd_m" value="post" />-->
    <input type="hidden" name="ik_exp" value="2013-12-15" />
    <input type="hidden" name="ik_loc" value="ru" />
    <input type="hidden" name="ik_enc" value="utf-8" />
    <input type="submit" value="Оплатить">
</form>