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
        <div class="text-center doctorInfo">
            <input type="hidden" id="idele" value="{{ Session::get('id') }}" >
            <ul class="list-group list-group-flush" v-for="data in formData">
            <img :src="'/'+data.image" style="max-height: 200px ; max-width:200px ; margin-bottom : 30px; " class="img-thumbnail"/>
            <li class="list-group-item h4"><span class="infoLabel">الإسم :</span>@{{data.name}} </li>
                <li class="list-group-item h4"><span class="infoLabel">البريد الإلكتروني :</span>@{{data.mail}}</li>
                <li class="list-group-item h4"><span class="infoLabel">رقم الهاتف :</span>@{{data.phone}}</li>
                <li class="list-group-item h4"><span class="infoLabel"> السجل التجاري :</span>@{{data.register}}</li>
            </ul>
        </div>



        <div class="text-centre">
            <el-table
                    :data="tableData"
                    style="width: 100%">

                <el-table-column
                        prop="patient_name"
                        label="الإسم"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="mobile"
                        label="رقم التليفون"
                        width="180">
                </el-table-column>

                <el-table-column
                        
                        label="التأمين الصحي"
                        width="180"
                        >
                        <el-popover slot-scope="scope" slot-scope="scope" trigger="click" placement="top">  
                        <img :src="'/' + scope.row.health_insurance_pic" style="width:200px; height:200px;" class="img-rounded"/>
                        <div slot="reference" class="name-wrapper">
                        
                        <el-tag size="medium">أعرض</el-tag>
                        </div>
                        </el-popover>
                </el-table-column>

                <el-table-column
                        prop="day_ar"
                        label="ميعاد الحجز"
                        width="180">
                </el-table-column>


            </el-table>
        </div>
    </div>
</div>


@include('layout.footer')
<script src={{asset("js/clinicpanel/clinicpanel.js")}}></script>
<?php
}
?>