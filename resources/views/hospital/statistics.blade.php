<?php
session()->regenerate();
if(Session('id')==null){
        echo "ليس لديك الصلاحيات للدخول على تلك الصفحة";
}else{
?>

@include('layout.head')
@include('hospital.barsHospital')

<script src="//unpkg.com/vue/dist/vue.js"></script>
<script src="//unpkg.com/element-ui@2.4.2/lib/index.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<div id="page-wrapper">
    <h1 class="text-center"></h1>
    <input type="hidden" id="idele" value="{{ Session::get('id') }}" >
    <div id="app">
        <el-form :inline="true" :model="formInline" class="demo-form-inline">
            <el-form-item label="الإسم">
                <el-input v-model="formInline.name" placeholder="الإسم"></el-input>
            </el-form-item>

            <el-form-item label="التخصصات">
                <el-select
                        v-model="formInline.specialists"
                        filterable
                        placeholder="اختار التخصص"
                >
                    <el-option
                            v-for="lists in specialisits"
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
                    style="width: 70%"
                    :row-class-name="tableRowClassName" >
                <el-table-column
                        prop="name"
                        label="الإسم"
                >
                </el-table-column>
                <el-table-column
                        prop="visita"
                        label="السعر"
                >
                </el-table-column>
                <el-table-column
                        prop="medical_specialties_ar"
                        label="التخصص الطبي">
                </el-table-column>
                <el-table-column
                        prop="specialization"
                        label="التخصص">
                </el-table-column>
                <el-table-column
                        prop="rate"
                        label="التقييم">
                </el-table-column>

                {{--<el-table-column>
                    <el-popover slot-scope="scope" slot-scope="scope" trigger="click" placement="top">


                            <img :src="'/' + scope.row.doctorstable.image"   style="max-height: 120px ; max-width:140px ;" class="img-rounded"/>
                        <div slot="reference" class="name-wrapper">
                            <el-tag size="medium">أعرض</el-tag>
                        </div>
                    </el-popover>
                </el-table-column>--}}


            </el-table>
        </div>
    </div>

</div>


<script src="//unpkg.com/vue/dist/vue.js"></script>
<script src="//unpkg.com/element-ui@2.4.2/lib/index.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@include('layout.footer')
<script src={{asset("js/hospitalpanel/hospitalStatistics.js")}}></script>
<?php
}
?>
