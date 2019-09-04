<template>
    <div class="vld-parent">
       
        <div class='card'>
            <div class="card-header">
                <h3 class="card-title">Roles</h3>
                <div class="card-tools">
                    <button class="btn btn-success" @click="createModal()">
                        <i class="fas fa-user-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Note</th>
                      <th>Create Date</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="role in roles.data" :key="role.id">
                      <td>{{ role.name | ucWords }}</td>
                      <td>{{ role.note }}</td>
                      <td>{{ role.created_at | completedate}}</td>
                      <td>
                        <a href="#" data-toggle="tooltip" data-placement="left" title="Edit" @click = "editModal(role)" >
                            <i class="fas fa-edit blue" ></i>
                        </a> 
                        <a href="#" data-toggle="tooltip" data-placement="right" title="Delete" @click = "deleteRole(role.id)">
                            <i class="fas fa-trash red" ></i>
                        </a>
                        <span style="cursor:pointer" data-toggle="tooltip" data-placement="right" title="Setup page" @click = "rolepage(role)">
                            <i class="fas fa-cog teal" ></i>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <div class="card-footer">
                    <pagination :data="roles" v-on:pagination-change-page="getResults" :limit="1">
                       <span slot="prev-nav">&lt; Previous</span>
                       <span slot="next-nav">Next &gt;</span>
                     </pagination>
                 </div>
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
                    <form  @submit.prevent = "editmode ? updateRole() : createRole()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name<span class="mandatory" >*</span></label>
                                <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"
                                placeholder="name"
                                >
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                    <label>Note</label>
                                    <textarea rows="4" cols="50"
                                        v-model="form.note" 
                                        class="form-control" 
                                        :class="{ 'is-invalid': form.errors.has('note') }"
                                    >      
                                    </textarea>
                                    <has-error :form="form" field="note"></has-error>
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
    
</template>

<script>
import { setTimeout } from 'timers';
    export default {
        data : function(){
            return {
              
               
                fullPage: true,
                editmode :false,
                roles           : {},
                form            : new form({
                    id          : '',
                    name        : '',
                    note        : '',
                    create_at   : ''
                }),
            }
            
        },
        
        methods : {
          
          
          rolepage :function(role){
            this.$router.push({name: 'rolepages' , params : { role_data : role}}) 
          },
            loadrole : function(){
              
               if(this.$parent.search.length == 0 ){
                
                  axios.get("/api/roles").then(  ({ data }) => (this.roles = data) );
                  
                }else{
                 
                  axios.get("/api/roles?search="+this.$parent.search).then(  ({ data }) => (this.roles = data) );
                  
                }
                
            },
            createModal (){
             //
               this.editmode = false;
               this.form.reset();
               $('#exampleModal').modal('show');
               
             },
             editModal (user){
               //this.isLoading = true;
               this.editmode = true;
               this.form.reset();
               $('#exampleModal').modal('show');
               this.form.fill(user)
               
             },
             
             createRole: function () {
              
                this.$Progress.start();
                this.form.post('/api/role')
                .then((response) => {
                    this.$Progress.finish()
                    $("#exampleModal").modal('hide');
                    Fire.$emit('AfterCreate');
                    toast.fire({
                      type: 'success',
                      title: 'Request Success'
                    })
                    
                }, (response) => {
                    this.$Progress.fail()
                  //  $("#exampleModal").modal('hide');
                    toast.fire({
                      type: 'error',
                      title: 'Request Error'
                    })
                    
                })
             },
             updateRole(){
              
                this.$Progress.start();
                this.form.put('/api/roles/'+this.form.id)
                .then((response) => {
                  this.$Progress.finish();
                  $("#exampleModal").modal('hide');
                    Fire.$emit('AfterCreate');
                    
                    toast.fire({
                      type: 'success',
                      title: 'Request Success'
                    })
                    
                },(response) =>{
                   this.$Progress.fail()
                   
                  toast.fire({
                      type: 'error',
                      title: 'Request Error'
                    })
                    
                })
                .catch( () => {
                  toast.fire({
                      type: 'error',
                      title: 'Request Error'
                    })
                })
             },
             deleteRole(id){
              
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
                  this.form.delete('/api/roles/'+id)
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
             } ,
             getResults(page = 1) {
              
                axios.get('/api/roles?page=' + page)
                  .then(response => {
                    this.pages = response.data;
                    
                  });
              }

        },
        created (){
          this.$parent.searchmode =  true;
         
            Fire.$on('searching',()=>{
              this.loadrole()
            })
            this.loadrole();
            Fire.$on('AfterCreate',() =>{
              this.loadrole();
            })
        }
       
    }
</script>
