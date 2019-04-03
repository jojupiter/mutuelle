<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "registration".
 *
 * @property string $matricule_member matricule du membre qui s'inscrit
 * @property double $amount frais d'inscription qui sera lu dans la table paramètre
 * @property string $date_ date d'inscription
 *
 * @property Member $matriculeMember
 */
class Registration extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registration';
    }
    
    
        /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['matricule_member', 'amount'], 'required'],
            [['amount'], 'number'],
            [['matricule_member'], 'string', 'max' => 6],
            [['matricule_member'], 'unique'],
            [['matricule_member'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['matricule_member' => 'matricule']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'matricule_member' => 'Matricule Member',
            'amount' => 'Amount',
            'date_' => 'Date',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getMatriculeMember()
    {
        return $this->hasOne(Member::className(), ['matricule' => 'matricule_member']);
    }
}
