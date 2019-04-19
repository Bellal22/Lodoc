///////////////////////////////////////

// Statistics Page & Bank Accounts Page

///////////////////////////////////////
iamge_url = '';
$(document).ready(function () {

    function readFile() {
        if (this.files && this.files[0]) {
            var FR = new FileReader();
            FR.onload = function (e) {
                iamge_url = e.target.result;
                console.log(iamge_url);
            };

            FR.readAsDataURL(this.files[0]);
        }

    }

    //document.getElementById("SalesCat_img").addEventListener("change", readFile, false);

});

var Main = new Vue({

    el: '#app',
    data: {
        input3: '',
        input4: '',
        input5: '',
        select: '',
        date: '',
        tableData2: [{
            name: '',
            address: '',
            specialist: '',
            phone: '',
            savehealth: ''

        }],
        tableData1: []
    },
    mounted: function () {
        var self = this;
        self.auth(); 
        self.GetContact();
    }
    ,
    methods: {
        auth : function(){
            var check = document.getElementById('idele').value;
            if(!check){
                throw new Error("Something went badly wrong!");
            }
        },

        tableRowClassName({row, rowIndex})
        {
            if (rowIndex === 0) {
                return 'warning-row';
            } else if (rowIndex === 3) {
                return 'success-row';
            }
            return '';
        },
        GetContact: function () {
            var self = this;

            axios.get('/accountInfo')
                .then(function (response) {
                    console.log(response.data);
                    self.tableData1 = response.data;

                })
                .catch(function (error) {
                    console.log(error);
                });
        }


}
})

