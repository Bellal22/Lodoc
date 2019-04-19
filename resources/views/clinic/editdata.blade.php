<?php
session()->regenerate();
if(Session('id')==null){
        echo "ليس لديك الصلاحيات للدخول على تلك الصفحة";
}else{
?>

@include('layout.head')
@include('clinic.barsClinic')
<link href={{asset("css/clinicpanel.css")}} rel="stylesheet">

<div id="page-wrapper">
    <div id="app" >
        <input type="hidden" id="idele" value="{{ Session::get('id') }}" >
        <div class="container Info">

        <div class="container text-center">
            <h1 class="lead display-1" style="color:#1E90FF ; ">تعديل الموقع</h1>
            <el-form :inline="true" :model="formInline" class="demo-form-inline">
                <el-form-item label="اختار المدينة">
                    <el-select v-model="formInline.city_id" placeholder="احدي المدن" v-on:change="onChange" >
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
        <div class="container text-center">
            <h1 class="lead display-1" style="color:#1E90FF ; ">تعديل المواعيد</h1>
        <el-form :inline="true" :model="dateForm" class="demo-form-inline" >
            <el-form-item label="اليوم">
                <el-select v-model="dateForm.week_id" placeholder="الأيام">
                    <el-option v-for="week in weeks"
                               :key="week.week_id"
                               :value="week.week_id"
                               :label="week.day_ar">
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="المعاد">
                        <el-time-picker
                                arrow-control
                                v-model="dateForm.from_hr"
                                :picker-options="{
                                              selectableRange: '00:00:00 - 23:00:00'
                                            }"
                                placeholder="بداية الموعد">
                        </el-time-picker>
                        <el-time-picker
                                arrow-control
                                v-model="dateForm.to_hr"
                                :picker-options="{
                                              selectableRange: '00:00:00 - 23:00:00'
                                            }"
                                placeholder="نهاية الموعد">
                        </el-time-picker>
                    </el-form-item>

            
            <el-button class="bottom" type="primary" size="mini" @click="UpdateDate('dateForm')">تحديث</el-button>
        </el-form>
        </div>
        <div class="container text-center">
            <h1 class="lead display-1" style="color:#1E90FF ; ">مسح موعد</h1>
            <el-form :inline="true" :model="dateForm" class="demo-form-inline" >
            <el-form-item label="اليوم">
                <el-select v-model="deleteWeek.week_id" placeholder="الأيام">
                    <el-option v-for="week in weeks"
                               :key="week.week_id"
                               :value="week.week_id"
                               :label="week.day_ar">
                    </el-option>
                </el-select>
            </el-form-item>
            <el-button class="bottom" type="danger" size="mini" @click="deleteDate('deleteWeek')">مسح</el-button>
        </el-form>
        </div>

        <div class="container text-center">
            <h1 class="lead display-1" style="color:#1E90FF ; ">تعديل موعد الإنتظار</h1>
        <el-form :inline="true" ref="form" :model="WaitingTime" class="demo-form-inline">
            <el-form-item
                    label="موعد الإنتظار"
                    >
                <el-input v-model="WaitingTime.wating" auto-complete="off" ></el-input>
            </el-form-item>
            <el-button type="primary" size="medium" @click="UpdateWaiting" round>تحديث</el-button>
        </el-form>
        </div>

        <div class="container text-center">
            <h1 class="lead display-1" style="color:#1E90FF ; ">تعديل رقم الهاتف</h1>
        <el-form :inline="true" ref="form" :model="number" class="demo-form-inline">
            <el-form-item
                    label="رقم الهاتف"
                    >
                <el-input v-model="number.phone" auto-complete="off" ></el-input>
            </el-form-item>
            <el-button type="primary" size="medium" @click="UpdatePhone('number')" round>تحديث</el-button>
        </el-form>
        </div>
        </div>
    </div>
</div>
@include('layout.footer')
<script src={{asset("js/clinicpanel/clinicpaneledit.js")}}></script>
<?php
}
?>