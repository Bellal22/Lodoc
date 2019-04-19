ELEMENT.locale(ELEMENT.lang.en);

var main = new Vue({
    el: '#app',
    data: {
        form : {
            ad_image :'',
            from_date :'',
            to_date :'',
            user_id:''
        },
        lastAds:[]
    },
    mounted: function () {
        var self = this ; 
        self.getAds();
    },
    methods: {
        readFile() {
            var self = this
            console.log($('#img'))
            if ($('#img')[0].files && $('#img')[0].files[0]) {
                var FR = new FileReader();
                FR.addEventListener("load", (e) => {
                    self.form.ad_image = e.target.result;
            });
                FR.readAsDataURL($('#img')[0].files[0]);
            }
        },
        sendForm(){
            var self = this;
            var data = document.getElementById('idele').value;
            self.form.user_id = data ; 
             
            axios.post('/clinic/addAds/' + data ,self.form)
                .then(function (response) {
                    console.log(response.data);
                    self.loading = false;
                    self.$notify({
                        title: '    ',
                        message: 'تم إضافة الإعلان بنجاح',
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
            axios.post('/clinic/getAds/' + data +'?lang=ar')
                .then(function (response) {
                    console.log(response.data);
                    self.lastAds = response.data ; 
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
})

