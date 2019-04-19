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
        <div class="doctorInfo">
            <input type="hidden" id="idele" value="{{ Session::get('id') }}" >
            <ul class="list-group list-group-flush" v-for="data in formDatahospitl"  >
                <li class="h1 list-group-item" style="color: #1f648b ">بيانات المستشفي</li>
                <li class="list-group-item h4"><span class="infoLabel">الإسم :</span>@{{data.name}} </li>
                <li class="list-group-item h4"><span class="infoLabel">البريد الإلكتروني :</span>@{{data.mail}}</li>
                <li class="list-group-item h4"><span class="infoLabel">رقم الهاتف :</span>@{{data.phone}}</li>
                <li class="list-group-item h4"><span class="infoLabel"> السجل التجاري :</span>@{{data.register}}</li>
                <i @click="AddData(data.hospital_id)" class="fa fa-plus-square fa-4x" aria-hidden="true"></i>
            </ul>
            <el-dialog

                    :visible.sync="dialogVisibleDoctor"
                    width="50%"
                    {{--:before-close="handleClose"--}}
            >
                <el-form :inline="true"  class="demo-form-inline" >
                    <el-form-item label="إسم الدكتور" prop="name">
                        <el-input v-model="DoctorForm.name"></el-input>
                    </el-form-item>
                    <el-form-item label="اختر الفرع" prop="branch_id">
                        <el-select v-model="DoctorForm.branch_id" placeholder="الفرع التابع له الدكتور">
                            <el-option
                                    value="0"
                                    label="لا يوجد فروع">

                            </el-option>
                            <el-option v-for="branch in formDataBranch"
                                       :key="branch.branch_id"
                                       :value="branch.branch_id"
                                       :label="branch.branch_name">

                            </el-option>
                        </el-select>

                        <el-select v-model="DoctorForm.city_id" placeholder="المدينة">
                            <el-option v-for="city in Region"
                                       :key="city.city_id"
                                       :value="city.city_id"
                                       :label="city.city_ar">

                            </el-option>
                        </el-select>
                        <el-select v-model="DoctorForm.zone_id" placeholder="الحي">
                            <el-option v-for="zone in Region"
                                       :key="zone.zone_id"
                                       :value="zone.zone_id"
                                       :label="zone.zone_ar">

                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="سعر الحجز" prop="visita">
                        <el-input v-model="DoctorForm.visita"></el-input>
                    </el-form-item>
                    <el-form-item label="مدة الإنتظار" prop="wating">
                        <el-input v-model="DoctorForm.wating"></el-input>
                    </el-form-item>
                    <el-form-item label="التخصص" prop="specialization">
                        <el-input v-model="DoctorForm.specialization"></el-input>
                    </el-form-item>
                    <el-form-item label="التخصص الطبي">
                        <el-select v-model="DoctorForm.medical_specialties_id" placeholder="التخصصات">
                            <el-option v-for="special in specialisits"
                                       :key="special.medical_specialties_id"
                                       :value="special.medical_specialties_id"
                                       :label="special.medical_specialties_ar">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="اليوم">
                        <el-select v-model="DoctorForm.week_id" placeholder="الأيام">
                            <el-option v-for="week in weeks"
                                       :key="week.week_id"
                                       :value="week.week_id"
                                       :label="week.day_ar">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item label="اليوم">
                        <el-time-picker
                                arrow-control
                                v-model="DoctorForm.from_hr"
                                :picker-options="{
                                              selectableRange: '00:00:00 - 23:00:00'
                                            }"
                                placeholder="بداية الموعد">
                        </el-time-picker>
                        <el-time-picker
                                arrow-control
                                v-model="DoctorForm.to_hr"
                                :picker-options="{
                                              selectableRange: '00:00:00 - 23:00:00'
                                            }"
                                placeholder="نهاية الموعد">
                        </el-time-picker>
                    </el-form-item>
                    <el-form-item>
                        <input @change="readFile()"  type="file" name="img_src" id="img">
                    </el-form-item>
                    <br>
                    <el-form-item>
                        <el-button type="primary" @click="AddDoctor()">تأكيد</el-button>
                        <el-button @click="dialogVisibleDoctor = false">إغلاق</el-button>
                    </el-form-item>
                </el-form>


            </el-dialog>








        </div>
        <el-select  v-model="formInline.branch_id" placeholder="اختر الفرع" v-on:change="GetDoctor" >
            <el-option
                       value="0"
                       label="لا يوجد فروع">

            </el-option>
            <el-option v-for="branch in formDataBranch"
                       :key="branch.branch_id"
                       :value="branch.branch_id"
                       :label="branch.branch_name">

            </el-option>
        </el-select>

        <el-row :gutter="20">
            <el-col :span="6" v-for="inf in formDataDoctor" :key="inf.hospital_id">
                <div class="grid-content bg-purple text-center" >
                    <el-card class="box-card">
                        <div   class="text item  ">
                            <img :src="'/'+inf.image" style="max-height: 120px ; max-width:140px ;" class="img-rounded"/>
                            <p class="h4">@{{inf.name}}</p>
                            <p class="h4">@{{inf.specialization}}</p>
                            <p class="h4">@{{inf.visita}} ريال </p>
                             <el-button type="text" @click="dialogVisible = true"><p class="h4">تحديد مواعيد</p></el-button>

                            <el-dialog
                                    title="خصص مواعيد"
                                    :visible.sync="dialogVisible"
                                    width="50%"
                                    {{--:before-close="handleClose"--}}
                            >



                                <el-form :inline="true"  class="demo-form-inline" >
                                    <el-form-item label="اليوم">
                                        <el-select v-model="dateForm.week_id" placeholder="الأيام">
                                            <el-option v-for="week in weeks"
                                                       :key="week.week_id"
                                                       :value="week.week_id"
                                                       :label="week.day_ar">
                                            </el-option>
                                        </el-select>
                                    </el-form-item>

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



                                    <el-button class="bottom" @click="UpdateToserver('dateForm',inf.doctors_id)" type="primary" size="mini" >تحديث</el-button>
                                </el-form>

                                    <span slot="footer" class="dialog-footer">

                                    <el-button @click="dialogVisible = false">انهاء</el-button>
                                  </span>
                            </el-dialog>


                            <br>
                            <br>

                            <el-button type="danger" size="small" @click="deleteDoctor(inf.doctors_id)" round>مسح</el-button>

                        </div>
                    </el-card>
                </div>
            </el-col>
        </el-row>


    </div>
</div>
@include('layout.footer')
<script src={{asset("js/hospitalpanel/hospitalpanel.js")}}></script>
<?php
}
?>