<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "saving".
 *
 * @property int $id
 * @property string $matricule_member matricule de l'épargnant
 * @property int $id_session id de la session à laquelle s'effectue l'epargne
 * @property double $amount montant de l'épargne
 *
 * @property Member $matriculeMember
 * @property Session $session
 */
class Saving extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'saving';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['matricule_member', 'id_session', 'amount'], 'required'],
            [['id_session'], 'integer'],
            [['amount'], 'number'],
            [['matricule_member'], 'string', 'max' => 6],
            [['matricule_member', 'id_session'], 'unique', 'targetAttribute' => ['matricule_member', 'id_session']],
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
            'matricule_member' => 'Matricule Member',
            'id_session' => 'Id Session',
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
