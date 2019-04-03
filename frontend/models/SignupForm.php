<?php

namespace frontend\models;

use common\models\Member;
use common\models\User;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $username;
    public $password;
    public $retype_password;
    public $email;
    public $id;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['retype_password', 'required'],
            ['retype_password', 'string', 'min' => 6],
            ['retype_password', 'validateRetypePassword'],
            [['email', 'id'], 'validateEmailMatricule'],
            ['id', 'required', 'message' => "Matricule cannot be blank"],
            ['id', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This matricule has already been taken.'],
        ];
    }

    public function validateRetypePassword($attribute, $params) {
        if ($this->password !== $this->retype_password) {
            $this->addError($attribute, 'Confirm password is different from password');
        }
    }
    
    public function validateEmailMatricule($attribute, $params){
        if(Member::findOne(['matricule'=> $this->id, 'email'=> $this->email]) == NULL){
            $this->addError($attribute,'There is no member with this matricule and email.');
        }
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        /* if($membre = Membre::findOne(['matricule' => $this->matricule, 'email' => $this->email])){
          $this->email = $membre->email;
          } */

        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->id = $this->id;
        $user->status = $user::STATUS_ACTIVE;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generatePasswordResetToken();
        return $user->save() ? $user : null;
    }

}
