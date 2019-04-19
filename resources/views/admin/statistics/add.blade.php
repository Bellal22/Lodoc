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
        <el-form :inline="true" :model="formInline" :rules="rules" ref="formInline" class="demo-form-inline">
            <el-form-item label="اسم الحي بالعربية">
                <el-input v-model="formInline.zone_ar" placeholder="اسم الحي بالعربية"></el-input>
            </el-form-item>
            <el-form-item label="اسم الحي بالأنجليزيه">
                <el-input v-model="formInline.zone_en" placeholder="اسم الحي بالانجليزية"></el-input>
            </el-form-item>
            <el-form-item label="المدينة">
                <el-select
                        v-model="formInline.city_id"
                        filterable
                        placeholder="اختار المدينة "
                >
                    <el-option
                            v-for="lists in cities"
                            :key="lists.city_id"
                            :value="lists.city_id"
                            :label="lists.city_ar">
                    </el-option>

                </el-select>
            </el-form-item>
                <el-button type="primary" @click="Adddstrict('formInline')">أضف</el-button>
            </el-form-item>
        </el-form>



        <div class="block">
            <template slot-scope="scope">

                <el-button
                        class="el-icon-edit"
                        size="medium"
                        type="warning"
                        @click="GotoAddNewServices(scope.$index,scope.row,dialogFormVisible = true,true)">
                    &nbsp;&nbsp;
                    تعديل
                </el-button>
            </template>
            <el-table
                    :data="form"
                    style="width: 88%"
                    :row-class-name="tableRowClassName" >
                <el-table-column
                        prop="zone_ar"
                        label="الحي باللفة العربية"
                >
                </el-table-column>
                <el-table-column
                        prop="zone_en"
                        label="الحي باللغة الانجليزي"
                >
                </el-table-column>
                <el-table-column
                        prop="city_ar"
                        label="المدينة باللغة العربية">
                </el-table-column>
                <el-table-column
                        prop="city_en"
                        label="المدينة باللغة الانجليزية">
                </el-table-column>


             <?php
if (Session('per14') != null) {
    ?>
                <el-table-column label="">
                    <template slot-scope="scope">
                    
                        <el-button
                                class="el-icon-delete"
                                size="medium"
                                type="danger"
                                @click="DeleteFormServer(scope.$index, scope.row)">
                            &nbsp;&nbsp;
                            حذف
                        </el-button>
                    </template>
                </el-table-column>
<?php
}
 if(Session('per12') != null){
?>

                <el-table-column label="">
                    <template slot-scope="scope">
                        <el-button
                                class="el-icon-edit"
                                size="medium"
                                type="primary"
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

                <el-form-item label="" :label-width="formLabelWidth" prop="zone_ar">
                   اسم الحي بالعربية
                    <el-input v-model="formInline.zone_ar" auto-complete="on"></el-input>
                </el-form-item>

                <el-form-item label="" :label-width="formLabelWidth" prop="zone_en">
                    اسم الحي بالانجليزية
                    <el-input v-model="formInline.zone_en" auto-complete="on"></el-input>
                </el-form-item>


            </el-form>
           
            <span slot="footer" class="dialog-footer">
    <el-button @click="resetForm('formInline'),dialogFormVisible = false">الغاء</el-button>
    <el-button type="primary" @click="UpdateToserver(formInline)">حفظ</el-button>
  </span>

        </el-dialog>




        </div>
    </div>

    @include('layout.footer')
<script src={{asset("js/inputs.js")}}></script>
<?php

}
?>