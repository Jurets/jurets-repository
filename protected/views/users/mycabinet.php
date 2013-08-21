<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    //'Предварительные заявки'=>array('index'),
    //$model->commandname,
    Yii::t('fullnames', 'My Cabinet')
);
?>
<h1>Мой кабинет</h1>

<?php
//if(Yii::app()->user->checkAccess('guest'))

//$proposal = Proposal::model()->findByPk($model->propid);
//$command = Command::model()->find('commandname = :cname', array(':cname'=>$proposal->commandname));
$command = Command::model()->findByPk($model->CommandID);
//if (!$proposal->status) {
switch ($model->RoleID) {
case 'delegate':
    if (!$model->Active) {
        echo CHtml::tag('p', array('class'=>'note'), 'Вы успешно зарегистрировали команду. В течение трёх дней Ваша регистрация будет подтверждена и на указаный Вами E-mail будет выслано письмо с подтверждением и регистрационными данными.<br>Ниже приведены введённые Вами данные:', true);
    } 
    else {
        echo CHtml::tag('p', array('class'=>'note'), '<b>Ваша заявка подтверждена!</b> '.
        'Вы можете выполнять следующие операции:<ul>'.
        '<li>добавлять участников (спортсмены, тренеры)</li>'.
        '<li>удалять и редактировать введенную информацию</li>', true);
    }
}
    
$this->menu=array(
    array('label'=>'Заявки', 'url'=>array('index'), 'visible'=>Yii::app()->user->checkAccess('manager')),
    array('label'=>'Редактировать', 'url'=>array('update', 'id'=>$model->UserID), 'visible'=>Yii::app()->user->checkAccess('manager')),
    array('label'=>'Удалить', 'url'=>'#','visible'=>Yii::app()->user->checkAccess('manager'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->UserID),'confirm'=>'Удалить заявку?')),
    array('label'=>'Ввод заявок', 'url'=>array('/command/view', 'id'=>$command->CommandID), 'visible'=>true),

);
?>

<p><b>Информация о моей учетной записи:</b></p>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        //'commandname',
        'lastname',
        'firstname',
        'country',
        'city',
        'federation',
        'club',
        'post',
        'address',
        'phone',
        'login',
        'Email',
        'www',
        'participantcount',
        'comment',
        'UserID',
    ),
)); 
?>
