<template>
    <div class="container">
       <div class="card">
           <div class="card-header">
                <h3 class="card-title">Role Page</h3>
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
                        <a href="#" data-toggle="tooltip" data-placement="left" title="Edit" @click = "editModal(datarole)" >
                            <i class="fas fa-edit blue" ></i>
                        </a> 
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
                                          <option v-for="role in roles" :key="role.id" v-bind:value="role.id">{{ role.name | ucWords }}</option>
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
</template>

<script>
    export default {
        data : function(){
          return {
            editmode : false,
            dataroles : {},
            roles : {},
            pages : {},
            
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
          loadpages : function(){
            axios.get('api/page?req=all')
            .then (({data}) => this.pages = data.data)
          },
          loadrole : function (){
            axios.get('api/role?req=all')
            .then (({data}) => this.roles = data.data)
          },
          loadpagerole : function (){
            axios.get('api/role?req=pagerole')
            .then (({data}) => this.dataroles = data)
          },
          createModal : function(){
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
          deleterolepage: function(){
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
                  this.form.delete('api/role/'+id+'/rolepages')
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
                this.form.post('api/role')
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
                  //  $("#exampleModal") .modal('hide');
                    toast.fire({
                      type: 'error',
                      title: 'Request Error'
                    })
                })

          },
          update : function (){
            console.log(2);
          },
          /*addRoute: function() {
          /*axios.get('http://127.0.0.1:8000/api/user?req=menu&id=4')
          .then(response => {
           
               response.data.data.forEach(type => {
                   var com = './'+type.model+'s.vue';
                  
                    this.$router.addRoutes(
                    [{
                      path: '/'+type.view,
                      component: require(''+com+'').default
                    }
                    ]);
               });
                
                    
                /*this.$router.addRoutes(
                        [{
                          path: '/pages',
                          component: require('./Pages.vue').default
                        }])  */     
             
            //})
             //.catch(error => {
              
            //});*/
           /* axios.get('http://127.0.0.1:8000/api/user?req=menu')
          .then(response => {
           
               response.data.data.forEach(type => {
                   var com = './'+type.model+'s.vue';
                  console.log(com);
                    this.$router.addRoutes(
                    [{
                      path: '/'+type.view,
                      component: require(''+com+'').default
                    }
                    ]);
               });
                
                    
                /*this.$router.addRoutes(
                        [{
                          path: '/pages',
                          component: require('./Pages.vue').default
                        }])   */    
             
           // })
           // .catch(error => {
              
            //});
          //}*/
        },
        created(){
          this.loadpages();
          this.loadrole();
          this.loadpagerole();
          //this.addRoute();
          Fire.$on('AfterCreate',() =>{
              this.loadpagerole();
            })
        }
    }
</script>
