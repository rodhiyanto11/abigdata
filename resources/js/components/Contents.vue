<template>
    <!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">Dashboard Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <iframe src="https://public.tableau.com/views/public_exercise/Dashboard1?:showVizHome=no&:embed=true" width="645" height="955"></iframe> -->
    
    <!-- <iframe src="https://public.tableau.com/profile/chris.gerrard#!/vizhome/RegionalSampleWorkbook/Storms" width="645" height="955"></iframe> -->
    <div class="container">
        
               <div class="card">
                   <center>
                <div  id="app">
                    
                
                    <h1>{{ msg }}</h1>
                     <div ref="tableau"></div>    

                </div>
                </center>
    </div>
    </div>
    
</template>
<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
<script type="text/javascript" src="https://public.tableau.com/javascripts/api/tableau-2.min.js"></script> -->
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
