<?php
namespace frontend\models\post;

use yii\base\Model;

/**
 * Update form
 */
class UpdateForm extends Model
{
    public $title;
    public $body;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['title', 'trim'],
            ['title', 'required', 'message' => 'Введите название поста'],

            ['body', 'trim'],
            ['body', 'required', 'message' => 'Введите пост']
        ];
    }
    
    public function save($post)
    {
        if (!$this->validate()) {
            return null;
        }

        $post->title = $this->title;
        $post->body = $this->body;

        return $post->save() ? $post : null;
    }
}
