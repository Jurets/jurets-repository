<?php
$docpath = Yii::app()->baseUrl.'/document/result/';

$this->breadcrumbs=array(
    Yii::t('fullnames', 'Results'),
);

?>

<style type="text/css">
    table {
        font-size: 12px; 
    }
    .table-half{
        width: 50%;
    }
</style>

<!--<h1><?php echo Yii::t('fullnames', 'Results')?></h1>-->

<!--<p><?php echo Yii::t('fullnames', 'This page will be published results of the championship')?></p>-->

<!--<h2>Сетки</h2>
<a id="all-download" href="<?php echo $docpath.'ukr2014_young_draws_p.pdf'?>" target="_blank" style="color: maroon; ">Юнаки (2002 - 2004 р.н.)</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'ukr2014_senior_draws_p.pdf'?>" target="_blank" style="color: maroon; ">Дорослі (1997 р.н. та старші)</a>
<br><br>

<h2>Результаты</h2>
<a id="all-download" href="<?php echo $docpath.'ukr2014_young_results_p.pdf'?>" target="_blank" style="color: maroon; ">Юнаки (2002 - 2004 р.н.)</a>
<br><br>
<a id="all-download" href="<?php echo $docpath.'ukr2014_senior_results_p.pdf'?>" target="_blank" style="color: maroon; ">Дорослі (1997 р.н. та старші)</a>
<br><br>-->

<h2>Чемпіонат Харківської області 2014</h2>
<div class="table-half" style="float: left;">
    <table class="table table-condensed">
        <tr class="warning">
            <td colspan="2">Молодші юнаки (2005 - 2006 р.н.)</td>
        </tr>
        <tr>
            <td><a target="_blank" href="<?=$docpath?>khoft2014_draws_smyoung(2005-2006).pdf">Розпаровки (сітки)</a></td>
            <td><a target="_blank" href="<?=$docpath?>khoft2014_results_smyoung(2005-2006).pdf">Результати (підсумкові протоколи)</a></td>
        </tr>
    </table>
</div>
<div class="table-half">
    <table class="table table-condensed">
        <tr class="warning">
            <td colspan="2">Юнаки (2002 - 2004 р.н.)</td>
        </tr>
        <tr>
            <td><a target="_blank" href="<?=$docpath?>khoft2014_draws_young(2003-2004).pdf">Розпаровки (сітки)</a></td>
            <td><a target="_blank" href="<?=$docpath?>khoft2014_results_young(2003-2004).pdf">Результати (підсумкові протоколи)</a></td>
        </tr>
    </table>
</div>
<div class="table-half" style="float: left;">
    <table class="table table-condensed">
        <tr class="warning">
            <td colspan="2">Кадети (2000 - 2002 р.н.)</td>
        </tr>
        <tr>
            <td><a target="_blank" href="<?=$docpath?>khoft2014_draws_cadet(2000-2002).pdf">Розпаровки (сітки)</a></td>
            <td><a target="_blank" href="<?=$docpath?>khoft2014_results_cadet(2000-2002).pdf">Результати (підсумкові протоколи)</a></td>
        </tr>
    </table>
</div>
<div class="table-half">
    <table class="table table-condensed">
        <tr class="warning">
            <td colspan="2">Юніори (1997 - 1999 р.н.)</td>
        </tr>
        <tr>
            <td><a target="_blank" href="<?=$docpath?>khoft2014_draws_junior(1997-1999).pdf">Розпаровки (сітки)</a></td>
            <td><a target="_blank" href="<?=$docpath?>khoft2014_results_junior(1997-1999).pdf">Результати (підсумкові протоколи)</a></td>
        </tr>
    </table>
</div>

<h2>Чемпіонат України з тхеквондо (ВТФ) серед дорослих та юнаків 2014</h2>
<div class="table-half" style="float: left;">
    <table class="table table-condensed">
        <tr class="warning">
            <td colspan="2">Юнаки (2002 - 2004 р.н.)</td>
        </tr>
        <tr>
            <td><a target="_blank" href="<?=$docpath?>ukr2014_young_draws_p.pdf">Розпаровки (сітки)</a></td>
            <td><a target="_blank" href="<?=$docpath?>ukr2014_young_results_p.pdf">Результати (підсумкові протоколи)</a></td>
        </tr>
    </table>
