<template>
  <div class="vld-parent">
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>
                <div class="card-tools">
                    
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User id</th>
                      <th>User Name</th>
                      <th>Page ID</th>
                      <th>Page Name</th>
                      <th>Latitude</th>
                      <th>Longitude</th>
                      <th>Country</th>
                      <th>City</th>
                      <th>Region</th>
                      <th>IP</th>
                      <th>Action</th>
                      <th>Create_at</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in user_logs.data" :key="user.id">
                      <td>{{ user.id  }}</td>
                      <td>{{ user.user_id  }}</td>
                      <td>{{ user.user_name             }}</td>
                      <td>{{ user.page_id  }}</td>
                      <td>{{ user.page_name  }}</td>
                      <td>{{ user.latitude  }}</td>
                      <td>{{ user.longitude  }}</td>
                      <td>{{ user.country_name  }}</td>
                      <td>{{ user.city   }}</td>
                      <td>{{ user.region   }}</td>
                      <td>{{ user.ip_address  }}</td>
                      <td>{{ user.action  }}</td>
                      <td>{{ user.create_at| completedate  }}</td>
                     
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="user_logs" v-on:pagination-change-page="getResults" :limit="1">
                  <span slot="prev-nav">&lt; Previous</span>
                  <span slot="next-nav">Next &gt;</span>
                </pagination>
              </div>
            </div>
  </div>
</template>

<script>
    export default {
         data: function () {
            return{
             user_logs : {}
               
           }
        },
        methods : {
             loadUser : function(){
                if(this.$parent.search.length == 0 ){
                  axios.get("/api/userlog").then(  ({ data }) => (this.user_logs = data) );
                }else{
                  axios.get("/api/userlog?search="+this.$parent.search).then(  ({ data }) => (this.user_logs = data) );
                }
                
            },
             getResults(page = 1) {
               console.log(page)
                axios.get('/api/userlog?page=' + page)
                  .then(response => {
                    this.user_logs = response.data;
                  });
              }
        },
        created (){
             Fire.$on('searching',()=>{
                this.loadUser();
                })
                
                    this.loadUser();
                    Fire.$on('AfterCreate',() =>{
                    this.loadUser();
                })
        },
        mounted() {
           
            console.log('Component mounted.')
        }
    }
</script>
