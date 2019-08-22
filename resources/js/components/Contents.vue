<template>
    <div class="container" >
        <div class="card">
            <center>
                 <div  id="app">
                      <div id="refs"  class="ex1" ref="tableau"></div>    
                     <div class="select-style" style="display: none;"><select id="SheetList"></select></div>
                     <button class="button" style="display: none;" onclick="getVizData()">Export data to CSV</button>
                     <button class="button" style="display: none;" onclick="exportToPDF();">Export to PDF</button>
                     
                 </div>
             </center>
         </div>
    </div>
    
</template>

<script>
    export default {
        data(){
            return{
                msg: 'Nama content apa?',
                url: "",
                location : "",
                full : "",
                sheetexc: []  ,
           
            }
        },
        methods: {
            initgetViz: function (url) {  
                this.sheetexc.push("Branch by Total Active Member");
                initViz(url, this.sheetexc);
            },
            Token :  function(){
                
                 axios.get('https://analytics.admedika.co.id/debug/token.php', {
                 header : {
                     "Access-Control-Request-Method": "GET",
                     "Content-type" : "application/json",
                 },
                 params : {"reqtoken" : "rodhi"}
             
                }).then(response=> {
             
                let data = "";
                data = response.data.data;
                this.token = data;
                  Fire.$emit('AfterCreate');
                });
          
            },
        },
       
         watch: {
            '$route' (to, from) {
                    this.Token();
                    Fire.$on('AfterCreate',() =>{
                        this.$Progress.start();
                        this.url = 'https://dwh.admedika.co.id:7070/trusted/';
                        this.location = this.$route.params.t_path;
                        var url = this.url+this.token+this.location;
                    this.full =  this.initgetViz(url);
                    this.$Progress.finish();
                    })
             }
             //end rendering new component
  },
        //first render new component
        created: function () {
           this.Token();
             Fire.$on('AfterCreate',() =>{
                this.url = 'https://dwh.admedika.co.id:7070/trusted/';
                this.location = this.$route.params.t_path;
                var url = this.url+this.token+this.location;
                this.full =  this.initgetViz(url);
            })
        }
    }
</script>
