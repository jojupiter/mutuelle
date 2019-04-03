<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "socialbackground".
 *
 * @property int $id
 * @property int $id_session session à laquelle s'effectue le versement d'une tranche du fond social
 * @property string $matricule_member matricule du membre
 * @property double $amount montant versé
 *
 * @property Member $matriculeMember
 * @property Session $session
 */
class Socialbackground extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'socialbackground';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_session', 'matricule_member', 'amount'], 'required'],
            [['id_session'], 'integer'],
            [['amount'], 'number'],
            [['matricule_member'], 'string', 'max' => 6],
            [['id_session', 'matricule_member'], 'unique', 'targetAttribute' => ['id_session', 'matricule_member']],
            [['matricule_member'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['matricule_member' => 'matricule']],
            [['id_session'], 'exist', 'skipOnError' => true, 'targetClass' => Session::className(), 'targetAttribute' => ['id_session' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_session' => 'Id Session',
            'matricule_member' => 'Matricule Member',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatriculeMember()
    {
        return $this->hasOne(Member::className(), ['matricule' => 'matricule_member']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(Session::className(), ['id' => 'id_session']);
    }
}
