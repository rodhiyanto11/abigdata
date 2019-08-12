<template>
<div class="vld-parent">
              <!--<loading :active.sync="isLoading" 
              :can-cancel="true" 
              :on-cancel="onCancel"
              :is-full-page="fullPage"></loading>-->
               <loading 
               :active.sync="isLoading" 
              :is-full-page="fullPage"
              >
              </loading>
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
          </div>
    
</template>

<script>
    export default {
       data : function(){
          return {
                isLoading: true,
                fullPage: true,
                no : 0,
          }
       },  
       components: {
            loading : Loading
        },
        methods : {
           FininsLoading(){
               this.isLoading = false;
           }
           ,
            onCancel() {
              console.log('Loading finnissssssh')
            },
            addRoute: function() {
          axios.get('api/user?req=menu')
          .then(response => {
             
               for(var i  = 0; i < response.data.data.length ; i++){
                // console.log(i);
                   var type = response.data.data[i];
                   //console.log(type)
                   this.$router.addRoutes(
                    [{
                      path: '/'+response.data.data[i].routename,
                      name : response.data.data[i].routename,
                      component: require('/'+response.data.data[i].view+'.vue').default
                    }
                    ]);
               }  
               this.isLoading = false
            })
            .catch(error => {
              
            });
          }
        },  
        created (){
             /*setTimeout(() => {
                  this.isLoading = false
                  console.log(this.isLoading)
                },7000)*/
            //this.doAjax();
            this.addRoute();
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
