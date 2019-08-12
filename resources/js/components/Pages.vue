<template>
 <div class="vld-parent">
        <loading :active.sync="isLoading" 
              :is-full-page="fullPage"></loading>
        <div class="container">
       <div class='card'>
            <div class="card-header">
                <h3 class="card-title">Pages</h3>
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
                      <th>Model</th>
                      <th>Controller</th>
                      <th>View</th>
                      <th>Route Name</th>
                      <th>Note</th>
                      <th>Create Date</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="page in pages.data" :key="page.id">
                      <td>{{ page.name | ucWords }}</td>
                      <td>{{ page.model | ucWords }}</td>
                      <td>{{ page.controller | ucWords }}</td>
                      <td>{{ page.view | ucWords }}</td>
                      <td>{{ page.routename | ucWords }}</td>
                      <td>{{ page.note }}</td>
                      <td>{{ page.created_at | completedate}}</td>
                      <td>
                        <a href="#" data-toggle="tooltip" data-placement="left" title="Edit" @click = "editModal(page)" >
                            <i class="fas fa-edit blue" ></i>
                        </a> 
                        <a href="#" data-toggle="tooltip" data-placement="right" title="Delete" @click = "deleteRole(page.id)">
                            <i class="fas fa-trash red" ></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <div class="card-footer">
               <pagination :data="pages" @pagination-change-page="getResults">
                  <span slot="prev-nav">&lt; Previous</span>
                  <span slot="next-nav">Next &gt;</span>
                </pagination>
            </div>
        </div>
        <div class="modal fade " id="exampleModal" tabindex="-1" page="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-full  modal-dialog-centerd" page="document">
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
                                <label>Model<span class="mandatory" >* (contoh : 'User')</span></label>
                                <input v-model="form.model" type="text" name="model"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('model') }"
                                placeholder="model"
                                >
                                <has-error :form="form" field="model"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Controller<span class="mandatory" >* (contoh : 'UserController')</span></label>
                                <input v-model="form.controller" type="text" name="controller"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('controller') }"
                                placeholder="controller"
                                >
                                <has-error :form="form" field="controller"></has-error>
                            </div>
                            <div class="form-group">
                                <label>View<span class="mandatory" >* (contoh : 'Users')</span></label>
                                <input v-model="form.view" type="text" name="view"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('view') }"
                                placeholder="view"
                                >
                                <has-error :form="form" field="view"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Route Name<span class="mandatory" >* (contoh : 'users')</span></label>
                                <input v-model="form.routename" type="text" name="routename"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('routename') }"
                                placeholder="routename"
                                >
                                <has-error :form="form" field="routename"></has-error>
                            </div>
                            <div class="form-group">
                                    <label>Status<span class="mandatory" >*</span></label>
                                     <select name="status" id="status" v-model="form.status"  class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                                          <option value="1">Menu + Route</option>
                                          <option value="2">Route</option>
                                      </select>
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
                        <span class="mandatory" >Note : Mohon diperhatikan contoh yang diberikan</span>
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
import { setTimeout } from 'timers';
    export default {
        data : function(){
            return {
              isLoading : true,
              fullPage : true,
                editmode :false,
                pages : {},
                form : new form({
                    id          : '',
                    name        : '',
                    model       : '',
                    controller  : '',
                    view        : '',
                    routename   : '',
                    note        : '',
                    create_at   : '',
                    status      : ''
                })
            }
            
        },
        components : {
          loading : Loading
        },
        methods : {
            deadLoading : function(){
              setTimeout(() => {
                this.isLoading = false
              },1000);
              
            },
            loadpage : function(){
                this.isLoading = true;
              //console.log(this.$parent.search.length);
               if(this.$parent.search.length == 0){
                 axios.get("api/page").then(  ({ data }) => (this.pages = data) );
                 this.deadLoading();
               }else{
                 axios.get("api/page?search="+this.$parent.search).then(  ({ data }) => (this.pages = data) );
                 this.deadLoading();
               } 
            },
            createModal (){
              this.isLoading = true;
               this.editmode = false;
               this.form.reset();
               $('#exampleModal').modal('show');
               
             },
             editModal (user){
               this.isLoading = true;
               this.editmode = true;
               this.form.reset();
               $('#exampleModal').modal('show');
               this.form.fill(user);
               
             },
             createRole: function () {
               this.isLoading  = true;
                this.$Progress.start();
                this.form.post('api/page')
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
               this.isLoading = true;
                this.$Progress.start();
                this.form.put('api/page/'+this.form.id)
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
               this.isLoading = true;
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
                  this.form.delete('api/page/'+id)
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
               this.isLoading = true;
               console.log(page)
                axios.get('api/page?page=' + page)
                  .then(response => {
                    this.pages = response.data;
                  });
                
              }
        },
        
        created (){
            if(this.isLoading == true){
              console.log('oke')
            }
            Fire.$on('searching',()=>{
              this.loadpage()
              //console.log(2); 
            })
            this.loadpage();
            Fire.$on('AfterCreate',() =>{
              this.loadpage();
            })
            //
        }
       
    }
</script>
