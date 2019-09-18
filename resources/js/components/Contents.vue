<template>
        
            
                 <div  id="app">
                      <div id="refs"  class="ex1" ref="tableau"></div>    
                        <div class="select-style" style="display: none;">
                            <select id="SheetList">
                            </select>
                        </div>
                     <button class="button" style="display: none;" onclick="getVizData()">Export data to CSV</button>
                     <button class="button" style="display: none;" onclick="exportToPDF();">Export to PDF</button>
                     <div id="controls" style="padding:20px;">
                            <form id="resizeForm">
                                <input type="text" id="resizeWidth" placeholder="Width">
                                <input type="text" id="resizeHeight" placeholder="Height">
                                <button type="button" onClick="vizResize();">Resize</button>
                            </form>
                        </div>
                 </div>
           
  
</template>
<script>
    export default {
        data(){
            return{
                pageID: '',
                pageName : '',
                action : 'view',
                msg: 'Nama content apa?',
                url: "",
                location : "",
                full : "",
                sheetexc: []  ,
            }
        },
        methods: {
            loginsert : function (){
                axios.post('/api/userlog', {
                    pageID: this.pageID,
                    pageName: this.pageName,
                    action : this.action
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
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
            generatingTableau : function(){
                
                this.$Progress.start();
                this.pageName = this.$route.params.t_url.pageName;
                this.pageID = this.$route.params.t_url.pageID;
                this.loginsert();
                this.Token();
                Fire.$on('AfterCreate',() =>{
                    this.url = 'https://dwh.admedika.co.id:7070/trusted/';
                    this.location = this.$route.params.t_path;
                    var url = this.url+this.token+this.location;
                    this.full =  this.initgetViz(url,function(){
                        this.$Progress.finish(function(){
                            
                        });
                          
                    });
                    
                })
            }
        },
         watch: {
             
            '$route' (to, from) {
                    this.generatingTableau(function(){
                        
                    });
             }
             
        },
        created: function () {
           
           /* console.log(this.$route.params.t_url);
            this.Token();
             Fire.$on('AfterCreate',() =>{
                this.url = 'https://dwh.admedika.co.id:7070/trusted/';
                this.location = this.$route.params.t_path;
                var url = this.url+this.token+this.location;
                this.full =  this.initgetViz(url);
            })*/
            this.$parent.searchmode =  false;
            this.generatingTableau();
        }
    }
</script>
