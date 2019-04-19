ELEMENT.locale(ELEMENT.lang.en);

Vue.prototype.$medical_specialties_id = ''

var main = new Vue({
    el: '#app',
    data: {
        form: [],
        dialogTableVisible: false,
        dialogFormVisible: false,
        formInline : {
            medical_specialties_ar : '' ,
            medical_specialties_en : ''

        },
        rules: {
            city_ar: [{required: true, message: 'ادخل التخصص بالعربية'}],

        },
        formLabelWidth: '',

        customFilters: [{
            vals: '',
            props: ['medical_specialties_ar', 'medical_specialties_id']
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

        tableRowClassName({row, rowIndex}) {
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
            if (self.formInline['medical_specialties_ar'] != '' && self.formInline['medical_specialties_ar'] != '') {
                console.log(self.formInline);

                self.addSpecialist(self.formInline);

            }
            else {
                console.log('error submit!!');
                alert ('برجاء ملئ البيانات');
            }

        }, GetContact: function () {
            var self = this;
            axios.get('/requestSpecialist?lang=ar')
                .then(function (response) {
                    console.log(response.data);
                    self.form = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        addSpecialist: function (formInline) {
            var self = this;
            console.log(formInline);
            axios.post('/Specialist/add?lang=ar', formInline)
                .then(function (response) {
                    console.log(response.data);
                    if(response.data == 0){
                        alert('التخصص بالعربية او الإنجليزية مسجل بالفعل');

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
        deleteSpecialist: function (index, row) {

            var self = this;
            axios.delete('/Specialist/delete/' + row.medical_specialties_id)
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
        }, resetForm: function (formName) {
            this.$refs[formName].resetFields();
        },update:function(row){

            var self = this;
            self.medical_specialties_id = row.medical_specialties_id ;
            self.dialogFormVisible =true ;

        },
                                        /*AddCountact: function (formName) {
                                            console.log(formName);
                                            var self = this;
                                            self.$refs[formName].validate(function (valid) {
                                                if (valid) {
                                                    console.log(self.form);
                                                    if (self.form.row.medical_specialties_id === undefined) {
                                                        self.updateSpecialist(self.form)

                                                    } else {
                                                        self.updateSpecialist(self.form);
                                                    }

                                                } else {
                                                    console.log('error submit!!');
                                                }
                                            })
                                        },*/
        updateSpecialist: function (formInline) {
            var self = this;

            axios.post('/Specialist/edit/'+self.medical_specialties_id , formInline)
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
