@extends('template')
@section('title','人情報')

@section('css')
<link rel="stylesheet" href="{{ asset('css/personInput.css', true) }}">
@endsection

@include('parts.header')

@section('content')
<div class="search_bg">
   <p>変更</p>
</div>

@if ($errors->any())
  <br>
  <div class="error-message">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  <br>
@endif

  <div class="whole_layout">
     <form method="post" action="/update" enctype="multipart/form-data">
       @csrf 
       <input type="hidden" name="pId" value="{{ $person->pId }}" />
       
       <p>■グループ</p>
       <p>※ 既存の別グループに変更する時は一度入力内容を削除して下さい</p>
       <input type="text" name="gName" list="group"
        value="{{ old('gName') ? old('gName') : $person->gName }}"/>
       <datalist id="group">
       @foreach ($groupList as $group)
         <option value="{{ $group->name }}">
       @endforeach
       </datalist>
     
       <p>■名前</p>
       <input type="text" name="pName" list="group" autocomplete="off"
        value="{{ old('pName') ? old('pName') : $person->pName }}"/>

       <p>■カナ</p>
       <input type="text" name="pRuby" list="group" autocomplete="off"
        value="{{ old('pRuby') ? old('pRuby') : $person->pRuby }}"/>
       
       <p>■特徴</p>
       <input type="text" name="pCharacter" list="group" autocomplete="off"
        value="{{ old('pCharacter') ? old('pCharacter') : $person->pCharacter }}"/>

       <p>■メモ</p>
       <input type="text" name="pMemo" list="group" autocomplete="off"
        value="{{ old('pMemo') ? old('pMemo') : $person->pMemo }}"/>

       <p>■写真</p>
       @if($person->pImg == "")
           <p>写真は添付されておりません。</p>
       @else
           <img src="{{ asset('storage/' . $person->pImg) }}" width="200px" height="200px">
           <p>※ 写真を変更したい場合は下記から変更</p>
       @endif
       
       <input type="file" name="pImg" >
       <input type="hidden" name="previousImg" value="{{ $person->pImg }}">
       
       <div class="button_field">
         <input type="submit" class="exec_btn" value="登録">
         <a class="back_btn" href="/list">戻る</a>
       </div>
     </form>
  </div>

@endsection