</div>

<div class="table-half">
    <table class="table table-condensed">
        <tr class="warning">
            <td colspan="2">Дорослі (1997 р.н. та старші)</td>
        </tr>
        <tr>
            <td><a target="_blank" href="<?=$docpath?>ukr2014_senior_draws_p.pdf">Розпаровки (сітки)</a></td>
            <td><a target="_blank" href="<?=$docpath?>ukr2014_senior_results_p.pdf">Результати (підсумкові протоколи)</a></td>
        </tr>
    </table>
</div>

<h2>4-й Чемпіонат України з пумсе, м Харків, 14-16.11.2014 р.</h2>
<?php $pumse_url = 'http://ftu.com.ua/wp-content/uploads/2014/11/'; ?>
<p class="note"><span class="required">*</span> Дані з сайту <a target="_blank" href="http://ftu.com.ua/">ФТУ</a>, сторінка <a target="_blank" href="http://ftu.com.ua/rezultaty-chempionata-ukrainy-2014-goda-po-pumse/">результатів</a> </p> 
<!--<a target="_blank" href="<?=$pumse_url?>B-24_SF_Results.pdf">Клас Б Дорослі (ж)</a><br>
<a target="_blank" href="<?=$pumse_url?>B-23_DM_Results.pdf">Клас Б Юнаки (ч)</a><br>
<a target="_blank" href="<?=$pumse_url?>Fs-14_T-12_Results.pdf">Клас A Вільні (команди)</a><br>
<a target="_blank" href="<?=$pumse_url?>Fs-13_P-14_Results.pdf">Клас A Вільні (пари до 14 років)</a><br>
<a target="_blank" href="<?=$pumse_url?>Fs-12_M-18_Results.pdf">Клас A Вільні (чоловіки старші 18 років)</a><br>
<a target="_blank" href="<?=$pumse_url?>Fs-10_M-17_Results.pdf">Клас A Вільні (юніори до 17 років)</a><br>
<a target="_blank" href="<?=$pumse_url?>Fs-09_F-17_Results.pdf">Клас A Вільні (юніорки до 17 років)</a><br>
<a target="_blank" href="<?=$pumse_url?>Fs-08_M-14_Results.pdf">Клас A Вільні (кадети до 14 років)</a><br>
<a target="_blank" href="<?=$pumse_url?>Fs-07_F-14_Results.pdf">Клас A Вільні (дівчата до 14 років)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-24_TMF_Results.pdf">Клас A Команди майстрів (ж)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-23_TSM_Results.pdf">Клас A Команди дорослі (ч)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-22_TSF_Results.pdf">Клас A Команди дорослі (ж)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-20_TCM_Results.pdf">Клас A Команди кадетів (ч)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-19_TCF_Results.pdf">Клас A Команди кадетів (ж)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-18_TDM_Results.pdf">Клас A Команди юнаків (ч)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-17_PM-1_Results.pdf">Клас A Пари (майстри)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-16_PS_Results.pdf">Клас A Пари (дорослі)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-15_PJ_Results.pdf">Клас A Пари (юніори)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-14_PC_Results.pdf">Клас A Пари (кадети)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-13_PM_Results.pdf">Клас A Пари (юнаки)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-12_MV_Results.pdf">Клас A Майстри-2 (ч)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-10_MM_Results.pdf">Клас A Майстри (ч)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-09_FM_Results.pdf">Клас A Майстри (ж)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-08_MS_Results.pdf">Клас A Дорослі (ч)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-07_FS_Results.pdf">Клас A Дорослі (ж)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-06_MJ_Results.pdf">Клас A Юніори (ч)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-05_FJ_Results.pdf">Клас A Юніори (ж)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-04_MS_Results.pdf">Клас A Кадети (ч)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-03_FC_Results.pdf">Клас A Кадети (ж)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-00_MM_Results.pdf">Клас A Юнаки (ч)</a><br>
<a target="_blank" href="<?=$pumse_url?>A-00_FM_Results.pdf">Клас A Юнаки (дівчата)</a><br>-->

