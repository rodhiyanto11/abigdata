<template>
     <div class="vld-parent">
       <div class="card">
           <div class="card-header">
                <h3 class="card-title">User Role :  {{ this.$route.params.role_data.name | ucWords}} </h3>
                <div class="card-tools">
                  <button class="btn btn-danger" toggle="back" @click="handleBackroute()">
                    <i class="fas fa-window-close"></i>
                  </button>
                    <button class="btn btn-success" toggle="create new" @click="createModal">
                        <i class="fas fa-user-plus"></i>
                    </button>
                </div> 
            </div>
             <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>Role Name</th>
                      <th>Create Date</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="datarole in dataroles" :key="datarole.id">
                      <td>{{ datarole.role_name | ucWords }}</td>
                      <td>{{ datarole.created_at | completedate}}</td>
                      <td> 
                        
                        <span style="cursor:pointer" data-toggle="tooltip" data-placement="right" title="Delete Role" @click = "deleterolepage(datarole.id)">
                            <i class="fas fa-trash red" ></i>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-full  modal-dialog-centerd" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel" v-show="editmode" >Edit</h5>
                          <h5 class="modal-title" id="exampleModalLabel" v-show="!editmode" >Create</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form  @submit.prevent = "editmode ? update() : create()">
                            <div class="modal-body">
                                <div class="form-group" v-show="!editmode">
                                    <input type="hidden" name="id" v-model="form.id">
                                    <input type="hidden" name="header" v-model="form.header">
                                    <label>User Name<span class="mandatory" >*</span></label>
                                     <select name="user_id" id="user_id" v-model="form.user_id"  class="form-control" :class="{ 'is-invalid': form.errors.has('user_id') }">
                                          <option v-bind:value="rolepages_role_data.id">{{ rolepages_role_data.name | ucWords }}</option>
                                      </select>
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Role Name<span class="mandatory" >*</span></label>
                                     <select name="role_id" id="role_id" v-model="form.role_id"  class="form-control" :class="{ 'is-invalid': form.errors.has('role_id') }">
                                          <option v-for="role in roles" :key="role.id" v-bind:value="role.id">{{ role.name | ucWords }}</option>
                                      </select>
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                
                                
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" v-show="!editmode">Create</button>
                            <button type="submit" class="btn btn-warning" v-show="editmode" >Update</button>
                            </div>
                         </form>
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
            editmode : false,
            dataroles : {},
            roles : {},
            pages : {},
            rolepages_role_data : {},
            role_page_id : '',
            form : new form({
              header : "rolepages",
              id : '',
              page_id : '',
              role_id : '',
              page_name : '',
              role_name : ''
            })
          }
        },
        methods : {
          handleBackroute : function(){
            this.$router.back('roles');
          },
          loadpages : function(){
            axios.get('/api/page?req=all')
            .then (({data}) => this.pages = data.data)
          },
          loadrole : function (){
            axios.get('/api/role?req=all')
            .then (({data}) => this.roles = data.data)
          },
          loadpagerole : function (role_data){
              console.log(role_data);
            
                if(role_data.length == 0 ){
                  axios.get('/api/role?req=pagerole')
                  .then (({data}) => this.dataroles = data)
                }else{
                  if(this.$parent.search.length > 0){
                    axios.get('/api/userrole?req=userrole&id='+role_data.id+'&key='+this.$parent.search)
                    .then (({data}) => this.dataroles = data)
                  }else{
                    axios.get('/api/userrole?req=userrole&id='+role_data.id)
                    .then (({data}) => this.dataroles = data)
                  }
                  
                  
                }
            
          },
          createModal : function(){
            console.log(this.rolepages_role_data);
            this.editmode = false;
            this.form.reset()
            $("#exampleModal").modal('show');
          },
          editModal : function(dataroles){
              this.editmode = true;
               this.form.reset();
               $('#exampleModal').modal('show');
               this.form.fill(dataroles)
          },
          deleterolepage: function(id){
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.value) {
                  this.$Progress.start();
                  this.form.delete('/api/userrole/'+id)
                  .then((response) => {
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish()
                    toast.fire({
                      type: 'success',
                      title: 'Request Success'
                      })
                  },(response)=>{
                    this.$Progress.fail()
                    toast.fire({
                      type: 'error',
                      title: 'Request Error'
                      })
                  })
                  
                }
              })
          },
          create : function(){
             this.$Progress.start();
                this.form.post('/api/userrole')
                .then((response) => {
                    this.$Progress.finish()
                    $("#exampleModal").modal('hide');
                    Fire.$emit('AfterCreate',);
                    toast.fire({
                      type: 'success',
                      title: 'Request Success'
                    })
                }, (response) => {
                    this.$Progress.fail()
                  
                    toast.fire({
                      type: 'error',
                      title: 'Request Error'
                    })
                })

          },
          update : function (){
            console.log(2);
          },
          
        },
        created(){
          if(this.$route.params.role_data){
            //console.log(this.$route.params.roles_role_id);
          this.loadpages();
          this.loadrole();
          this.loadpagerole(this.$route.params.role_data);
          this.rolepages_role_data = this.$route.params.role_data;
          this.role_page_id = this.$route.params.role_data.id;
          //this.addRoute();
          //this.form.id = this.$route.params.roles_role_id;
          Fire.$on('AfterCreate',() =>{
            console.log(this.rolepages_role_data.id);
              this.loadpagerole(this.rolepages_role_data);
            })
           Fire.$on('searching',()=>{
              this.loadpagerole(this.rolepages_role_data);
              //console.log(2); 
            }) 
          }else{
            this.handleBackroute()
          }
          
        }
    }
</script>
