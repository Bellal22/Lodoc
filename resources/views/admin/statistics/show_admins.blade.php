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
<table class="table">
  <thead>
    <tr>
      
      <th scope="col">الأسم</th>
      <th scope="col">البريد الألكترونى</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @foreach($admin as $r)
  <tr>
  
  <td>{{$r->name}}</td>
  <td>{{$r->email}}</td>
  <td><a href="{{url('Admin/editadmins/'.$r->id)}}"><button type="button" class="btn btn-primary">تعديل</button></a></td>
  <td><a href="{{url('Admin/showadmins/'.$r->id)}}"><button type="button" class="btn btn-danger">حذف</button></a></td>
  </tr>
  @endforeach
  </tbody>
</table>
</div>
</div>

    @include('layout.footer')
<script src={{asset("js/inputs.js")}}></script>
<?php
}
?>