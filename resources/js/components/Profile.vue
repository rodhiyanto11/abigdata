<style>
    .widget-user-header{
        background-position: center center;
        background-size: cover;
    }
</style>

<template>
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
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                <h5 class="description-header">Name</h5>
                                <span class="description-text">{{ form.name | ucWords }}LES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                <h5 class="description-header">Username</h5>
                                <span class="description-text">{{ form.username| ucWords }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                <h5 class="description-header">Expired Date</h5>
                                <span class="description-text">{{ form.expired_date | completedate }}</span>
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
                                                <label>Name</label>
                                                <input v-model="form.name" type="text" name="name"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"
                                                placeholder="name"
                                                >
                                                <has-error :form="form" field="name"></has-error>
                                            </div>
                                            <div class="form-group">
                                                    <label>Username</label>
                                                    <input v-model="form.username" type="text" name="username"
                                                    class="form-control" :class="{ 'is-invalid': form.errors.has('username') }"
                                                    placeholder="username"
                                                    >
                                                    <has-error :form="form" field="username"></has-error>
                                                </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input v-model="form.email" type="email" name="email"
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }"
                                                placeholder="email"
                                                >
                                                <has-error :form="form" field="email"></has-error>
                                            </div>
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
                                                    <label>Date</label>
                                                    <datepicker  :bootstrap-styling="true"  v-model="form.expired_date" name="expired_date"
                                                    :class="{ 'is-invalid': form.errors.has('expired_date') }"
                                                    placeholder="expired_date" >
                                                    </datepicker>
                                                    <has-error :form="form" field="expired_date"></has-error>
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
</template>

<script>
    export default {
        data: function(){
            return{
                form : new form({
                    id : '',
                    name :  '',
                    username :  '',
                    email :  '',
                    password :  '',
                    expired_date :  '',
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods : {
           loadUser : function(){
                axios.get("api/user?=getsession=true").then(  ({ data }) => (this.form.fill(data.data[0])) );
            },
            updateUser : function(){
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
           

            /*updateProfile(e){
                //console.log('uploading')
                let file = e.targ   et.files[0];
                let reader = new FileReader();
                reader.onloadend = function() {
                    console.log('RESULT', reader.result)
                }
                reader.readAsDataURL(file);
            }*/
        },
        components: {
            'datepicker' : Datepicker,
          
            },
        created () {
            this.loadUser()
        }    
    }
</script>
