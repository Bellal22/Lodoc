ELEMENT.locale(ELEMENT.lang.en);

Vue.prototype.$city_id = ''

var main = new Vue({
    el: '#app',
    data: {
        form: [],
        dialogTableVisible: false,
        dialogFormVisible: false,
        formInline: {
            city_ar: '',
            city_en: ''

        },
        rules: {
            city_ar: [{required: true, message: 'ادخل المدينة بالعربية'}],
            city_id: [{required: true, message: 'اختر اسم المدينة '}],

        },
        formLabelWidth: '',

        customFilters: [{
            vals: '',
            props: ['city_ar', 'city_id']
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
                        this.$message("new clicked");
                    }

                }]
            }
    },
    mounted: function () {
        var self = this;
        self.auth(); 
        self.GetContact();
    },
    methods: {
        auth : function(){
            var check = document.getElementById('idele').value;
            if(!check){
                throw new Error("Something went badly wrong!");
            }
        },
        handleClose(done) {
            this.$confirm('Are you sure to close this dialog?')
                .then(_ => {
                done();
        }).catch(_ => {});
        },

        tableRowClassName({row , rowIndex}) {
            if (rowIndex === 1) {
                return 'warning-row';
            } else if (rowIndex === 3) {
                return 'warning-row';
            }
            return '';
        },
        Adddstrict: function (formName) {
            console.log(formName);
            var self = this;

                // exist = formName['city_en'].localeCompare(self.form['city_en']) ;
            //self.addCity(self.formInline);
                if (self.formInline['city_en'] != '' && self.formInline['city_ar'] != '') {
                    console.log(self.formInline);

                    self.addCity(self.formInline);

                }
                else {
                    console.log('error submit!!');
                    alert ('برجاء ملئ البيانات');
                }

        }, GetContact: function () {
            var self = this;
            axios.get('/requestCities?lang=ar')
                .then(function (response) {
                    console.log(response.data);
                    self.form = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        addCity: function (formInline) {
            var self = this;
            console.log(formInline);
            axios.post('/cities/add?lang=ar', formInline)
                .then(function (response) {
                    console.log(response.data);
                    if(response.data == 0){
                        alert('المدينة بالعربية او الإنجليزية مسجلة بالفعل');

                    }else {
                        main.form.push(response.data);
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
        deleteCity: function (index, row) {

            var self = this;
            axios.delete('/cities/delete/' + row.city_id)
                .then(function (response) {
                    console.log(response.data);
                    self.loading = false;
                    self.$notify({
                        title: '    ',
                        message: 'تم الحذف بنجاح',
                        type: 'success'
                    });
                    main.form.splice(index, 1);
                    self.dialogFormVisible = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },resetForm: function (formName) {
            this.$refs[formName].resetFields();
        },
        AddCountact: function (formName) {
            console.log(formName);
            var self = this;
            self.$refs[formName].validate(function (valid) {
                if (valid) {
                    console.log(self.form);
                    if (self.form.city_id === undefined) {
                        self.updateCity(self.form)

                    } else {
                        self.updateCity(self.form);
                    }

                } else {
                    console.log('error submit!!');
                }
            })
        },
        update:function(row){

            var self = this;
            self.city_id = row.city_id ;
            self.dialogFormVisible =true ;

        },
        updateCity: function (formInline) {

            var self = this;

            axios.post('/cities/edit/'+self.city_id,self.formInline)
                .then(function (response) {
                    console.log(response.data);
                    self.loading = false;
                    self.GetContact();
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
        }

    }


})
