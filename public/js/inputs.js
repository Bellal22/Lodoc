Vue.prototype.$zone_id = ''

var Main = new Vue({
        el: '#app',
        data: {
            cities:'',
            rules: {
                zone_ar: [{required: true, message: 'ادخل الحي بالعربية'}],
                city_id: [{required: true, message: 'اختر اسم المدينة '}],

            },
            formLabelWidth: '',

            dialogTableVisible: false,
            dialogFormVisible: false,
            form:[],
            formInline: {
                zone_ar: '',
               zone_en: ''

            },

            customFilters: [{
                vals: '',
                props: ['zone_ar', 'city_id']
            }, {
                vals: []
            }],
            actionsDef:
                {
                    colProps: {
                        span: 8
                    }
                    ,
                    def: [{
                        name: 'new',
                        handler: function () {
                            this.$message("new clicked")
                        }

                    }]
                }
        },


    mounted: function () {
        var self = this;
        self.getzones();
        self.Getscites();
    }
    ,
    methods: {

        handleClose(done) {
            this.$confirm('Are you sure to close this dialog?')
                .then(_ => {
                    done();
                })
                .catch(_ => {});
        },

        tableRowClassName({row , rowIndex}) {
            if (rowIndex === 1) {
                return 'warning-row';
            } else if (rowIndex === 3) {
                return 'warning-row';
            }
            return '';
        },
        getzones: function () {
            var self = this;

            axios.get('/admin/zones')
                .then(function (response) {
                    self.form = response.data;
                    console.log(response.data);

                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        Getscites: function () {
            var self = this;

            axios.get('/admin/cities')
                .then(function (response) {
                    self.cities = response.data;
                    console.log(self.cities);

                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        resetForm: function (formName) {
            this.$refs[formName].resetFields();
        },


        Adddstrict: function (formName) {
            console.log(formName);
            var self = this;

            // exist = formName['city_en'].localeCompare(self.form['city_en']) ;
            //self.addCity(self.formInline);
            if (self.formInline['zone_ar'] != '' && self.formInline['zone_en'] != '') {
                console.log(self.formInline);

                self.InsertToServer(self.formInline);

            }
            else {
                console.log('error submit!!');
                alert ('برجاء ملئ البيانات');
            }

        },
        InsertToServer: function (formInline) {
            var self = this;
            console.log(formInline);
            axios.post('/admin/cities/add?lang=ar',formInline)
                .then(function (response) {
                    console.log(response.data);
                    if(response.data == 0){
                        alert('الحي بالعربية او الإنجليزية مسجل بالفعل');

                    }else {
                        Main.form.push(response.data);
                        self.$notify({
                            title: '    ',
                            message: 'تم الاضافه بنجاح',
                            type: 'success'
                        });
                        self.dialogFormVisible = false;

                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        update:function(row){

            var self = this;
            self.zone_id = row.zone_id ;
            self.dialogFormVisible =true ;

        },
        UpdateToserver: function (formInline) {

            var self = this;
            console.log(formInline);
            axios.post('/admin/cities/edit/'+ self.zone_id, self.formInline)
                .then(function (response) {
                    console.log(response.data);
                    self.getzones();
                    self.Getscites();
                    self.$notify({
                        title: '    ',
                        message: 'تم التعديل بنجاح',
                        type: 'success'
                    });
                    self.dialogFormVisible = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },


        DeleteFormServer: function (index, row) {

            var self = this;
            axios.delete('/admin/zone/delete/' + row.zone_id)
                .then(function (response) {
                    console.log(response.data);
                    self.loading = false;
                    self.$notify({
                        title: '    ',
                        message: 'تم الحذف بنجاح',
                        type: 'success'
                    });
                    Main.form.splice(index, 1);
                    self.dialogFormVisible = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

    }



})
;













