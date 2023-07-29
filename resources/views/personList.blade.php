@extends('template')
@section('title','人情報')

@section('css')
<link rel="stylesheet" href="{{ asset('css/personManage.css', true) }}">
@endsection

@section('content')
<div class="title_bg">
   <p>一覧</p>
</div>

<div class="search_bg">
  <form action="/search" method="POST">
    @csrf
    <input name="sName" style="padding-bottom:0px; "inputmode="search" placeholder="名前検索"
     value="{{isset($request) ? $request->sName : ''}}"/>
    <a style="margin: 0px; font-size: 10px;" href="/list">検索条件のクリア<p/>
  </form>
  <a class="add_btn" href="/add">追加</a>
</div>


<div hidden>
  {{ $tmpGId = 0 }}
</div>

<form method="get" name="personEdit" action="/edit" >
  @csrf
  @foreach ($personList as $person)
    @if($person->gId != $tmpGId)
      @if($person->gId != 0)
        </div>
      @endif
      <p>・{{ $person->gName}}</p>
      <div hidden>
        {{ $tmpGId = $person->gId }}
      </div>
      <div class="grp_bg">
    @endif
    <div class="name_margin">
     <div style="height:5px;"></div>
     <div class="person" >
       <a href="/edit/{{ $person->pId }}"></a>
       <p class="name_font">{{ $person->pName }}</p>
       @if($person->pImg != "")
           <img src="{{ asset('storage/' . $person->pImg) }}" width="250px" height="200px">
       @endif
       <input type="hidden" name="pId" value="{{ $person->pId }}" />
     </div>
    </div>
    <hr>
  @endforeach
</form>
@endsection