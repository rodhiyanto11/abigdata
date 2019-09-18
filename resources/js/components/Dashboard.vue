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
                                
What is Lorem Ipsum?

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?

It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
What is Lorem Ipsum?

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?

It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
What is Lorem Ipsum?

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?

It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).

                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
    
</template>

<script>
import { setInterval } from 'timers';
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
            deadLoading : function (){
              setInterval(
                () => {
                  this.isLoading = false;
                },200
              );
            }
           ,
            onCancel() {
              console.log('Loading finnissssssh')
            },
            addRoute: function() {
          axios.get('/api/users?req=menu')
          .then(response => {
             
               for(var i  = 0; i < response.data.data.length ; i++){
               
                   var type = response.data.data[i];
                   console.log(type)
                   this.$router.addRoutes(
                    [
                      {
                      path: '/'+response.data.data[i].routename+"/:t_path/:t_url",
                      name : response.data.data[i].routename,
                      
                      component: require('/'+response.data.data[i].view+'.vue').default,
                      //props: {entity_type_id: response.data.data[i].routename}
                    }]
                    );
               }  
               this.isLoading = false
            })
            .catch(error => {
              
            });
          }
        },  
        created (){
         
            this.$parent.searchmode =  false;
            this.addRoute();
            this.deadLoading();
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
