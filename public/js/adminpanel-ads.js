ELEMENT.locale(ELEMENT.lang.en);

var main = new Vue({
    el: '#app',
    data: {
        pending :'',
        to_date :'',
        ad_id :'',
        lastAds:[] , 
        activeAdd:'' ,
        dialogVisible: false
    },
    mounted: function () {
        var self = this ; 
        self.getAds();
    },
    methods: {
        
        updateTime(){
            var self = this;
            var data = document.getElementById('idele').value;
             
             
            axios.post('/updateToDate/' + self.activeAdd,self.to_date)
                .then(function (response) {
                    console.log(response.data);
                    self.loading = false;
                    self.$notify({
                        title: '    ',
                        message: 'تم تعديل الإعلان بنجاح',
                        type: 'success'
                    });
                    self.dialogFormVisible = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        getAds(){
            var self = this;
            var data = document.getElementById('idele').value;
            axios.get('/admin/getAds/'+data+'?lang=ar')
                .then(function (response) {
                    console.log(response.data);
                    self.lastAds = response.data ; 
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        handleActivation : function($ad_id) {
            var self = this;
            self.activeAdd = $ad_id ; 
            axios.post('/updatePadding/'+$ad_id)
                .then(function (response) {
                    console.log(response);
                    self.$notify({
                        title: '    ',
                        message: 'تم بنجاح',
                        type: 'success'
                    });
                    self.dialogFormVisible = false;
                    self.getAds();

                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        handleClose(done) {
            this.$confirm('هل انت متأكد من اغلاق القائمة ؟')
              .then(_ => {
                done();
              })
              .catch(_ => {});
          },
          ShowdialogVisible($ad_id){
              var self = this ; 
              self.dialogVisible = true ;
              self.activeAdd = $ad_id ; 
          }
        
    
    }
})

