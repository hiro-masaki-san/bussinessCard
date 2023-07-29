<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gName' => 'required | string | max:20',
            'pName' => 'required | string | max:20',
            'pRuby' => 'required | string | max:20',
            'pCharacter' => 'max:500',
            'pMemo' => 'max:500',
            'pImg' => 'image | file',
        ];
    }

    public function attributes()
    {
        return [
            'gName' => 'グループ名',
            'pName' => '名前',
            'pRuby' => 'カナ',
            'pCharacter' => '特徴',
            'pMemo' => 'メモ',
            'pImg' => '写真',
        ];
    }

    public function messages()
    {
        return [
            'gName.required' => ':attributeを入力してください。',
            'gName.string' => ':attributeが正しく入力されていません。',
            'gName.max' => ':attributeは20文字以下で入力してください。',
            'pName.required' => ':attributeを入力してください。',
            'pName.string' => ':attributeが正しく入力されていません。',
            'pName.max' => ':attributeは20文字以下で入力してください。',
            'pRuby.required' => ':attributeを入力してください。',
            'pRuby.string' => ':attributeが正しく入力されていません。',
            'pRuby.max' => ':attributeは20文字以下で入力してください。',            
            'pCharacter.max' => ':attributeは500文字以下で入力してください。',            
            'pMemo.max' => ':attributeは500文字以下で入力してください。',
            'pImg.image' => ':attribute欄で選択したファイルは画像ファイルではありません。', 
            'pImg.file' => ':attribute欄で選択したファイルは画像ファイルではありません。', 
        ];
    }
}