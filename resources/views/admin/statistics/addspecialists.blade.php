<?php
session()->regenerate();
if(Session('id')==null){
        echo "ليس لديك الصلاحيات للدخول على تلك الصفحة";
}else{
?>
@include('layout.head')
@include('admin.barsAdmin')
<link href={{asset("css/adminpanel-2.css")}} rel="stylesheet">
<link href={{asset("css/app.css")}} rel="stylesheet">

<div id="page-wrapper">
    <div id="app">
    <input type="hidden" id="idele" value="{{ Session::get('id') }}" >
        {{-- <el-form :inline="true" :model="formInline" :rules="rules" ref="formInline" class="demo-form-inline" enctype="multipart/form-data">
            <el-form-item label="التخصص بالعربية">
                <el-input v-model="formInline.medical_specialties_ar" placeholder="التخصص"></el-input>
            </el-form-item>
            <el-form-item label="التخصص بالإنجليزيه">
                <el-input v-model="formInline.medical_specialties_en" placeholder="Specialist"></el-input>
            </el-form-item>
               <el-form-item>
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </el-form-item>
            <el-form-item>

            <el-button type="primary" @click="Adddstrict('formInline')">إضافة</el-button>
            </el-form-item>
         

        </el-form> --}}
        <!-- my form to upload and add specialist-->
 <form method="POST" enctype="multipart/form-data"  action="#">
    {{csrf_field()}}
  <div class="form-row">

        <!--submit button-->
    <div class="form-group col-md-3">
            <button type="submit" class="btn btn-primary" style="margin-top: 20px">اضافة التخصص</button>
     
      </a>   </div>
  </div>
        <!--upload file-->
    <div class="form-group col-md-3">
        <label for="inputPassword4">اختار الصورة</label>
          <input type="file" class="form-control-file" id="exampleFormControlFile1" name="icon">
    </div>
  
  <div class="form-group col-md-3">
      <label for="inputPassword4">التخصص بالإنجليزية</label>
      <input type="text" class="form-control" id="inputPassword4" placeholder="التخصص باللغة الانجليزية" name="en">
    </div>
    <div class="form-group col-md-3">
      <label for="inputEmail4">التخصص بالعربية</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="التخصص باللغة العربية" name="ar">
    </div>
    
  

</form>

@if (session('alert'))
    <div class="form-group col-md-12 alert alert-success">
        {{ session('alert') }}
    </div>
@endif
<br>

            <el-table
                    class="tableSpecial"
                    :data="form"
                    height="450"

                    style="width: 70%">
                <el-table-column
                        prop="medical_specialties_ar"
                        label="التخصص بالعربية"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="medical_specialties_en"
                        label="التخصص بالإنجليزية"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="icone"
                        label="أيقونة"
                        width="80">
                </el-table-column>
                <el-table-column label="">
                    <template slot-scope="scope">
                    <?php
if (Session('per33') != null) {
    ?>
                        <el-button
                                class="el-icon-delete"
                                size="medium"
                                type="danger"
                                @click="deleteSpecialist(scope.$index, scope.row)">
                            &nbsp;&nbsp;
                            حذف
                        </el-button>
                    </template>
                </el-table-column>
            <?php
} if(Session('per34') != null){
            ?>
                <el-table-column label="">
                    <template slot-scope="scope">
                        <el-button
                                class="el-icon-edit"
                                size="medium"
                                type="warning"
                                @click=update(scope.row)>
                            &nbsp;&nbsp;
                            تعديل
                        </el-button>
<?php
} else{
    
}
?>
                    </template>

                </el-table-column>
            </el-table>

        <el-dialog title="تعديل البيانات" class="dir" :visible.sync="dialogFormVisible">
            <el-form :model="formInline" :rules="rules" ref="formInline" label-width="120px"
                     class="demo-ruleForm">

                <el-form-item label="" :label-width="formLabelWidth" prop="medical_specialties_ar">
                    اسم التخصص بالعربية
                    <el-input v-model="formInline.medical_specialties_ar" auto-complete="on"></el-input>
                </el-form-item>

                <el-form-item label="" :label-width="formLabelWidth" prop="medical_specialties_en">
                    اسم التخصص بالانجليزية
                    <el-input v-model="formInline.medical_specialties_en" auto-complete="on"></el-input>
                </el-form-item>

                <el-button @click="resetForm('formInline'),dialogFormVisible = false">الغاء</el-button>
                <el-button type="primary" @click="updateSpecialist(formInline)">حفظ</el-button>

            </el-form>

        </el-dialog>




    </div>
</div>

@include('layout.footer')
<script src={{asset("js/addspecialists.js")}}></script>
<?php
}
?>