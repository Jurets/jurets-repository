<?php
/**
 * This is the model class for table "judge_proposal".
 *
 * The followings are the available columns in table 'judge_proposal':
 * @property integer $id
 * @property integer $competitionid
 * @property integer $judgeid
 * @property integer $commandid
 * @property string $comment
 * @property integer $status
 * @property string $created

 *
 * The followings are the available model relations:
 * @property Command $command
 * @property Competition $competition
 * @property Judge $judge
 */
class JudgeProposal extends ProposalBase
{
    // возможные статусы
    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = -1;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return JudgeProposal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'judge_proposal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('competitionid, judgeid', 'required'),
			array('competitionid, judgeid, commandid', 'numerical', 'integerOnly'=>true),
			array('comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('competitionid, judgeid, commandid, comment', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'command' => array(self::BELONGS_TO, 'Command', 'commandid'),
			'competition' => array(self::BELONGS_TO, 'Competition', 'competitionid'),
			'judge' => array(self::BELONGS_TO, 'Judge', 'judgeid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return CMap::mergeArray(parent::attributeLabels(), array(
			'id' => 'ИД',
			'competitionid' => 'Competitionid',
			'judgeid' => 'Judgeid',
			'commandid' => 'Commandid',
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('competitionid',$this->competitionid);
		$criteria->compare('judgeid',$this->judgeid);
		$criteria->compare('commandid',$this->commandid);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}