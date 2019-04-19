<?php
session()->regenerate();
if(Session('id')==null){
        echo "ليس لديك الصلاحيات للدخول على تلك الصفحة";
}else{
?>
@include('layout.head')
@include('admin.barsAdmin')


<div id="page-wrapper">
    <h1 class="text-center"></h1>
    <div id="app">
    <form method="post" action="#" enctype="multipart/form-data">
    {{csrf_field()}}
    @foreach($values as $v)
  <div class="form-group">
    <label for="exampleInputEmail1">أسم البنك</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الأسم"name="name" value="{{$v->bankName}}">

  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">الحساب</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="الحساب البنكى" name="account" value="{{$v->accountOwner}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"> رقم الحساب</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="رقم الحساب" name="caccount" value="{{$v->accountNumber}}">
  </div>
    <div class="form-group">
    <label for="exampleInputPassword1"> سويفت كود</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="سويفت كود" name="swift" value="{{$v->swift}}">
  </div>
  <div class="input-group">
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="inputGroupFile04" name="image">
    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
  </div> 
 
    <br>
  </div>
  @endforeach
  <button type="submit" class="btn btn-primary">ادخال</button>
</form>
<br>

    @include('layout.footer')
<script src={{asset("js/inputs.js")}}></script>
<?php

}
?>