/*ELEMENT.locale(ELEMENT.lang.ar);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer); */
ELEMENT.locale(ELEMENT.lang.en);

var main = new Vue({
    el:'#app',
    data : {
        tableData: [],
        state:''

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
        GetContact: function () {
            var self = this;
            axios.get('/usersData')
                .then(function (response) {
                    console.log(response.data);
                    self.tableData = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }, convertType : function (value) {
                    if(value === 1) {
                        return 'مستخدم' ;
                    }else if (value === 2) {
                        return  'عيادة' ;
                    }else {
                        return 'مستشفي';
                    }
        }
        ,
        formater : function(row, column) {
            return row.address;
        },
        filterTag : function(value, row) {
            return row.type === value;
        },
        filterHandler : function(value, row, column) {
            var property = column['property'];
            return row[property] === value;
        },
        handleActivation : function(row) {

            var self = this;

            console.log(row);
            axios.post('/updateUsersData/'+row.user_id , row)
                .then(function (response) {
                    console.log(response);
                    self.$notify({
                        title: '    ',
                        message: 'تم بنجاح',
                        type: 'success'
                    });
                    self.dialogFormVisible = false;
                    self.GetContact();

                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
})
