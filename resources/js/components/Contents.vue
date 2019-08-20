<template>
    <div class="container">
        
               <div class="card">
                   <center>
                <div  id="app">
                    
                
                    <h1>{{ msg }}</h1>
                     <div id="refs"  class="ex1" ref="tableau"></div>    
                    <div class="select-style"><select id="SheetList"></select></div>
                    <button class="button" onclick="getVizData()">Export data to CSV</button>
                    <button class="button" onclick="exportToPDF();">Export to PDF</button>
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
                url: "https://dwh.admedika.co.id:7070/trusted/2kqJSJB6RMOdJJKrwXTJ_g==:fvVf9fHBsatHuOgt8cmVEV-T/views/VASCorporateYKPANTAM-asoff/01_GENERAL_OVERVIEW",
                sheetexc: []    
            }
        },
        methods: {
            
            initgetViz: function (token) {
                this.sheetexc.push("Branch by Total Active Member");
                initViz("https://dwh.admedika.co.id:7070/trusted/"+token+"/views/VASCorporateYKPANTAM-asoff/01_GENERAL_OVERVIEW", this.sheetexc);
            },
            Token :  function(){
                
                 axios.get('https://analytics.admedika.co.id/debug/token.php', {
                
                 params : {"reqtoken" : "rodhi"}
             
                }).then(response=> {
             
                let data = "";
                data = response.data.data;
                this.token = data;
                  Fire.$emit('AfterCreate');
                });
          
            },
        },
        created: function () {
           
            this.Token(()=>{
                console.log(1)
            });
             Fire.$on('AfterCreate',() =>{
                dispose();
                this.initgetViz(this.token);
            })
           
        }
    }
</script>
