ELEMENT.locale(ELEMENT.lang.en);

var main = new Vue({
    el: '#app',
    data: {

        doctorstable: [],
        specialisits:[],
        Special : [],

        formInline: {
            name: '',
            specialists: ''
        }


    },
    mounted: function () {
        var self = this;
        self.Getdoctors();
        self.GetMedicalSpecialist() ;

    }
    ,
    methods: {
        tableRowClassName({row, rowIndex}) {
            if (rowIndex === 1) {
                return 'warning-row';
            } else if (rowIndex === 3) {
                return 'warning-row';
            }
            return '';
        },
        onSubmit: function (formInline) {
            var self = this;
            var data = document.getElementById('idele').value;
            console.log(self.formInline);
            axios.post('/hospital/statistics/search/'+data, self.formInline)
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
            var data = document.getElementById('idele').value;
            axios.get('/hospital/statistics/'+data)
                .then(function (response) {
                    console.log(response.data);
                    self.doctorstable = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        GetMedicalSpecialist:function() {
            var self = this;
            axios.get('/requestSpecialist?lang=ar')
                .then(function (response) {
                    console.log(response.data);
                    self.specialisits = response.data;
                    self.loading = false
                })
                .catch(function (error) {
                    console.log(error);
                });
        }


    }

})
