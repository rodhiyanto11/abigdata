<template>
  <div class="vld-parent">
    <loading 
      :active.sync="isLoading" 
      :is-full-page="fullPage">
    </loading>
     <div class="container">
       <div class="card">
           <div class="card-header">
                <h3 class="card-title">Role Page {{ this.$route.params.role_data.name | ucWords}} </h3>
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
                      <th>Page Name</th>
                      <th>Create Date</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="datarole in dataroles" :key="datarole.id">
                      <td>{{ datarole.role_name | ucWords }}</td>
                      <td>{{ datarole.page_name | ucWords }}</td>
                      <td>{{ datarole.created_at | completedate}}</td>
                      <td> 
                        <a href="#" data-toggle="tooltip" data-placement="right" title="Delete" @click = "deleterolepage(datarole.id)">
                            <i class="fas fa-trash red" ></i>
                        </a>
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
                                    <label>Role Name<span class="mandatory" >*</span></label>
                                     <select name="role_id" id="role_id" v-model="form.role_id"  class="form-control" :class="{ 'is-invalid': form.errors.has('role_id') }">
                                          <option v-bind:value="rolepages_role_data.id">{{ rolepages_role_data.name | ucWords }}</option>
                                      </select>
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Page Name<span class="mandatory" >*</span></label>
                                     <select name="page_id" id="page_id" v-model="form.page_id"  class="form-control" :class="{ 'is-invalid': form.errors.has('page_id') }">
                                          <option v-for="page in pages" :key="page.id" v-bind:value="page.id">{{ page.name | ucWords }}</option>
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
   </div>       

</template>

<script>
import { setTimeout } from 'timers';
    export default {
        data : function(){
          return {
            isLoading : true,
            fullPage: true,
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
        components : {
          loading : Loading
        },
        methods : {
          deadLoading : function(){
            setTimeout(() => {
              this.isLoading = false;
            },1000);
          },
          handleBackroute : function(){
            this.$router.back('roles');
          },
          loadpages : function(){
            this.isLoading = true;
            axios.get('api/page?req=all')
            .then (({data}) => this.pages = data.data)
            this.deadLoading();
          },
          loadrole : function (){
            this.isLoading = true;
            axios.get('api/role?req=all')
            .then (({data}) => this.roles = data.data)
            this.deadLoading();
          },
          loadpagerole : function (role_data){
                this.isLoading = true;
                if(role_data.length == 0 ){
                  axios.get('api/role?req=pagerole')
                  .then (({data}) => this.dataroles = data)
                }else{
                  if(this.$parent.search.length > 0){
                    axios.get('api/role?req=pagerole&id='+role_data.id+'&search='+this.$parent.search)
                    .then (({data}) => this.dataroles = data)
                  }else{
                    axios.get('api/role?req=pagerole&id='+role_data.id)
                   .then (({data}) => this.dataroles = data)
                  }
                  
                  
                }
                this.deadLoading();
            
          },
          createModal : function(){
            this.isLoading = true;
            console.log(this.rolepages_role_data);
            this.editmode = false;
            this.form.reset()
            $("#exampleModal").modal('show');
            this.deadLoading();
          },
          editModal : function(dataroles){
            this.isLoading = true
              this.editmode = true;
               this.form.reset();
               $('#exampleModal').modal('show');
               this.form.fill(dataroles)
            this.deadLoading();   
          },
          deleterolepage: function(id){
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
                  this.form.get('api/role?req=delete&id='+id)
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
              this.deadLoading();
          },
          create : function(){
            this.isLoading();
             this.$Progress.start();
                this.form.post('api/role')
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
                this.deadLoading();

          },
        },
        created(){
          this.isLoading = true;
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
          this.deadLoading();
        }
    }
</script>
