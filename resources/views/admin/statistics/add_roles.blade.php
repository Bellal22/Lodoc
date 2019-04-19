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
    <label for="exampleInputEmail1">الدور</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الدور"name="role">

  </div>


<h1>الدور</h1>
  <div class="form-check">
  @foreach($permissions as $p) <label><input type="checkbox"  name="permissi[]" value="{{$p->id}}">{{$p->title}}</label>
    <br>
    @endforeach
  </div>
  <?php
if (Session('per35') != null) {
    ?>
  <button type="submit" class="btn btn-primary">ادخال</button>
 <?php
 }
 ?>
</form>
<br>
<?php
if (Session('per34') != null) {
    ?>
<a href="{{url('Admin/showroles')}}"><button type="button" class="btn btn-primary" >عرض البيانات </button></a>

<?php
}
?>

    @include('layout.footer')
<script src={{asset("js/inputs.js")}}></script>
<?php
}
?>