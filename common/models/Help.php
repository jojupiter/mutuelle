<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "help".
 *
 * @property int $id
 * @property string $matricule_member matricule du membre ayant reçu l'aide
 * @property int $id_session session à laquelle il a perçu cette aide
 * @property int $type le type de l'aide se trouve dans la table parametre. c'est dans cette table qu'on va lire le montant (par membre) de l'aide à donner en fonction du type de l'aide.classification : 6 : deces_parent7 : deces_beau_parent8 : deces_membre  : ici l'aide est versé auprès de la famille du membre9 : deces_conjoint10 : deces_enfant11 : naissance12 : mariage13 : autres évènement joyeux14 : aures évènements malheureux
 *
 * @property Member $matriculeMember
 * @property Session $session
 */
class Help extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'help';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['matricule_member', 'id_session', 'type'], 'required'],
            [['id_session', 'type'], 'integer'],
            [['matricule_member'], 'string', 'max' => 6],
            [['matricule_member'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['matricule_member' => 'matricule']],
            [['id_session'], 'exist', 'skipOnError' => true, 'targetClass' => Session::className(), 'targetAttribute' => ['id_session' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'matricule_member' => 'Matricule Member',
            'id_session' => 'Id Session',
            'type' => 'Type',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getMatriculeMember() {
        return $this->hasOne(Member::className(), ['matricule' => 'matricule_member']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSession() {
        return $this->hasOne(Session::className(), ['id' => 'id_session']);
    }

    public static function getMemberList() {
        return ArrayHelper::map(Member::find()->all(), 'matricule', 'fullName');
    }
    
    public static function getMemberList2() {
        $current_exercise_id = (new Query())->from('exercise')->max('id');
        $sessions_in_current_exercise_id = (new Query())->select('id')->from('session')->where(['id_exercise' => $current_exercise_id]);
        $loans = (new Query())->from('loan')->where(['id_session'=>$sessions_in_current_exercise_id]);
        $setting = Setting::findOne(['id_exercise'=>$current_exercise_id]);
        $unpayed_loans_ids = [];

        foreach ($loans->each() as $loan){
        $active_loan = Loan::findOne($loan['id']);
        $total = $active_loan->getRepayments()->sum('amount');
        if($total < (1+$setting->interest_rate)*$active_loan->amount) $unpayed_loans_ids[] = $active_loan->id;
    }
        $unpayed_loans = (new Query())->select('matricule_member')->from('loan')->where(['id'=>$unpayed_loans_ids]);

        return ArrayHelper::map(Member::find()->where(['NOT IN','matricule',$unpayed_loans])->all(), 'matricule', 'fullName');
    }

}
