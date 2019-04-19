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
      
      <th scope="col">الحساب البنكى</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @foreach($banks as $r)
  <tr>

  <td>{{$r->bankName}}</td>
  <?php
  if(Session('per39')!=null){
    ?>
    <td><a href="{{url('Admin/Editbanks/'.$r->id)}}"><button type="button" class="btn btn-primary">تعديل</button></a></td>
  <?php } 
  if(Session('per41')!=null){
    ?>
  <td><a href="{{url('Admin/showbanks/'.$r->id)}}"><button type="button" class="btn btn-danger">حذف</button></a></td>
<?php }
else{


}
?>
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