<?php
session()->regenerate();
if(Session('id')==null){
        echo "ليس لديك الصلاحيات للدخول على تلك الصفحة";
}else{
?>

@include('layout.head')
@include('clinic.barsClinic')
<link href={{asset("css/clinicpanel.css")}} rel="stylesheet">
<style>
    #page-wrapper{
        /* direction : ltr !important ;  */
    }
</style>
<div id="page-wrapper">
    <div id="app" >
    <input type="hidden" id="idele" value="{{ Session::get('id') }}" >
    <el-row :gutter="20">
    <el-form>
        <el-col :span="6"><div>
        <el-form-item>
        <el-button @click="sendForm()" style="margin-top : 42px" type="success">   رفع الإعلان     <i class="el-icon-upload el-icon-right"></i></el-button>
        </el-form-item>
        </div></el-col>
        <el-col :span="6"><div>
        <el-form-item>
        <span class="demonstration">نهاية الموعد</span>
            <el-date-picker
            v-model="form.to_date"
            type="date"
            placeholder="Pick a date"
            default-value="2019-01-01">
            </el-date-picker>

        </el-form-item>
        </div></el-col>
        <el-col :span="6"><div></div>
        <el-form-item>
        <span class="demonstration">بداية الموعد</span>
            <el-date-picker
            v-model="form.from_date"
            type="date"
            placeholder="Pick a date"
            default-value="2019-01-01">
            </el-date-picker>

        </el-form-item>
        </el-col>
        <el-col :span="6"><div>
        <el-form-item>
        <span class="demonstration">صورة الإعلان</span>
            <input @change="readFile()"  type="file" name="img_src" id="img">
        </el-form-item>
        </div></el-col>
        </el-form>
    </el-row>
    <hr>
    <el-row>
    <el-col :span="8"
    v-for="ad in lastAds"
    :key="ad.ad_id">
    <el-card :body-style="{ padding: '0px'}"
    >
    <img :src="'/'+ad.ad_image" style="max-height: 200px ; max-width:800px  " class="img-thumbnail"/>
      <div style="padding: 4px;">
        <div class="bottom clearfix">
          <p class="h4"> بداية الموعد <span style="color:red"> @{{ad.from_date}}</span></p>
          <p class="h4"> نهاية الموعد  <span style="color:red"> @{{ad.to_date}}</span></p>
        </div>
      </div>
    </el-card>
    </el-col>
    
    </div>
</div>
@include('layout.footer')
<script src={{asset("js/clinicpanel/clinicAds.js")}}></script>
<?php
}
?>