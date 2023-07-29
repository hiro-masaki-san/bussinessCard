@extends('template')
@section('title','人情報')

@section('css')
<link rel="stylesheet" href="{{ asset('css/personInput.css', true) }}">
@endsection

@include('parts.header')

@section('content')
<div class="search_bg">
   <p>登録</p>
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
     <form method="post" action="/store" enctype="multipart/form-data">
       @csrf 
       <p>■グループ</p>
       <input type="text" name="gName" list="group" autocomplete="off" 
        value="{{ old('gName') ? old('gName') : "" }}"/>
       <datalist id="group">
       @foreach ($groupList as $group)
         <option value="{{ $group->name }}">
       @endforeach
       </datalist>
     
       <p>■名前</p>
       <input type="text" name="pName" list="group" autocomplete="off" value="{{ old('pName') ? old('pName') : "" }}"/>

       <p>■カナ</p>
       <input type="text" name="pRuby" list="group" autocomplete="off" value="{{ old('pRuby') ? old('pRuby') : "" }}"/>
       
       <p>■特徴</p>
       <input type="text" name="pCharacter" list="group" autocomplete="off" value="{{ old('pCharacter') ? old('pCharacter') : "" }}" />

       <p>■メモ</p>
       <input type="text" name="pMemo" list="group" autocomplete="off" value="{{ old('pMemo') ? old('pMemo') : "" }}" />
       
       <p>■写真</p>
       <input type="file" name="pImg" >

       <div class="button_field">
         <input type="submit" class="exec_btn" value="登録">
         <a class="back_btn" href="/list">戻る</a>
       </div>
     </form>
  </div>

@endsection
