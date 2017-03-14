<?php
namespace frontend\models\post;

use yii\base\Model;

/**
 * Add form
 */
class AddForm extends Model
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
    
    public function save($id)
    {
        if (!$this->validate()) {
            return null;
        }

        $args = [
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => $id
        ];

        $post = new Post();
        $post->setArgs($args);
        
        return $post->save() ? $post : null;
    }
}