<!--<div class="table-half"  style="float: left;">-->
<div class="table-half" >
    <table class="table table-condensed table-bordered">
        <tr class="warning">
            <td colspan="2">Клас Б</td>
        </tr>
        <tr>
            <td><a target="_blank" href="<?=$pumse_url?>B-24_SF_Results.pdf">Дорослі (ж)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>B-23_DM_Results.pdf">Юнаки (ч)</a></td>
        </tr>
    </table>
</div>
    <table class="table table-condensed table-bordered">
        <!--<tr class="success">
        <td colspan="2">Клас А</td>
        </tr>-->
        <tr class="warning">
            <td colspan="7">Клас А Вільні</td>
        </tr>
        <tr>
            <td><a target="_blank" href="<?=$pumse_url?>Fs-14_T-12_Results.pdf">команди</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>Fs-13_P-14_Results.pdf">пари до 14 років</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>Fs-12_M-18_Results.pdf">чоловіки старші 18 років</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>Fs-10_M-17_Results.pdf">юніори до 17 років</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>Fs-09_F-17_Results.pdf">юніорки до 17 років</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>Fs-08_M-14_Results.pdf">кадети до 14 років</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>Fs-07_F-14_Results.pdf">дівчата до 14 років</a></td>
        </tr>
    </table>

    <table class="table table-condensed table-bordered">
        <tr class="warning">
            <td colspan="6">Клас A Команди</td>
        </tr>
        <tr>
            <td><a target="_blank" href="<?=$pumse_url?>A-24_TMF_Results.pdf">Команди майстрів (ж)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-23_TSM_Results.pdf">Команди дорослі (ч)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-22_TSF_Results.pdf">Команди дорослі (ж)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-20_TCM_Results.pdf">Команди кадетів (ч)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-19_TCF_Results.pdf">Команди кадетів (ж)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-18_TDM_Results.pdf">Команди юнаків (ч)</a></td>
        </tr>
    </table>
<!--</div>

<div class="table-half">-->
<div class="table-half" >
    <table class="table table-condensed table-bordered">
        <tr class="warning">
            <td colspan="5">Клас A Пари</td>
        </tr>
        <tr>
            <td><a target="_blank" href="<?=$pumse_url?>A-17_PM-1_Results.pdf">Пари (майстри)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-16_PS_Results.pdf">Пари (дорослі)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-15_PJ_Results.pdf">Пари (юніори)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-14_PC_Results.pdf">Пари (кадети)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-13_PM_Results.pdf">Пари (юнаки)</a></td>
        </tr>
    </table>
</div>
    <table class="table table-condensed table-bordered">
        <tr class="warning">
            <td colspan="8">Клас A Індивідуальні</td>
        </tr>
        <tr>
            <td><a target="_blank" href="<?=$pumse_url?>A-08_MS_Results.pdf">Дорослі (ч)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-07_FS_Results.pdf">Дорослі (ж)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-06_MJ_Results.pdf">Юніори (ч)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-05_FJ_Results.pdf">Юніори (ж)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-04_MS_Results.pdf">Кадети (ч)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-03_FC_Results.pdf">Кадети (ж)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-00_MM_Results.pdf">Юнаки (ч)</a></td>
            <td><a target="_blank" href="<?=$pumse_url?>A-00_FM_Results.pdf">Юнаки (дівчата)</a></td>
        </tr>
    </table>
<!--</div>-->
<!--<table class="table table-condensed">
    <tr>
        <td class="info"></td>
        <td class="active">...</td>
        <td class="success">...</td>
        <td class="warning">...</td>
        <td class="danger">...</td>
    </tr>
</table>-->