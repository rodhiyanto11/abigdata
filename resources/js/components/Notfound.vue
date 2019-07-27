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
                            <div class="col-sm-12 border-right">
                                <div class="description-block">
                                <h5 class="description-header">Page Not Found 404</h5>
                                <router-link to="/home" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Home">
                                    <i class="nav-icon fas fa-home"></i>
                                    
                                </router-link>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            </div>
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
