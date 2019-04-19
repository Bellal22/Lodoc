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
    <form method="post" action="#" >
    {{csrf_field()}}
  <div class="form-group">
    <label for="exampleInputEmail1">الأسم</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الأسم"name="name">

  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">البريد الالكترونى</label>
    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="البريد الالكترونى" name="email">
  </div>
    <div class="form-group">
    <label for="exampleInputPassword1">كلمة السر</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة السر" name="pass">
  </div>
  <!-- <div class="form-group">
    <label for="exampleInputPassword1">تأكيد كلمة السر</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة السر" name="pass">
  </div> -->

<h1>الدور</h1>
  <div class="form-check">
  @foreach($rol as $r)
    <input type="checkbox" class="form-check-input" value="{{$r->id}}" name="role[]">
    <label class="form-check-label" for="exampleCheck1" >{{$r->titles}}</label>
    <br>
    @endforeach
  </div>
  <?php
if (Session('per36') != null) {
    ?>
  <button type="submit" class="btn btn-primary">ادخال</button>
  <?php
  }
  ?>
</form>
<br>
<?php
if (Session('per37') != null) {
    ?>
<a href="{{url('Admin/showadmins')}}"><button type="submit" class="btn btn-primary">عرض بينات المديرين</button></a>
<?php
}
?>
    @include('layout.footer')
<script src={{asset("js/inputs.js")}}></script>
<?php
}
?>