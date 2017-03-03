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
    
    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $post = new Post();
        $post->title = $this->title;
        $post->body = $this->body;
        $post->user_id = $id;
        
        return $post->save() ? $post : null;
    }
}
