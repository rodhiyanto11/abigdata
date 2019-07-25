<template>
    <div class="container">
       <div class="card">
           <div class="card-header">
                <h3 class="card-title">Users</h3>
                <div class="card-tools">
                    <button class="btn btn-success" @click="createModal">
                        <i class="fas fa-user-plus"></i>
                    </button>
                </div> 
            </div>
             <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Create Date</th>
                      <th>Expired Date</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <!--<tbody>
                    <tr v-for="user in users.data" :key="user.id">
                      <td>{{ user.name | ucWords }}</td>
                      <td>{{ user.username | ucWords }}</td>
                      <td>{{ user.created_at | completedate}}</td>
                      <td>{{ user.expired_date | completedate}}</td>
                      <td>
                        <a href="#" data-toggle="tooltip" data-placement="left" title="Edit" @click = "editModal(user)" >
                            <i class="fas fa-edit blue" ></i>
                        </a> 
                        <a href="#" data-toggle="tooltip" data-placement="right" title="Delete" @click = "deleteUser(user.id)">
                            <i class="fas fa-trash red" ></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>-->
                </table>
              </div>
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
                        <form  @submit.prevent = "yy">
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
                                        <label>Date</label>
                                        <datepicker  :bootstrap-styling="true"  v-model="form.expired_date" name="expired_date"
                                        :class="{ 'is-invalid': form.errors.has('expired_date') }"
                                         placeholder="expired_date" >
                                        </datepicker>
                                        <has-error :form="form" field="expired_date"></has-error>
                                </div>
                                <div class="form-group">
                                        <label>Role</label>
                                        <select name="role_id" id="role_id" v-model="form.role_id"  class="form-control" :class="{ 'is-invalid': form.errors.has('role_id') }">
                                          <option v-for="role in roles.data" :key="role.id">{{ role.name }}</option>
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
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
