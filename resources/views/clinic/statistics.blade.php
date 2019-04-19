<?php
session()->regenerate();
if(Session('id')==null){
        echo "ليس لديك الصلاحيات للدخول على تلك الصفحة";
}else{
?>

@include('layout.head')
@include('clinic.barsClinic')

<script src="//unpkg.com/vue/dist/vue.js"></script>
<script src="//unpkg.com/element-ui@2.4.2/lib/index.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<div id="page-wrapper">
    <h1 class="text-center"></h1>
    <div id="app">
        <input type="hidden" id="idele" value="{{ Session::get('id') }}">
        
        <el-form :inline="true" :model="formInline" class="demo-form-inline">
            <el-form-item label="الإسم">
                <el-input v-model="formInline.name" placeholder="الإسم"></el-input>
            </el-form-item>
            <el-form-item label="المواعيد">
                <el-select v-model="formInline.week_id" placeholder="الأيام">
                    <el-option v-for="week in weeks"
                               :key="week.week_id"
                               :value="week.week_id"
                               :label="week.day_ar">
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
                    :row-class-name="tableRowClassName">
                <el-table-column
                        prop="patient_name"
                        label="الإسم"
                >
                </el-table-column>

                <el-table-column
                        prop="mobile"
                        label="الهاتف">
                </el-table-column>
                <el-table-column
                        prop="day_ar"
                        label="ميعاد الحجز">
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
<script src={{asset("js/clinicpanel/clinicStatistics.js")}}></script>
<?php
}
?>