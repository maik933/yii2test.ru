<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;

/**
 * Update form
 */
class UpdateForm extends Model
{
    public $username;
    public $email;
    public $password;
    private static $id;
    
    public function __construct(int $id)
    {
        UpdateForm::$id = $id;
    }

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Введите имя'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'Данное имя уже занято', 'filter' => ['!=','id', UpdateForm::$id]],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Введите email'],
            ['email', 'email', 'message' => 'Введите правильно email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'Данный email уже зарегистрирован', 'filter' => ['!=' , 'id', UpdateForm::$id]],
            ['email', 'string', 'max' => 255]
        ];
    }

    /**
     * @return User|null the saved model or null if saving fails
     */
    public function save($user)
    {
        $user->username = $this->username;
        $user->email = $this->email;

        if ($this->password != '') {
            $user->setPassword($this->password);
        }

        if (!$this->validate()) {
            return null;
        }

        return $user->save() ? $user : null;
    }
}
