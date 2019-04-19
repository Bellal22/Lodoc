ELEMENT.locale(ELEMENT.lang.en);

var main = new Vue({
    el: '#app',
    data: {
        Region: [],
        weeks: '',
        formData: [],
        tableData: [],
        formInline: {
            city_id: '',
            zone_id: ''
        },
        dateForm: {
            from_hr: '',
            to_hr: '',
            week_id: ''
        }
    },
    mounted: function () {
        var self = this;
        self.GetInfo();
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
        GetContact: function (doctor_id) {
            var self = this;
            
            self.loading = true;
            axios.get('/clinic/requestInfo/'+doctor_id+'?lang=ar').
            then(function (response) {
                console.log(response.data);
                self.tableData = response.data;
                self.loading = false
            })
                .catch(function (error) {
                    console.log(error);
                });
        },
        GetInfo: function () {
            var self = this;
            self.loading = true;
            var data = document.getElementById('idele').value;
            axios.get('/clinic/requestData/'+data+'?lang=ar')
                .then(function (response) {
                    console.log(response.data);
                    self.formData = response.data;
                    self.loading = false
                    self.GetContact(self.formData[0].doctors_id); 
                })
                .catch(function (error) {
                    console.log(error);
                });
        }


    }


})
