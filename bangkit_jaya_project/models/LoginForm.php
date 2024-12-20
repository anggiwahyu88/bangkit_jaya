<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $nama;
    public $password;
    public $rememberMe = true;

    private ?User $_user = null; // Properti dapat berupa User atau null


    public function rules()
    {
        return [
            [['nama', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Nama atau password salah.');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    protected function getUser()
    {
        if (!$this->_user) {
            $this->_user = User::findByUsername($this->nama);
        }
        return $this->_user;
    }
}
