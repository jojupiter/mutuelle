<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property string $matricule Exemple : 18M00118 signifie que le membre s'est inscrit en 2018001 signifie qu'il est le premier membre à s'inscrire cette année.
 * @property string $firstname Exemple : LONLAStocker les noms en majuscule
 * @property string $lastname Exemple : Gatien Jordanles premières lettres de chaque prénom en majuscule
 * @property string $phone Exemple : +237 695 463 868
 * @property string $email Exemple : gatienjordanlonlaep@gmail.comstocker les email en minuscule
 * @property string $photo
 * @property string $pobox Exemple : BP : 8120 Yaoundé
 * @property string $residence Exemple : EMANAstocker les quatier résidentiel en majuscule
 *
 * @property Help[] $helps
 * @property Loan[] $loans
 * @property Session[] $sessions
 * @property Registration $registration
 * @property Saving[] $savings
 * @property Session[] $sessions0
 * @property Socialbackground[] $socialbackgrounds
 * @property Session[] $sessions1
 * @property User $user
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['matricule', 'firstname', 'lastname', 'phone', 'email', 'residence'], 'required'],
            [['matricule'], 'string', 'max' => 6],
            [['firstname', 'lastname', 'email', 'photo', 'residence'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['pobox'], 'string', 'max' => 50],
            [['firstname', 'lastname'], 'unique', 'targetAttribute' => ['firstname', 'lastname']],
            [['email'], 'unique'],
            [['matricule'], 'unique'],
            [['phone'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'matricule' => 'Matricule',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'phone' => 'Phone',
            'email' => 'Email',
            'photo' => 'Photo',
            'pobox' => 'Pobox',
            'residence' => 'Residence',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHelps()
    {
        return $this->hasMany(Help::className(), ['matricule_member' => 'matricule']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(Loan::className(), ['matricule_member' => 'matricule']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Session::className(), ['id' => 'id_session'])->viaTable('loan', ['matricule_member' => 'matricule']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistration()
    {
        return $this->hasOne(Registration::className(), ['matricule_member' => 'matricule']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSavings()
    {
        return $this->hasMany(Saving::className(), ['matricule_member' => 'matricule']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessions0()
    {
        return $this->hasMany(Session::className(), ['id' => 'id_session'])->viaTable('saving', ['matricule_member' => 'matricule']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialbackgrounds()
    {
        return $this->hasMany(Socialbackground::className(), ['matricule_member' => 'matricule']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessions1()
    {
        return $this->hasMany(Session::className(), ['id' => 'id_session'])->viaTable('socialbackground', ['matricule_member' => 'matricule']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'matricule']);
    }
    
    public function getFullName() {
        return $this->firstname . ' ' . $this->lastname;
        //first_name and last_name are fields in User model
    }
}
