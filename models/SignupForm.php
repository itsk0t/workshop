<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $phone_number;
    public $password_r;
//    public $password_hash;

//    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'name', 'surname', 'email', 'phone_number'], 'required'],
            // rememberMe must be a boolean value
            ['email', 'email', 'message' => 'Почта введена некорректно'],
            ['password_r', 'compare', 'compareAttribute'=>'password'],
//            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
//            ['password', 'validatePassword'],
        ];
    }

    public function signupSave() {
        if (!$this->validate())
        {
            return null;
        }
        $user = new User();
        $user -> username = $this -> username;
//        $user -> password = $this -> password;
        $user -> name = $this -> name;
        $user -> surname = $this -> surname;
        $user -> phone_number = $this -> phone_number;
        $user -> email = $this -> email;
        $user -> password = \Yii::$app->getSecurity()->generatePasswordHash($this -> password);

        return $user->save() ? $user: null;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'phone_number' => 'Номер телефона',
            'email' => 'Email адрес',
            'password_r' => 'Повторите пароль',
        ];
    }
}