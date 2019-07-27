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
        methods : {
            addRoute: function() {
          
          axios.get('http://127.0.0.1:8000/api/user?req=menu')
          .then(response => {
           
               response.data.data.forEach(type => {
                   var com = './'+type.model+'s.vue';
                  //console.log(com);
                    this.$router.addRoutes(
                    [{
                      path: '/'+type.view,
                      component: require(''+com+'').default
                    }
                    ]);
               });
                 
             
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
