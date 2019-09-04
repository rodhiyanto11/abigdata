<template>
  <div class="vld-parent">
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>
                <div class="card-tools">
                    <button class="btn btn-success" @click="createModal">
                        <i class="fas fa-user-plus"></i>
                    </button>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Create Date</th>
                      <th>Expired Date</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                      <td>{{ user.name | ucWords }}</td>
                      <td>{{ user.username | ucWords }}</td>
                      <td>{{ user.email}}</td>
                      <td>{{ user.created_at | completedate}}</td>
                      <td>{{ user.expired_date | completedate}}</td>
                      <td>
                        <a href="#" data-toggle="tooltip" data-placement="left" title="Edit" @click = "editModal(user)" >
                            <i class="fas fa-edit blue" ></i>
                        </a> 
                        <a href="#" data-toggle="tooltip" data-placement="right" title="Delete" @click = "deleteUser(user.id)">
                            <i class="fas fa-trash red" ></i>
                        </a>
                        <span style="cursor:pointer" data-toggle="tooltip" data-placement="right" title="Setup Role" @click = "rolepage(user)">
                            <i class="fas fa-cog teal" ></i>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="users" v-on:pagination-change-page="getResults" :limit="1">
                  <span slot="prev-nav">&lt; Previous</span>
                  <span slot="next-nav">Next &gt;</span>
                </pagination>
              </div>
            </div>
            <!---Modal-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centerd" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel" v-show="editmode" >Edit</h5>
                          <h5 class="modal-title" id="exampleModalLabel" v-show="!editmode" >Create</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form  @submit.prevent = "editmode ? updateUser() : createUser()">
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
                                        <label>Username<span class="mandatory" >*</span></label>
                                        <input v-model="form.username" type="text" name="username"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('username') }"
                                        placeholder="username"
                                        >
                                        <has-error :form="form" field="username"></has-error>
                                    </div>
                                <div class="form-group">
                                    <label>Email<span class="mandatory" >*</span></label>
                                    <input v-model="form.email" type="email" name="email"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }"
                                    placeholder="email"
                                    >
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                                <div class="form-group">
                                        <label>Date Expired</label>
                                        <datepicker  :bootstrap-styling="true"  v-model="form.expired_date" name="expired_date"
                                        :class="{ 'is-invalid': form.errors.has('expired_date') }"
                                         placeholder="expired_date" >
                                        </datepicker>
                                        <has-error :form="form" field="expired_date"></has-error>
                                </div>
                                <div class="form-group">
                                        <label>is_Expired</label>
                                        <select name="is_expired" id="is_expired" v-model="form.is_expired"  class="form-control" :class="{ 'is-invalid': form.errors.has('is_expired') }">
                                          <!--<option v-for="role in roles.data" :key="role.id" :value="role.id">{{ role.name }}</option>-->
                                          <option value="1">Ya </option>
                                          <option value="2">Tidak </option>
                                        </select>
                                  </div>
                                <div class="form-group">
                                    <label>Password<span class="mandatory" >* (wajib input untuk pembuatan user baru)</span></label>
                                    <input v-model="form.password" type="password" name="password"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }"
                                    placeholder="password"
                                    >
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Confirmation</label>
                                    <input v-model="form.password_confirmation" type="password" name="password_confirmation"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                                    placeholder="password_confirmation"
                                    >
                                    <has-error :form="form" field="password_confirmation"></has-error>
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
import { setInterval } from 'timers';
    export default {
        data: function () {
            return{
              
                editmode : false,
                users : {},
                roles : {},
                
                form : new form({
                    id: '',
                    name :  '',
                    status :  '',
                    is_expired :  '',
                    username :  '',
                    email :  '',
                    password :  '',
                    expired_date :  '',
                })
           }
        },
        methods: {
          rolepage :function(role){
            console.log(role);
            this.$router.push({name: 'userroles' , params : { role_data : role}}) 
          },
            loadUser : function(){
                if(this.$parent.search.length == 0 ){
                  axios.get("/api/users").then(  ({ data }) => (this.users = data) );
                }else{
                  axios.get("/api/users?search="+this.$parent.search).then(  ({ data }) => (this.users = data) );
                }
                
            },
            loadRoles : function(){
                axios.get("/api/roles?req=all").then(  ({ data }) => (this.roles = data) );
            },
            createUser: function () {
                this.$Progress.start();
                this.form.post('/api/users')
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
             updateUser(){
                this.$Progress.start();
                this.form.put('/api/users/'+this.form.id)
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
             deleteUser(id){
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
                  this.form.delete('/api/users/'+id)
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
             createModal (){
               this.editmode = false;
               this.form.reset();
               $('#exampleModal').modal('show');
             },
             editModal (user){
               this.editmode = true;
               this.form.reset();
               $('#exampleModal').modal('show');
               this.form.fill(user)
             },
             getResults(page = 1) {
               console.log(page)
                axios.get('/api/users?page=' + page)
                  .then(response => {
                    this.users = response.data;
                  });
              }
        },
        components: {
            'datepicker' : Datepicker,
          
            },
        created() {
          this.$parent.searchmode =  true;
          Fire.$on('searching',()=>{
            this.loadUser();
          })
          this.loadRoles();
            this.loadUser();
            Fire.$on('AfterCreate',() =>{
              this.loadUser();
            })
           // setInterval(this.loadUser,3000)
            //console.log('Component mounted.')
        }
    }
</script>
