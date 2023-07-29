<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Group;
use App\Item;
use App\Http\Requests\PersonStoreRequest;
use App\Http\Requests\PersonUpdateRequest;
use Illuminate\Support\Facades\Storage;

class PersonManageController extends Controller
{
    /**
     * 人情報をリスト上で表示する
     *
     * @return 人情報リスト表示画面
     */
    public function index()
    {
        $personDB = new Person();
        $personList = $personDB->getPersonList();
        return view('personList', ['personList' => $personList ]);
    }

    /**
     * 人情報を検索する
     *
     * @param $requrst 人情報リスト表示画面で指定した検索条件
     * @return 人情報リスト表示画面(検索結果を表示)
     *
     */
    public function search(Request $request)
    {
        $personDB = new Person();
        $person = $personDB->searchPerson($request);
        return view('personList', ['personList' => $person, 'request' => $request ]);
    }
    
    /**
     * 人情報追加画面を表示する
     *
     * @return 人情報追加画面
     *
     */
    public function displayAddPage()
    {
        $groupDB = new Group();
        $groupList = $groupDB->getAllGroup();
        return view('personAdd', ['groupList' => $groupList ]);
    }

    /**
     * 人情報を追加する
     *
     * @return 人情報リスト表示画面にリダイレクトさせる。
     *
     */
    public function store(PersonStoreRequest $request)
    {
        $groupDB = new Group();
        $groupId = $groupDB->insertGroup($request->gName);

        $filePath = "";
        if (!is_null($request->file('pImg'))) { 
            $filePath = $request->file('pImg')->store('public/image');
            $filePath =substr($filePath, strlen("public/"));
        }   

        $personDB = new Person();
        $personDB->insertPerson($groupId, $request, $filePath);
        
        return redirect('/list');
    }
 
    /**
     * 人情報編集画面を表示する
     *
     * @return 人情報編集画面
     *
     */   
    public function displayEditPage(Request $request, $pId)
    {
        
        $personDB = new Person();
        $person = $personDB->getOnePerson($pId);
        
        $groupDB = new Group();
        $groupList = $groupDB->getAllGroup();
        
        return view('personEdit', ['person' => $person, 'groupList' => $groupList ]);
    }

    /**
     * 人情報を編集する
     *
     * @return 人情報リスト表示画面にリダイレクトさせる。
     *
     */
    public function update(PersonUpdateRequest $request)
    {
        $groupDB = new Group();
        $groupId = $groupDB->insertGroup($request->gName);
        
        $filePath = "";
        if (is_null($request->file('pImg'))) {
            $filePath = $request->previousImg;
        } else {
            if ($request->previousImg != "") {
                Storage::disk('public')->delete($request->previousImg);
            }
            $filePath = $request->file('pImg')->store('public/image');
            $filePath =substr($filePath, strlen("public/"));
        }

        $personDB = new Person();
        $personDB->updatePerson($groupId, $request, $filePath);
        
        return redirect('/list');
    }

}
