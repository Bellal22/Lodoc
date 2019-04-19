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
      
      <th scope="col">الدور</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @foreach($rol as $r)
  <tr>

  <td>{{$r->titles}}</td>
  <td><a href="{{url('Admin/Editroles/'.$r->id)}}"><button type="button" class="btn btn-primary">تعديل</button></a></td>
  <td><a href="{{url('Admin/d_roles/'.$r->id)}}"><button type="button" class="btn btn-danger">حذف</button></a></td>
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