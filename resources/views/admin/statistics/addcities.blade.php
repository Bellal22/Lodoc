<?php
session()->regenerate();
if (Session('id') == null) {
    echo "ليس لديك الصلاحيات للدخول على تلك الصفحة";
} else {
    ?>
@include('layout.head')
@include('admin.barsAdmin')
<div id="page-wrapper">
    <h1 class="text-center"></h1>
    <div id="app">
    <input type="hidden" id="idele" value="{{ Session::get('id') }}" >
        <el-form :inline="true" :model="formInline" :rules="rules" ref="formInline" class="demo-form-inline">
            <el-form-item label="اسم المدينة بالعربية">
                <el-input v-model="formInline.city_ar" placeholder="اسم المدينة بالعربية"></el-input>
            </el-form-item>
            <el-form-item label="اسم المدينة بالأنجليزيه">
                <el-input v-model="formInline.city_en" placeholder="اسم المدينة بالانجليزية"></el-input>
            </el-form-item>


            <el-button type="primary" @click="Adddstrict('formInline')">أضف</el-button>
            </el-form-item>
        </el-form>



        <div class="block">

            <el-table
                    :data="form"
                    style="width: 88%"
                    :row-class-name="tableRowClassName" >
                <el-table-column
                        prop="city_ar"
                        label="المدينة باللغة العربية"
                >
                </el-table-column>
                <el-table-column
                        prop="city_en"
                        label="المدينة باللغة الانجليزي"
                >
                </el-table-column>


           <?php
if (Session('per9') != null) {
    ?>

                <el-table-column label="">
                    <template slot-scope="scope">
                        <el-button
                                class="el-icon-delete"
                                size="medium"
                                type="danger"
                                @click="deleteCity(scope.$index, scope.row)">
                            &nbsp;&nbsp;
                            حذف
                        </el-button>
                    </template>
                </el-table-column>
<?php
} 
if(Session('per10') != null){
?>
                <el-table-column label="">
                    <template slot-scope="scope">
                        <el-button
                                class="el-icon-edit"
                                size="medium"
                                type="warning"
                                @click="update(scope.row)">
                            &nbsp;&nbsp;
                            تعديل
                        </el-button>
                    </template>

                </el-table-column>
<?php
} 
else{
    
}
?>

            </el-table>
        </div>

        <el-dialog title="تعديل البيانات" class="dir" :visible.sync="dialogFormVisible">
            <el-form :model="formInline" :rules="rules" ref="formInline" label-width="120px"
                     class="demo-ruleForm">

                <el-form-item label="" :label-width="formLabelWidth" prop="city_ar">
                    اسم المدينة بالعربية
                    <el-input v-model="formInline.city_ar" auto-complete="on"></el-input>
                </el-form-item>

                <el-form-item label="" :label-width="formLabelWidth" prop="city_en">
                    اسم المدينة بالانجليزية
                    <el-input v-model="formInline.city_en" auto-complete="on"></el-input>
                </el-form-item>
                  <?php
                    if (Session('per9') != null) {
                        ?>
                <el-button @click="resetForm('formInline'),dialogFormVisible = false">الغاء</el-button>
<?php
                    }else if(Session('per11')!=null){
?>
                <el-button type="primary" @click="updateCity(formInline)">حفظ</el-button>
<?php
                    }else{

                        
                    }
?>
            </el-form>

        </el-dialog>




    </div>
</div>

@include('layout.footer')
<script src={{asset("js/addCty.js")}}></script>
<?php

}
?>