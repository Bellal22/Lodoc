
var Main = {
    data() {
        return {
            
            weeks : [],
            doctorstable:[],

            
            formInline: {
                name: '',
                week_id:'',
                doctors_id:''
            },
        }
    } ,
    mounted: function () {
        var self = this;
        self.GetPatients();
        self.GetWeek() ;
    }
    ,


    methods: {
        tableRowClassName({row , rowIndex}) {
            if (rowIndex === 1) {
                return 'warning-row';
            } else if (rowIndex === 3) {
                return 'warning-row';
            }
            return '';
        },
        onSubmit: function () {

            var self = this;
            var data = document.getElementById('idele').value;
            if(self.formInline.name === '' && self.formInline.week_id === ''){
                alert('لا يوجد شئ للبحث عنه') ;
                
            }else {
                console.log(self.formInline);
            axios.post('/clinic/statistics/search/'+data , self.formInline)
                .then(function (response) {
                    console.log(response.data);
                    self.doctorstable = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
            
        },

        GetPatients: function () {
            var self = this;
            var data = document.getElementById('idele').value;
            axios.get('/clinic/statistics/'+data)
                .then(function (response) {
                    console.log(response.data);
                    self.doctorstable = response.data;
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



    }
}
var Ctor = Vue.extend(Main)
new Ctor().$mount('#app')




