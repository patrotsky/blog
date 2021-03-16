<?php

namespace App\Http\Requests\blog;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Consultar también el PostObserver.php
        $post=$this->route()->parameter('post');
        if($post && $post->user_id == auth()->id()){
            return true;
        }elseif(auth()){
            return true;
        }
        return false;
        //todo: luego volvemos con Laravel permissions
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //Para el formulario de "update post", obtener la variable
        $post=$this->route()->parameter('post');

        $rules = [
            'name'=>'required',
            'slug'=>'required|unique:posts',
            'status'=>'required|in:1,2',/* todo: status*/
            'file'=>'image'
        ];
        if($post){
            $rules['slug']='required|unique:posts,slug,'.$post->id;
        }
        if($this->status==2){/*todo: status*/
            $rules=array_merge($rules,[
                'category_id'=>'required',
                'tags'=>'required',
                'extract'=>'required',
                'body'=>'required',
            ]);
        }
        return $rules;
    }
}
