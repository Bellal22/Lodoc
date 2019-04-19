
var Main = {
    data() {
        return {
            input3: '',
            input4: '',
            input5: '',
            select: '' ,
            date: '' ,
            temp:'',
            doctorstable:[],

            Special:'[]',
            formInline: {
                name: '',
                value1:'',
                specialists:'',

            },

            tableData2:  [{
                name: '',
                address: '',
                specialist :'' ,
                phone: '',
                savehealth : ''

            },


            ]
        }
    } ,
    mounted: function () {
        var self = this;
        self.auth(); 
        self.Getdoctors();
        self.Getspecialist();
    }
    ,


    methods: {
        auth : function(){
            var check = document.getElementById('idele').value;
            if(!check){
                throw new Error("Something went badly wrong!");
            }
        },
        tableRowClassName({row , rowIndex}) {
            if (rowIndex === 1) {
                return 'warning-row';
            } else if (rowIndex === 3) {
                return 'warning-row';
            }
            return '';
        },
        onSubmit: function (formInline) {

            var self = this;
            console.log(self.formInline);
            axios.post('/admin/statistics/search',self.formInline)
                .then(function (response) {
                    console.log(response.data);
                    self.doctorstable = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        Getdoctors: function () {
            var self = this;

            axios.get('/admin/statistics')
                .then(function (response) {
                    console.log(response.data);
                    self.doctorstable = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        Getspecialist: function () {
            var self = this;

            axios.get('/admin/statistics/specialist')
                .then(function (response) {
                    self.Special = response.data;
                    console.log(self.Special);

                })
                .catch(function (error) {
                    console.log(error);
                });
        },

    }
}
var Ctor = Vue.extend(Main)
new Ctor().$mount('#app')




