<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "session".
 *
 * @property int $id numéro de la session
 * @property int $id_exercise annee d'exercice auquel cette session appartient
 * @property string $date_ date de la session
 *
 * @property Help[] $helps
 * @property Loan[] $loans
 * @property Member[] $matriculeMembers
 * @property Repayment[] $repayments
 * @property Loan[] $loans0
 * @property Saving[] $savings
 * @property Member[] $matriculeMembers0
 * @property Exercise $exercise
 * @property Socialbackground[] $socialbackgrounds
 * @property Member[] $matriculeMembers1
 */
class Session extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_exercise', 'date_'], 'required'],
            [['id_exercise'], 'integer'],
            [['date_'], 'safe'],
            [['date_'], 'unique'],
            [['id_exercise'], 'exist', 'skipOnError' => true, 'targetClass' => Exercise::className(), 'targetAttribute' => ['id_exercise' => 'id']],
            [['date_'], 'validateDate'],
        ];
    }
    
    public function validateDate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $last_exercise_id = (new Query())->from('exercise')->max('id');
            $last_exercise = Exercise::findOne($last_exercise_id);
            $last_session_in_exercise_id = (new Query())->from('session')->where(['id_exercise'=> $this->id_exercise])->max('id');
            $date_begin = date_create();
            $date_end = date_create();
            date_date_set($date_begin,$last_exercise->year,$last_exercise->month+1, 1);       
            $date_begin = $date_begin->format('Y-m-d');
            date_date_set($date_end,$last_exercise->year,$last_exercise->month+1,1);
            $add = "+".$last_exercise->duration." months";
            $date_end = date('Y-m-d',strtotime($date_end->format('Y-m-d').' '.$add));
            $begin_dt = strtotime($date_begin);
            $end_dt = strtotime($date_end);
            $between_dt = strtotime($this->date_);
            if($last_session_in_exercise_id != NULL){
                
                $last_session_in_exercise = Session::findOne($last_session_in_exercise_id);
                $year = date('Y', strtotime($last_session_in_exercise->date_));
                $month = date('m', strtotime($last_session_in_exercise->date_));
                $date_begin = date_create();
                date_date_set($date_begin,$year,$month,1);       
                $add = "+".$last_exercise->session_frequency." months";
                $date_begin = date('Y-m-d',strtotime($date_begin->format('Y-m-d').' '.$add));
                $begin_dt = strtotime($date_begin);
                if(($between_dt < $begin_dt || $between_dt >= $end_dt) && $last_session_in_exercise_id != $this->id){
                    $this->addError($attribute, "This date must be between ".$date_begin." and ".$date_end); 
            }
            }else{
            if($between_dt < $begin_dt || $between_dt >= $end_dt){
                    $this->addError($attribute, "This date must be between ".$date_begin." and ".$date_end); 
            }
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_exercise' => 'Id Exercise',
            'date_' => 'Date',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getHelps()
    {
        return $this->hasMany(Help::className(), ['id_session' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(Loan::className(), ['id_session' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getMatriculeMembers()
    {
        return $this->hasMany(Member::className(), ['matricule' => 'matricule_member'])->viaTable('loan', ['id_session' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getRepayments()
    {
        return $this->hasMany(Repayment::className(), ['id_session' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getLoans0()
    {
        return $this->hasMany(Loan::className(), ['id' => 'id_loan'])->viaTable('repayment', ['id_session' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSavings()
    {
        return $this->hasMany(Saving::className(), ['id_session' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getMatriculeMembers0()
    {
        return $this->hasMany(Member::className(), ['matricule' => 'matricule_member'])->viaTable('saving', ['id_session' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getExercise()
    {
        return $this->hasOne(Exercise::className(), ['id' => 'id_exercise']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSocialbackgrounds()
    {
        return $this->hasMany(Socialbackground::className(), ['id_session' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getMatriculeMembers1()
    {
        return $this->hasMany(Member::className(), ['matricule' => 'matricule_member'])->viaTable('socialbackground', ['id_session' => 'id']);
    }
}
