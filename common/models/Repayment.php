<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "repayment".
 *
 * @property int $id
 * @property int $id_session session à laquelle le remboursement s'effectue
 * @property int $id_loan
 * @property double $amount montant du remboursement
 *
 * @property Loan $loan
 * @property Session $session
 */
class Repayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repayment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_session', 'id_loan', 'amount'], 'required'],
            [['id_session', 'id_loan'], 'integer'],
            [['amount'], 'number'],
            [['id_session', 'id_loan'], 'unique', 'targetAttribute' => ['id_session', 'id_loan']],
            [['id_loan'], 'exist', 'skipOnError' => true, 'targetClass' => Loan::className(), 'targetAttribute' => ['id_loan' => 'id']],
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
            'id_loan' => 'Id Loan',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoan()
    {
        return $this->hasOne(Loan::className(), ['id' => 'id_loan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(Session::className(), ['id' => 'id_session']);
    }
}
