<?php
session()->regenerate();
if(Session('id')==null){
        echo "ليس لديك الصلاحيات للدخول على تلك الصفحة";
}else{
?>

@include('layout.head')
@include('hospital.barsHospital')
<link href={{asset("css/clinicpanel.css")}} rel="stylesheet">

<div id="page-wrapper">
    <div id="app" >
        <input type="hidden" id="idele" value="{{ Session::get('id') }}" >
        <div class="container Info">
            <el-form :inline="true" :model="formInline" class="demo-form-inline">
                <el-form-item label="اختار الفرع">
                <el-select  v-model="formInline.branch_id" placeholder="اختر الفرع" >
                    <el-option v-for="branch in Branchs"
                               :key="branch.branch_id"
                               :value="branch.branch_id"
                               :label="branch.branch_name">

                    </el-option>
                </el-select>
                </el-form-item>
                <el-form-item label="اختار المدينة">
                    <el-select v-model="formInline.city_id" placeholder="احدي الأحياء" v-on:change="onChange" >
                        <el-option v-for="city in City"
                                   :key="city.city_id"
                                   :value="city.city_id"
                                   :label="city.city_ar">

                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="اختار الحي">
                    <el-select v-model="formInline.zone_id" placeholder="احدي الأحياء">
                        <el-option v-for="zone in list"
                                   :key="zone.zone_id"
                                   :value="zone.zone_id"
                                   :label="zone.zone_ar">
                        </el-option>
                    </el-select>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" size="medium" @click="UpdateRegion('formInline')" round>تحديث</el-button>
                </el-form-item>


            </el-form>

        </div>
    </div>
</div>
@include('layout.footer')
<script src={{asset("js/hospitalpanel/hospiatlpaneledit.js")}}></script>
<?php
}
?>