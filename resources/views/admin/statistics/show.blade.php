<?php
session()->regenerate();
if(Session('id')==null){
        echo "ليس لديك الصلاحيات للدخول على تلك الصفحة";
}else{
?>
@include('layout.head')
@include('admin.barsAdmin')

<script src="//unpkg.com/vue/dist/vue.js"></script>
<script src="//unpkg.com/element-ui@2.4.2/lib/index.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<div id="page-wrapper">
    <h1 class="text-center"></h1>
    <div id="app">
    <input type="hidden" id="idele" value="{{ Session::get('id') }}" >
        <el-form :inline="true" :model="formInline" class="demo-form-inline">
            <el-form-item label="الإسم">
                <el-input v-model="formInline.name" placeholder="الإسم بالكامل"></el-input>
            </el-form-item>

            <el-form-item label="التخصصات">
                <el-select
                        v-model="formInline.specialists"
                        filterable
                        placeholder="اختار التخصص"
                >
                    <el-option
                            v-for="lists in Special"
                            :key="lists.medical_specialties_id"
                            :value="lists.medical_specialties_id"
                            :label="lists.medical_specialties_ar">
                    </el-option>

                </el-select>
            </el-form-item>


            





            <el-form-item>
                <el-button type="primary" @click="onSubmit">بحث</el-button>
            </el-form-item>
        </el-form>


        <div class="block">
            <el-table
                    :data="doctorstable"
                    style="width: 88%"
                    :row-class-name="tableRowClassName" >
                <el-table-column
                        prop="name"
                        label="الإسم"
                >
                </el-table-column>
                <el-table-column
                        prop="address"
                        label="العنوان"
                >
                </el-table-column>
                <el-table-column
                        prop="medical_specialties_ar"
                        label="التخصص">
                </el-table-column>
                <el-table-column
                        prop="phone"
                        label="الهاتف">
                </el-table-column>
                <el-table-column
                        prop="from_hr"
                        label="ميعاد الحجز">
                </el-table-column>
                <el-table-column
                        prop="health_insurance_pic"
                        label="التامين الصحي">

                </el-table-column>


                <el-table-column>
                <el-popover slot-scope="scope" slot-scope="scope" trigger="click" placement="top">  
                        <img :src="'/' + scope.row.health_insurance_pic" style="width:200px; height:200px;" class="img-rounded"/>
                        <div slot="reference" class="name-wrapper">
                        <el-tag size="medium">أعرض</el-tag>
                        </div>
                        </el-popover>
                </el-table-column>


            </el-table>
        </div>
    </div>

</div>

</div>
</div>
<script src="//unpkg.com/vue/dist/vue.js"></script>
<script src="//unpkg.com/element-ui@2.4.2/lib/index.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@include('layout.footer')
<script src={{asset("js/adminpanel-statistics.js")}}></script>
<?php
}
?>