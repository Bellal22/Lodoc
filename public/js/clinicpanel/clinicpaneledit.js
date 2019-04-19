ELEMENT.locale(ELEMENT.lang.en);

var main = new Vue({
    el:'#app',
    data : {
        id:[], 
        City :[],
        list : [],
        selected : '' ,
        weeks : [],
        formInline: {
            city_id :'',
            zone_id : ''
        },
        deleteWeek:{
            week_id:''
        }, 
        dateForm: {
            from_hr: '',
            to_hr: '',
            week_id :''
        },
        number:{
            phone :''
        },
        WaitingTime :{
            wating:''
        }
        
        
    },
    mounted: function () {
        var self = this;
        self.GetId()
        self.GetCity();
        self.GetWeek() ;
    },
    methods: {
        onSubmit() {
            console.log('submit!');
        },
        formater(row, column) {
            return row.healthInsurance;
        },
        filterTag(value, row) {
            return row.tag === value;
        },
        filterHandler(value, row, column) {
            var property = column['property'];
            return row[property] === value;
        },
        handleEdit(index, row) {
            console.log(index, row);
        },
        handleDelete(index, row) {
            console.log(index, row);
        },
        GetId:function(){
            var self = this ; 
            var data = document.getElementById('idele').value;
            axios.get('/requestDotorId/'+data)
            .then(function(response){
                console.log(response.data);
                    self.id = response.data;
                    self.loading = false
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        GetCity: function () {
            var self = this;
            self.loading = true;
            var data = document.getElementById('idele').value;
            axios.get('/requestCity?lang=ar')
                .then(function (response) {
                    console.log(response.data);
                    self.City = response.data;
                    self.loading = false
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        onChange: function (){
            var self = this;
            console.log(self.list);
            axios.get('/requestZone/select/'+this.formInline.city_id)
                .then(function (response) {
                    //console.log(response);
                    self.list = response.data;
                    console.log('before list');
                    console.log(self.list);
                    console.log('after list');
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        GetWeek: function () {
            var self = this;
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
        UpdateRegion: function (formInline) {

            var self = this;
            console.log(formInline);
            var doctor_id =  self.id[0].doctors_id ;
            axios.post('/updateRegion/' + doctor_id , self.formInline)
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
        UpdateDate: function (dateForm) {

            var self = this;
            var doctor_id =  self.id[0].doctors_id ;
            console.log(dateForm);
            var data = document.getElementById('idele').value;
            axios.post('/updateDate/' + doctor_id + '/'+self.dateForm.week_id +'?lang=ar', self.dateForm)
                .then(function (response) {
                    console.log(response.data);
                    self.loading = false;
                    self.$notify({
                        title: '  تم التعديل بنجاح  ',
                        message: 'بإمكانك إضافة معاد آخر',
                        type: 'success'
                    });
                    self.dialogFormVisible = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        deleteDate:function(deleteWeek){
            var self = this ; 
            var doctor_id =  self.id[0].doctors_id ;
           
            axios.delete('/deleteDate/'+doctor_id+'/'+self.deleteWeek.week_id)
            .then(function (response) {
                if(response.data === 0) {
                    self.$notify({
                        title: '    ',
                        message: 'لا يوجد هذا الموعد من الأساس',
                        type: 'success'
                    });
                    self.dialogFormVisible = false;
                }else {
                    console.log(response.data);
                self.loading = false;
                self.$notify({
                    title: '    ',
                    message: 'تم حذف الموعد بنجاح',
                    type: 'success'
                });
                self.dialogFormVisible = false;
                }
                
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        UpdatePhone: function (phone) {

            var self = this;
            
            var data = document.getElementById('idele').value;
            axios.post('/updatePhone/' + data, self.number)
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
        UpdateWaiting: function () {

            var self = this;
            
            var data = document.getElementById('idele').value;
            axios.post('/updatewaiting/' + data, self.WaitingTime)
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
        }
    }
})
