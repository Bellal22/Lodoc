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
            <el-table :data="tableData" style="width: 90%">
                <el-table-column prop="created_at" label="تاريخ التسجيل" sortable width="140" :filters="[{text: '2018-07-02', value: '2018-07-02'}, {text: '2016-05-02', value: '2016-05-02'}, {text: '2016-05-03', value: '2016-05-03'}, {text: '2016-05-04', value: '2016-05-04'}]" :filter-method="filterHandler">
                </el-table-column>
                <el-table-column prop="name" label="الأسم" width="180">
                </el-table-column>
                <el-table-column prop="address" label="العنوان" width="120">
                </el-table-column>
                <el-table-column
                        label="صورة"
                        width="90">
                        <el-popover slot-scope="scope" slot-scope="scope" trigger="click" placement="top">  
                        <img :src="'/' + scope.row.image" style="width:200px; height:200px;" class="img-rounded"/>
                        <div slot="reference" class="name-wrapper">
                        <el-tag size="medium">أعرض</el-tag>
                        </div>
                        </el-popover>
                </el-table-column>
                <el-table-column prop="phone" label="ارقام الهاتف" width="150">
                </el-table-column>

                <el-table-column prop="type"
                                 label="الفئة"
                                 width="130"
                                 :filters="[{ text: 'مستشفيات', value: 3 }, { text: 'عيادات', value: 2 },{ text: 'مستخدمين', value: 1 }]"
                                 :filter-method="filterTag"
                                 filter-placement="bottom-end">
                    {{--@{{if(scope.row.type=== 1){return 'مستخدم';}elseif(scope.row.type===2){return 'عيادة';}else{return 'مستشفي';})}}--}}
                    {{--@{{scope.row.type}}--}}

                        <el-tag   slot-scope="scope" :type="scope.row.type === 3 ? 'warning' : 'primary'" disable-transitions>@{{convertType(scope.row.type)}}</el-tag>



                </el-table-column>
                <?php
                               
                               if(Session('per1')!=null){
                                ?>

                <el-table-column
                        label="العمليات">
                        

                        <el-button
                            slot-scope="scope"
                            size="mini"
                            @click="handleActivation( scope.row)"
                            :type="scope.row.state === 1 ? 'danger' : 'primary'"
                    >

                        <p v-if="scope.row.state === 1"><b>تعطيل</b></p>
                        <p v-else><b>تفعيل</b></p>

                    </el-button>
                        <?php
                               } else{
                                  
                               }
                        ?>
                </el-table-column>
            </el-table>


    </div>
</div>
<script src="//unpkg.com/element-ui/lib/umd/locale/en.js"></script>


@include('layout.footer')
<script src={{asset("js/adminpanel-2.js")}}></script>
<?php
}
?>