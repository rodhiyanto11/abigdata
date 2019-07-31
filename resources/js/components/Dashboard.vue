<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
       data : function(){
          return {
            no : 0,
          }
       },  
        methods : {
            addRoute: function() {
          
          axios.get('api/user?req=menu')
          .then(response => {
              //console.log(response)
               //console.log(response.data.data.length) 
               for(var i  = 0; i < response.data.data.length ; i++){
                // console.log(i);
                   var type = response.data.data[i];
                   console.log(type)
                   this.$router.addRoutes(
                    [{
                      path: '/'+response.data.data[i].routename,
                      name : response.data.data[i].routename,
                      component: require('/'+response.data.data[i].view+'.vue').default
                    }
                    ]);
               }
               
               /*for(var i = 0; i < response.data.data.length ; i++){
                   console.log(i)
                   console.log(response.data.data[0].view)
                   //console.log(this.no);
                   var type = response.data.data[i];
                  // console.log(type)
                   var com = './'+type.views+'s.vue';
                   // console.log(type.routename);
                    this.$router.addRoutes(
                    [{
                      path: '/'+type.routename,
                      component: require(''+com+'').default
                    }
                    ]);
               }*/
               //response.data.data.forEach(type => {
                   
                  
                   
              // });
                 
             
            })
            .catch(error => {
              
            });
          }
        
        },
        created (){
            this.addRoute();
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
