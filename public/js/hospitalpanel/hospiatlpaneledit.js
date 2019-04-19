ELEMENT.locale(ELEMENT.lang.en);

var main = new Vue({
    el:'#app',
    data : {
        City :[],
        list : [],
        Branchs :[],
        selected : '' ,
        formInline: {
            city_id :'',
            zone_id : '',
            branch_id :''
        }

    },
    mounted: function () {
        var self = this;
        self.GetCity();
        self.GetBranch();
    },
    methods: {
        onSubmit() {
            console.log('submit!');
        },
        formater(row, column) {
            return row.healthInsurance;
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
        GetBranch: function () {
            var self = this;
            self.loading = true;
            var data = document.getElementById('idele').value;
            axios.get('requestInfoBranch/' + data + '?lang=ar')
                .then(function (response) {
                    self.Branchs = response.data;
                    console.log(self.Branchs);

                    self.loading = false
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        UpdateRegion: function (formInline) {

            var self = this;
            if(this.formInline.branch_id == ''){
                return alert('يجب تحديد الفرع')
            }else {
                console.log(formInline);
                axios.post('/hospital/updateRegion/' + self.formInline.branch_id, self.formInline)
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

    }
})
