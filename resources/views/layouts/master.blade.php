<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="X-Frame-Options" content="allow">

  <title>Big Data Analytics</title>

  <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <script type="text/javascript" src="https://public.tableau.com/javascripts/api/tableau-2.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
 </head>
<body class="hold-transition sidebar-mini">

<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-admedika navbar-light">
    <!-- Left navbar links -->
    <!--<ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>-->
 <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars white"></i></a>
        </li>
       
    </ul>
    <!-- SEARCH FORM -->
    
      <div class="input-group input-group-sm ">
        <input class="form-control form-control-navbar" @keyup.enter="searchit" v-model="search" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @onclick="searchit" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    

    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-1"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Big Data</span><span><i style="font-size:10px"> Admedika</i></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional)-->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/user-profile.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{ ucwords(Auth::user()->name) }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
             <router-link to="/home" class="nav-link">
               <i class="nav-icon fas fa-home" ></i>
               <p>
                 Home
               </p>
             </router-link>
            </li>   
            
            <li class="nav-item">
                    <router-link to="/profile" class="nav-link">
                      <i class="nav-icon fas fa-user-alt"></i>
                      <p>
                        Profile
                      </p>
                    </router-link>
            </li> 
           @if(isset($menus['admin']) && count($menus['admin']) > 0 )    
           <li class="nav-item has-treeview">
                <!--<li class="nav-item has-treeview menu-open">-->
            <!--<a href="#" class="nav-link active">-->
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php 
              $color = array(
                'blue','indigo','purple','pink','red','orange','yellow','green','teal','cyan'
              );
              $color_random = array_rand($color,count($color));

              ?>
              <?php $i = 0; ?>
              @foreach($menus['admin'] as $menu)
              
              <li class="nav-item">
              <router-link to="/{{$menu->view}}" class="nav-link">
                    <i class="nav-icon {{ $menu->icons }} {{ $color[$color_random[$i]] }}"></i>
                    <p>
                      {{  ucwords($menu->name) }}
                    </p>
                </router-link>
               </li> 
               <?php $i++; ?>
              @endforeach
             
            </ul>
          </li>
           @endif
           <li class="nav-item has-treeview">
           <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Content
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php 
            $color = array(
              'blue','indigo','purple','pink','red','orange','yellow','green','teal','cyan'
            );
            $color_random = array_rand($color,count($color));
            $i = 0; ?>
              @foreach($menus['users'] as $menu)
              <li class="nav-item">
              <router-link to="/{{$menu->view}}" class="nav-link">
                    <i class="nav-icon {{ $menu->icons }} {{ $color[$color_random[$i]] }}"></i>
                    <p>
                      {{  ucwords($menu->name) }}
                    </p>
                </router-link>
               </li> 
               <?php $i++; ?>
              @endforeach
             
            </ul>
           </li>
          <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
               
                  <i class="nav-icon fas fa-power-off"></i>
                  <p>
                        {{ __('Logout') }}
                  </p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
        </li> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
    </div>
    <div class="content">
            <div class="container-fluid">
            <transition name="page" mode="out-in">
                <router-view></router-view>
             </transition>   
                <vue-progress-bar></vue-progress-bar>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
    
   
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      
    </div>
    <!-- Default to the left -->
    <strong style="display:none;">Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> 
    <strong>Copyright &copy; 2019 <a href="https://admedika.co.id/index.php/en/">Big Data</a>.</strong> <span style="color:red;">Admedika</span>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<script src="{{ asset('js/app.js')  }}"></script>
<script src="{{ asset('js/jquery-ui.js')  }}"></script>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
 
  
})
</script>
</body>
</html>
