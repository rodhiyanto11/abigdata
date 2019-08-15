<style>
    .widget-user-header{
        background-position: center center;
        background-size: cover;
    }
</style>

<template>
    <div class="vld-parent">
        <loading :active.sync="isLoading" 
        :is-full-page="fullPage">
        </loading>
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- please insert your's code in here-->
                    <!-- user card -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header text-white" style="background: url('./img/user-background.jpg');">
                            <!--<h3 class="widget-user-username">Elizabeth Pierce</h3>
                            <h5 class="widget-user-desc">Web Designer</h5>-->
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" v-bind:src="'/img/user-profile.png'" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                <h5 class="description-header">Name<span class="mandatory" >*</span></h5>
                                <span class="description-text">{{ form.name | ucWords }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                <h5 class="description-header">Username<span class="mandatory" >*</span></h5>
                                <span class="description-text">{{ form.username| ucWords }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3">
                                <div class="description-block">
                                <h5 class="description-header">Expired Date</h5>
                                <span class="description-text">{{ form.expired_date | completedate }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <div class="col-sm-3">
                                <div class="description-block">
                                <h5  class="description-header">Roles</h5>
                                     <select name="role_id" id="role_id" v-model="form.role_id"  @change="changerole($event)" class="form-control">
                                            <option v-for="role in roles" :key="role.role_id" :value="role.role_id">{{ role.role_name }}</option>    
                                    </select>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        </div>
                    <!-- end user card -->
                    <!-- form user -->
                    <div class="card card-widget widget-user">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                

                                <div class="tab-pane active" id="settings">
                                    <form class="form-horizontal" @submit.prevent = "updateUser()">
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
                                            <!--<div class="form-group">
                                                    <label>Role</label>
                                                    <select name="role_id" id="role_id" v-model="form.role_id"  class="form-control" :class="{ 'is-invalid': form.errors.has('role_id') }">
                                                         <option v-for="role in roles.data" :key="role.id" :value="role.id" >{{ role.name }}</option>
                                                    </select>
                                                    <has-error :form="form" field="role_id"></has-error>
                                            </div>-->
                                            <div class="form-group">
                                                <label>Password</label>
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
                                            
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-block btn-success" >Update Profile</button>
                                            </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                </div>
                <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    </div>
                    
                    <!-- form user -->
                <!-- end edit code-->
            </div>
        </div>
    </div>
    </div>
  
</template>

<script>
import { setTimeout } from 'timers';
    export default {
        
        data: function(){
            return{
                isLoading : true,
                fullPage: true,
                roles : {},
                form : new form({
                    id : '',
                    name :  '',
                    username :  '',
                    email :  '',
                    password :  '',
                    expired_date :  '',
                    role_id :  '',
                }),

            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods : {
            deadLoading : function(){
                setTimeout(
                    () => {
                        this.isLoading = false
                    } , 1000
                );
            },
            changerole: function(event){
                console.log(event.target.value);
                this.isLoading = true;
                axios.get("api/user?req=update&id="+event.target.value).then(  ({ data }) => (
                    //console.log(data)
                    window.location.href = '/home'
                ) );
                
            },
            loadRoles : function(){
                this.isLoading = true;
                axios.get("api/userrole?req=userrole&id=profile").then(  ({ data }) => (this.roles = data) );
                this.deadLoading();
            },
           loadUser : function(){
               this.isLoading = true;
                axios.get("api/user?getprofile=true").then(  ({ data }) => (this.form.fill(data.data)) );
                this.deadLoading();
            },
            updateUser : function(){
                this.isLoading = true;
                 swal.fire({
                    title: 'Apakah anda yakin untuk mengupdate data anda?',
                    text: "",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Update it!'
                }).then((result) => {
                    if (result.value) {
                    this.$Progress.start();
                    this.form.put('api/user/'+this.form.id)
                    .then((response) => {
                        //Fire.$emit('AfterCreate');
                        this.$Progress.finish()
                        this.deadLoading();
                        toast.fire({
                        type: 'success',
                        title: 'Request sucess, Please re-login'
                        })
                        setTimeout(function(){
                            document.getElementById('logout-form').submit();
                        }, 3000);
                        //setInt document.getElementById('logout-form').submit();
                    },(response)=>{
                        this.deadLoading();
                        this.$Progress.fail()
                        toast.fire({
                        type: 'error',
                        title: 'Request Error'
                        })
                    })
                    
                    }
                })
            },
           

        },
        components: {
            'datepicker' : Datepicker,
            'loading' : Loading
            },
        created () {
            this.loadRoles();
            console.log(this.roles)
            this.loadUser();
             console.log(this.form)
        }    
    }
</script>
