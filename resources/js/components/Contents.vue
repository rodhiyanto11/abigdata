<template>
    <div class="container">
        
               <div class="card">
                   <center>
                <div  id="app">
                    
                
                    <h1>{{ msg }}</h1>
                     <div  class="ex1" ref="tableau"></div>    

                </div>
                </center>
    </div>
    </div>
    
</template>

<script>
    export default {
        data(){
            return{
                msg: 'Tableau Public',
                url: "http://public.tableau.com/views/RegionalSampleWorkbook/Storms",
                options: {
                    hideTabs: true
                }
            }
        },
        methods: {
            initViz: function () {
                let viz = new tableau.Viz(this.$refs.tableau, this.url, this.options);
            }
        },
        mounted: function () {
            this.initViz()
        }
    }
</script>
