<template>
    <div class="container" >
        
               <div class="card">
              
                   <center>
                <div  id="app">
                    
                
                    <h1>{{ msg }}</h1>
                     <div id="refs"  class="ex1" ref="tableau"></div>    
                    <div class="select-style"><select id="SheetList"></select></div>
                    <button class="button" onclick="getVizData()">Export data to CSV</button>
                    <button class="button" onclick="exportToPDF();">Export to PDF</button>
                    <button @click="pindah()">pindah</button>
                </div>
                </center>
                <tableau>
                   
                </tableau>
    </div>
    </div>
    
</template>

<script>
import Tableau from './Tableau';
    export default {
        data(){
            return{
                msg: 'Nama content apa?',
                url: "",
                location : "",
                full : "",
                sheetexc: []  ,
                propsToPass: {
          name: 'John',
          last_name: 'Doe',
          age: '29',
        } 
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
        components: {
            props : ['rodhi'],
            'tableau' : Tableau,
          
            },
            //rendering new component
         watch: {
            '$route' (to, from) {
                    this.Token();
                    Fire.$on('AfterCreate',() =>{
                        this.$Progress.start();
                        this.url = this.$route.params.t_url;
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
                this.url = this.$route.params.t_url;
                this.location = this.$route.params.t_path;
                var url = this.url+this.token+this.location;
                this.full =  this.initgetViz(url);
            })
        }
    }
</script>
