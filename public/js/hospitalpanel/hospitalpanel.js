ELEMENT.locale(ELEMENT.lang.en);

var main = new Vue({
    el: '#app',
    data: {
        formDatahospitl: [],
        formDataBranch: [],
        formDataDoctor: [],
        weeks: [],
        Region:[],
        specialisits:[],
        DoctorForm:{
            name:'',
            branch_id:'',
            visita:'',
            wating:'',
            image:'',
            from_hr: '',
            to_hr: '',
            week_id: '',
            specialization:'',
            medical_specialties_id:'',
            address : ''

        },
        rules: {
            name: [
                { required: true, message: 'من فضلك ادخل الإسم الثلاثي', trigger: 'blur' },
                { min: 3, max: 5, message: 'لا يمكن ان يكون اقل من 7 حروف', trigger: 'blur' }
            ],
            visita: [
                {  type: 'number', required: true, message: 'يجب ان تكون ارقام فقط', trigger: 'blur' }
            ],
            waiting: [
                { type: 'number', required: true, message: 'يجب ان تكون ارقام فقط', trigger: 'blur' }
            ]
        },

        dateForm: {
            from_hr: '',
            to_hr: '',
            week_id: ''
        },
        formInline: {
            branch_id: ''
        },
        dialogVisible: false,
        dialogVisibleDoctor:false,
        value2: '',
        value3: ''
    },
    mounted: function () {
        var self = this;
        self.GetContact();
        self.GetWeek();
        self.GetRegion() ;
        self.GetMedicalSpecialist();
    },
    methods: {

        GetContact: function () {

            var self = this;
            self.loading = true;
            var data = document.getElementById('idele').value;
            axios.get('/hospital/requestInfo/'+data+'?lang=ar')
                .then(function (response) {
                    console.log(response);
                    self.formDatahospitl = response.data;
                    console.log(self.formDatahospitl);
                    self.GetBranch(self.formDatahospitl[0].hospital_id);
                    self.loading = false
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        GetRegion:function(){
            var self = this;
            self.loading = true;

            axios.get('/hospital/requestInfo?lang=ar')
                .then(function (response) {
                    console.log(response);
                    self.Region = response.data;
                    console.log(self.Region);
                    self.loading = false
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        GetBranch: function (hospital_id) {
            var self = this;
            self.loading = true;
            axios.get('/hospital/requestInfoBranch/' + hospital_id + '?lang=ar')
                .then(function (response) {
                    console.log(response) ;
                    if(response.data != 0){
                        self.formDataBranch = response.data;
                        console.log(self.formDataBranch);
                    }else {
                        self.formDataBranch = response.data ;
                    }
                    self.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        GetDoctor: function () {
            var self = this;
            console.log(self.formDataDoctor);
            axios.get('/requestInfoHospitalDoctor/' + self.formInline.branch_id +'/'+self.formDatahospitl[0].hospital_id)
                .then(function (response) {
                    //console.log(response);
                    self.formDataDoctor = response.data;
                    console.log('before list');
                    console.log(self.formDataDoctor);
                    console.log('after list');
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        AddData: function(hospita_id){
          var self = this ;
          self.dialogVisibleDoctor = true;
        },
        AddDoctor: function(){
            var self = this ;
            
            self.DoctorForm.address = self.formDatahospitl[0].address;
            axios.post('/hospital/addDoctor/'+self.formDatahospitl[0].hospital_id,self.DoctorForm)
        .then(function (response) {
                console.log(response.data);
                self.loading = false;
            self.dialogVisibleDoctor = false ;
            self.$notify({
                    title: '    ',
                    message: 'تم إضافة الدكتور بنجاح',
                    type: 'success'
                });
                self.dialogFormVisible = false;

            })
                .catch(function (error) {
                    console.log(error);
                });
         },

        readFile() {
            console.log($('#img'))
            if ($('#img')[0].files && $('#img')[0].files[0]) {
                var FR = new FileReader();
                FR.addEventListener("load", (e) => {
                this.DoctorForm.image = e.target.result;
            });
                FR.readAsDataURL($('#img')[0].files[0]);
            }
        },
        GetWeek: function () {
            var self = this;
            //self.dialogVisible = true;
            self.loading = true;
            axios.get('/requestDay?lang=ar')
                .then(function (response) {
                    console.log(response.data);
                    self.weeks = response.data;
                    self.loading = false
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        GetMedicalSpecialist:function() {
            var self = this;
            //self.dialogVisible = true;
            self.loading = true;
            axios.get('/requestSpecialist?lang=ar')
                .then(function (response) {
                    console.log(response.data);
                    self.specialisits = response.data;
                    self.loading = false
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        UpdateToserver: function (dateForm, doctor_id) {

            var self = this;
            console.log(self.dateForm);
            axios.put('/hospital/updateDate/' + doctor_id + '/' + self.dateForm.week_id , self.dateForm)
                .then(function (response) {
                    console.log(response.data);
                    self.loading = false;
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
        deleteDoctor: function (doctor_id) {

            var self = this;
            axios.delete('/hospital/delete/' + doctor_id)
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
        }


    }


})
