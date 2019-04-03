<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property string $id matricule du membre auquel est associé ce compte utilisateur
 * @property string $username nom d'utilisateur
 * @property string $auth_key clé d'authentification
 * @property string $password_hash mot de passe crypté
 * @property string $password_reset_token clé permettant la réinitilisation du mot de passe
 * @property string $email adresse email du membre auquel correspond ce compte utilisateur
 * @property int $status 10 : pour compte actif 0 : pour compte désactivé - ici le membre ne peut se connecter à la plateforme
 * @property int $type 0 : pour utilisateur  1 : pour administrateur
 * @property string $created_at date de création du compte utilisateur
 * @property string $updated_at date de la dernière modification des information du compte
 *
 * @property Member $id0
 */
class User extends ActiveRecord implements  IdentityInterface
{
    /**
     * @inheritdoc
     */
    
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    
    public static function tableName()
    {
        return 'user';
    }

    
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
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
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['id', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'type'], 'integer'],
            [['id'], 'string', 'max' => 6],
            [['username'], 'unique'],
            [['id'], 'unique'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['id'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['id' => 'matricule','email' => 'email']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Member::className(), ['matricule' => 'id']);
    }

    public function getAuthKey(): string {
        return $this->auth_key;
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey): bool {
        return $this->auth_key === $authKey;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id): IdentityInterface {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
            
    }
    
    /**
     * {@inheritdoc}
     */
    public static function findUser($id){
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null): IdentityInterface {
        
    }
    
    public function getStatu() {
        return $this->status;
    }

    public static function findByUsername($username) {
        return self::findOne(['username' => $username]);
    }
    
        /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    /**
     * @return ActiveQuery
     */
    public function getMembre() {
        return $this->hasOne(Membre::className(), ['id' => 'matricule']);
    }

    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

}