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
            axios.get('/requestData')
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
        handleActivation : function(index,row) {
            var self = this;
            axios.post('/requestUpdate/'+row.user_id , row)
                .then(function (response) {
                    console.log(response);
                    self.loading = false;
                    self.$notify({
                        title: '    ',
                        message: 'تم الإضافة بنجاح',
                        type: 'success'
                    });
                    self.GetContact();
                    self.dialogFormVisible = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

    DeleteFromTableData : function (index, row) {
        var self = this;
        console.log(row);

        self.$confirm('هل تريد الحذف', 'تحذير', {
            confirmButtonText: 'نعم',
            cancelButtonText: 'لا',
            // type: 'warning'
        }).then(function () {
            self.DeleteFormServer(row)
        }).catch(function () {
            self.$notify({
                title: '    ',
                message: 'تم الالغاء',
                type: 'warning'
            });
        });

    },
    DeleteFormServer : function (row, index) {
        var self = this;
        axios.delete('/requestRemove/'+row.user_id)
            .then(function (response) {
                console.log(response);
                self.loading = false;
                self.$notify({
                    title: '    ',
                    message: 'تم الحذف بنجاح',
                    type: 'success'
                });
                main.tableData.splice(index, 1);
                self.dialogFormVisible = false;
            })
            .catch(function (error) {
                console.log(error);
            });
    }
    }

})
