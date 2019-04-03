<?php

namespace common\models;

use Faker\Provider\zh_TW\DateTime;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "exercise".
 *
 * @property int $id Correspond a l'année de l'exercice
 * @property int $year
 * @property int $month
 * @property int $duration
 * @property int $session_frequency
 *
 * @property Session[] $sessions
 * @property Setting $setting
 */
class Exercise extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exercise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year', 'month'], 'required'],
            [['year', 'month', 'duration', 'session_frequency'], 'integer'],
            [['year', 'month'], 'unique', 'targetAttribute' => ['year', 'month']],
            [['year', 'month'], 'validateDate'],
        ];
    }
    
    
    public function validateDate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $last_exercise_id = (new Query())->from('exercise')->max('id');
            if($last_exercise_id != NULL){
                $last_exercise = Exercise::findOne($last_exercise_id);
                $date1 = date_create();
                date_date_set($date1, $last_exercise->year,$last_exercise->month+1, 1);
                $date2 = date_create();
                date_date_set($date2, $this->year,$this->month+1, 1);
                $add = "+".$last_exercise->duration." months";
                $date1 = date('Y-m-d',strtotime($date1->format('Y-m-d').' '.$add));
                $expire_dt = strtotime($date1);
                $today_dt = strtotime($date2->format('Y-m-d'));
                
                if($today_dt < $expire_dt && $last_exercise_id != $this->id){
                    $this->addError('year', "This date comes before the end of the last exercise");
                    $this->addError('month', "This date comes before the end of the last exercise");
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
            'year' => 'Year',
            'month' => 'Month',
            'duration' => 'Duration',
            'session_frequency' => 'Session Frequency',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Session::className(), ['id_exercise' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSetting()
    {
        return $this->hasOne(Setting::className(), ['id_exercise' => 'id']);
    }
}
