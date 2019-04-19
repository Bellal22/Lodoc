<?php
session()->regenerate();
if(Session('id')==null){
        echo "ليس لديك الصلاحيات للدخول على تلك الصفحة";
}else{
?>
@include('layout.head')
@include('admin.barsAdmin')
<link href={{asset("css/adminpanel-2.css")}} rel="stylesheet">
<div id="page-wrapper">
    <div id="app" >
    <input type="hidden" id="idele" value="{{ Session::get('id') }}" >
    <el-row>
  <el-col :span="8" 
  v-for="ad in lastAds"
  :key="ad.ad_id"
  >
    <el-card :body-style="{ padding: '0px' }">
    <img :src="'/'+ad.ad_image" style="max-height: 200px ; max-width:800px  " class="img-thumbnail"/>
      <div style="padding: 14px;">
        <div class="bottom clearfix">
        <p class="h4"> بداية الموعد <span style="color:red"> @{{ad.from_date}}</span></p>
          <p class="h4"> نهاية الموعد  <span style="color:red"> @{{ad.to_date}}</span></p>
          <?php
          if(Session('per30') != null){
          ?>
          <el-button @click="handleActivation(ad.ad_id)"
                    :type="ad.pending === 1 ? 'danger' : 'primary'" round>
                    <p v-if="ad.pending === 1"><b>تعطيل</b></p>
                    <p v-else><b>تفعيل</b></p>
                    </el-button>
                    <?php
          }  if(Session('per32') != null){
                    ?>
          <el-button @click="ShowdialogVisible(ad.ad_id)" type="warning" icon="el-icon-edit" circle>
          </el-button>
          <?php 
          }
          ?>
          <el-dialog
            title="تعديل موعد انتهاء الإعلان"
            :visible.sync="dialogVisible"
            width="30%"
            :before-close="handleClose">
            <el-date-picker
            v-model="to_date"
            type="date"
            placeholder="اختر موعد"
            default-value="2019-01-01">
            </el-date-picker>
            <el-button type="primary" @click="updateTime()">تم التعديل</el-button>
            </el-dialog>

        </div>
      </div>
    </el-card>
  </el-col>
</el-row>

    </div>
</div>
<script src="//unpkg.com/element-ui/lib/umd/locale/en.js"></script>


@include('layout.footer')
<script src={{asset("js/adminpanel-ads.js")}}></script>
<?php
}
?>