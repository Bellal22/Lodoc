
@include('layout.bars')
    <div id="page-wrapper">
{{--@section('pageBody')--}}
        <h1 class="text-center"></h1>
        <div id="app">
            <div class=" card inputMdify" style="margin-top: 15px; padding-top: 40px;">
                <el-input placeholder="اسم الطبيب" v-model="input5" class="input-with-select">
                    <el-select v-model="select" slot="prepend" placeholder="التخصص">
                        <el-option label="عيون" value="1"></el-option>
                        <el-option label="اسنان" value="2"></el-option>
                        <el-option label="بطنه" value="3"></el-option>
                    </el-select>

                </el-input>
            </div>
            <div class="block">
                <span class="demonstration"></span>
                <el-date-picker
                        v-model="date"
                        type="date"
                        placeholder="Pick a date"
                        default-value="2018-10-01">
                </el-date-picker>
            </div>

            <div class="block">
                <el-table
                        :data="tableData2"
                        style="width: 88%"
                        :row-class-name="tableRowClassName">
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
                            prop="specialist"
                            label="التخصص">
                    </el-table-column>
                    <el-table-column
                            prop="phone"
                            label="الهاتف">
                    </el-table-column>
                    <el-table-column
                            prop="savehealth"
                            label="التأمين الصحي">
                    </el-table-column>


                </el-table>
            </div>

        </div>

    </div>
{{--@endsection--}}
</div>
<script src="//unpkg.com/vue/dist/vue.js"></script>
<script src="//unpkg.com/element-ui@2.4.2/lib/index.js"></script>
