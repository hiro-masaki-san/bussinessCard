<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Person extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'groupId',
        'name',
        'ruby',
        'character',
        'memo',
        'imageName'
    ];
    
    /**
     * 人情報(すべて）を取得する
     * 
     * @return 取得結果
     */
    public function getPersonList(){

        return DB::table('persons as person')
                ->selectRaw('person.id as pId,'.
                            'person.name as pName,'.
                            'person.ruby as pRuby,'.
                            'person.imageName as pImg,'.
                            'group.id as gId,'.
                            'group.name as gName'
                 )
                ->join('groups as group', function($join){
                     $join->on('group.id', '=', 'person.groupId');
                 })
                ->orderBy('group.id')
                ->get();
    }
    
    /**
     * 人idに紐づく特定の人情報を取得する
     * 
     * @param $id 人id
     * @return 取得結果
     */
    public function getOnePerson($id){

        return DB::table('persons as person')
                ->selectRaw('person.id as pId,'.
                            'person.name as pName,'.
                            'person.ruby as pRuby,'.
                            'person.character as pCharacter,'.
                            'person.memo as pMemo,'.
                            'person.imageName as pImg,'.
                            'group.id as gId,'.
                            'group.name as gName'
                 )
                ->join('groups as group', function($join){
                     $join->on('group.id', '=', 'person.groupId');
                 })
                ->where('person.id', '=', $id)
                ->first();
    }
    
    /**
     * 人情報を検索する
     *
     * @param request(ユーザーが入力した検索条件）
     * @return result 検索結果
     */
    public function searchPerson(Request $request)
    {
        $pName = str_replace(array(" ", "　"), "",$request->sName);
        
        return DB::table('persons as person')
                ->selectRaw('person.id as pId,'.
                            'person.name as pName,'.
                            'person.ruby as pRuby,'.
                            'person.character as pCharacter,'.
                            'person.memo as pMemo,'.
                            'person.imageName as pImg,'.
                            'group.id as gId,'.
                            'group.name as gName'
                 )
                ->join('groups as group', function($join){
                     $join->on('group.id', '=', 'person.groupId');
                 })
                ->whereRaw("person.name LIKE CONCAT('%', ?, '%')", [$pName])
                ->get();
    }

    /**
     * 人情報登録処理
     *
     * @param groupId グループid
     * @param $request 追加したい人情報
     * @param $filePath 追加したい人の写真のフォルダパス
     * 
     * @return なし
     */
    public function insertPerson($groupId, Request $request, $filePath)
    {
         $param = [
            'groupId' => intval($groupId),
            'name' => $request->pName,
            'ruby' => $request->pRuby,
            'character' => is_null($request->pCharacter) ? "" : $request->pCharacter,
            'memo' => is_null($request->pMemo) ? "" : $request->pMemo,
            'imageName' => is_null($filePath) ? "": $filePath,
         ];

         DB::table('persons')
            ->insert($param);

    }

    /**
     * 人情報編集処理
     *
     * @param groupId グループid
     * @param $request 編集したい人情報
     * @param $filePath 編集したい人の写真のフォルダパス
     * 
     * @return なし
     */
    public function updatePerson($groupId, Request $request, $filePath)
    {
         $param = [
            'groupId' => intval($groupId),
            'name' => $request->pName,
            'ruby' => $request->pRuby,
            'character' => is_null($request->pCharacter) ? "" : $request->pCharacter,
            'memo' => is_null($request->pMemo) ? "" : $request->pMemo,
            'imageName' => is_null($filePath) ? "": $filePath,
         ];

         DB::table('persons')
            ->where('id', $request->pId)
            ->update($param);

    }
    
    

}
