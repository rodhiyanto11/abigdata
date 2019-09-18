<template>
 <div class="vld-parent">
      
        
       <div class='card'>
            <div class="card-header">
                <h3 class="card-title">Pages</h3>
                <div class="card-tools">
                    <button class="btn btn-success" @click="createModal()">
                        <i class="fas fa-user-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body table-responsive p-0" style="">
                <table class="table table-head-fixed">
                  <thead> 
                    <tr>
                      <th>Name</th>
                      <th>Model</th>
                      <th>Controller</th>
                      <th>View</th>
                      <th>Page link</th>
                      <th>Route Name</th>
                      <th>Status</th>
                      <th>Status Page</th>
                      <th>Note</th>
                      <th>Icons</th>
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
                      <td>{{ page.pagelink  }}</td>
                      <td>{{ page.routename | ucWords }}</td>
                      <td>{{ page.status  == 1 ?  'Menu + Route' : ( page.status  == 2 ? 'Route'  : (page.status  == 3 ? 'Tableau' : ( page.status == 4 ? 'Menu' : '(Menu/Tableau)+Parent Page' )) ) }}</td>
                      <td>{{ page.stt_pages == 0 ? 'Tidak Aktif' : 'Aktif' }}</td>
                      <td>{{ page.note }}</td>
                      <td><i :class="page.icons"></i></td>
                      <td>{{ page.created_at | simpledate}}</td>
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
               <pagination :data="pages" v-on:pagination-change-page="getResults" :limit="1">
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
                                <label>Page Link(dashboard tableau)<span class="mandatory" >(contoh : 'views/VASCorporateYKPANTAM-asoff/04_BRANCH_DIAGNOSTIC_DETAILS')</span></label>
                                <input v-model="form.pagelink" type="text" name="pagelink"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('pagelink') }"
                                placeholder="pagelink"
                                >
                                <has-error :form="form" field="pagelink"></has-error>
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
                                          <option value="3">Tableau</option>
                                          <option value="4">Menu</option>
                                          <option value="5">Menu/Tableau)+Parent Page</option>
                                      </select>
                                    <has-error :form="form" field="status"></has-error>
                                </div>
                              <div class="form-group">
                                    <label>Status Pages<span class="mandatory" >*</span></label>
                                     <select name="status" id="status" v-model="form.stt_pages"  class="form-control" :class="{ 'is-invalid': form.errors.has('stt_pages') }">
                                          <option value="0">Tidak Aktif</option>
                                          <option value="1">Aktif</option>
                                      </select>
                                    <has-error :form="form" field="stt_pages"></has-error>
                                </div>  
                            <div class="form-group">
                                    <label>Parent Page<span class="mandatory" >*</span></label>
                                     <select name="parent_id" id="status" v-model="form.parent_id"  class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                                          <option value="0">Head Menu</option>
                                          <option v-for="datapage in pagesall" :key="datapage.id" v-bind:value="datapage.id">{{ datapage.name | ucWords }}</option>
                                      </select>
                                    <has-error :form="form" field="parent_id"></has-error>
                                </div>
                           <div class="form-group">
                                <label>icons Name ref: <a href="https://fontawesome.com/icons?d=gallery&m=free">Font Awesome</a> </label>
                                <input v-model="form.icons" type="text" name="icons"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('icons') }"
                                placeholder="icons"
                                >
                                <has-error :form="form" field="icons"></has-error>
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
            
    
</template>

<script>
import { setTimeout } from 'timers';
    export default {
        data : function(){
            return {
             
              fullPage : true,
                editmode :false,
               
                pages : {},
                pagesall : {},
                form : new form({
                    id          : '',
                    name        : '',
                    model       : '',
                    controller  : '',
                    view        : '',
                    routename   : '',
                    note        : '',
                    create_at   : '',
                    status      : '',
                    pagelink    : '',
                    parent_id   : '',
                    icons       : '',
                    stt_pages   : ''
                })
            }
            
        },
        components : {
          loading : Loading
        },
        methods : {
           
            loadpage : function(){
               
              //console.log(this.$parent.search.length);
              axios.get("/api/pages?req=all")
              .then( ( {data} ) => (this.pagesall = data.data) )

              
               if(this.$parent.search.length == 0){
                 axios.get("/api/pages").then(  ({ data }) => (this.pages = data) );
               
               }else{
                 axios.get("/api/pages?search="+this.$parent.search).then(  ({ data }) => (this.pages = data) );
               
               } 
            },
            
            createModal (){
            // 
               this.editmode = false;
               this.form.reset();
               $('#exampleModal').modal('show');
               
             },
             editModal (user){
             // 
               this.editmode = true;
               this.form.reset();
               $('#exampleModal').modal('show');
               this.form.fill(user);
               
             },
             createRole: function () {
               this.isLoading  = true;
                this.$Progress.start();
                this.form.post('/api/pages')
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
                this.form.put('/api/pages/'+this.form.id)
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
                  this.form.delete('/api/pages/'+id)
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
              
               console.log(page)
                axios.get('/api/pages?page=' + page)
                  .then(response => {
                    this.pages = response.data;
                  });
                
              }
        },
        
        created (){
          this.$parent.searchmode =  true;
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
