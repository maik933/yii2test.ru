<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;

/**
 * Add form
 */
class AddForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Введите имя'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Данное имя уже занято'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Введите email'],
            ['email', 'email', 'message' => 'Введите правильно email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Данный email уже зарегистрирован'],

            ['password', 'required', 'message' => 'Введите пароль'],
            ['password', 'string', 'min' => 6],

            ['role', 'integer']
        ];
    }

    /**
     * @return User|null the saved model or null if saving fails
     */
    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $args = [
            'username' => $this->username,
            'email'   => $this->email,
            'role'    => $this->role
        ];

        $user = new User();
        $user->setArgs($args);
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
