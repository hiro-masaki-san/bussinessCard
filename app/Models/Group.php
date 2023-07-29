<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class Group extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
    
    /**
     * グループ一覧すべてを取得する
     * 
     * @return 取得結果
     */
    public function getAllGroup(){

        return DB::table('groups as group')
                ->selectRaw('id,'.
                            'name'
                 )
                ->orderBy('group.id')
                ->get();
    }
    
    /**
     * 人情報登録/編集処理にて、グループ名が新規がどうかの判定を行い
     * 新規の場合は新しいID、存在する場合はテーブルに登録されているIDを返す。
     *
     * @param newGroup ユーザーが入力したグループ名
     * @return 引数で指定されたグループ名に対応する人（ID）
     */
    public function insertGroup($newGroup)
    {
         $data = DB::table('groups as group')
                ->selectRaw('id')
                ->where('name', '=', $newGroup)
                ->first();
         
         if (!empty($data)) {
             return $data->id;
         }
         
         $param = [
            'name' => $newGroup,
         ];

         DB::table('groups')
            ->insert($param);

         $data = DB::table('groups as group')
            ->selectRaw('id')
            ->where('name', '=', $newGroup)
            ->first();
         
         return $data->id;
    }

}
