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
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <script type="text/javascript" src="https://public.tableau.com/javascripts/api/tableau-2.min.js"></script>
    
    <!-- Google Font: Source Sans Pro -->
 </head>
<body class="hold-transition sidebar-mini sidebar-collapse fixed">

<div class="wrapper" id="app">

  <!-- Navbar -->
  {{-- <nav class="main-header navbar navbar-expand navbar-admedika navbar-light" v-show="searchmode" > --}}
  <nav class="main-header navbar navbar-expand navbar-admedika navbar-light"  >
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
       {{-- <a class="nav-link" data-widget="pushmenu" href="#"></a> --}}
        </li>
       
    </ul>
    <!-- SEARCH FORM -->
    <transition 
    name="page" mode="out-in"
    >
      <div class="form-inline ml-3">
        <div class="input-group input-group-sm " v-show="searchmode">
          <input class="form-control form-control-navbar"  @keyup.enter="searchit" v-model="search" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" @onclick="searchit" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </div>
    </transition>
    <ul class="navbar-nav ml-auto">
     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown show">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
        <div class="user-panel mt-10 pb-3 mb-3 d-flex" data-toggle="tooltip" data-placement="left" title="Hello {{ ucwords(Auth::user()->name) }}">
          <div class="image">
          <img src="{{ asset('img/profile/') }}{{'/'.Auth::user()->photo}}" class="img-circle elevation-2" alt="User Image" >
          </div>
        </div>  
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
          
          <router-link to="/profile" class="dropdown-item">
            <i class="fas fa-user-astronaut mr-2 float-right"></i>My profile
          </router-link>
          
          {{-- <a href="#" class="dropdown-item">
            <i class="fas fa-power-off mr-2"></i> logout
          </a> --}}
          <a href="{{ route('logout') }}" class="dropdown-item"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                  <i class="fas fa-power-off mr-2 float-right"></i>{{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
         
      </li>
    </ul>
    

    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  
    <router-link to="/home" class="brand-link">
    <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-1">
      <span class="brand-text font-weight-light">Big Data</span><span><i style="font-size:10px"> Admedika</i></span>
    </router-link

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional)-->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/user-profile.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{ ucwords(Auth::user()->name) }}</a>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            {{-- <li class="nav-item">
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
            </li>  --}}
              <?php $pages = $menus['menu'] ?>
              
              @for($i= 0 ; $i < count($pages) ; $i++)
                  @if(isset($pages[$i]['submenu']))
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                      <i class="nav-icon {{$pages[$i]['icons']}}"></i>
                        <p>
                          {{ $pages[$i]['name'] }}
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                   
                    <ul class="nav nav-treeview">
                    @for($j = 0 ; $j < count($pages[$i]['submenu']) ; $j++)
                      @if(isset($pages[$i]['submenu'][$j]['submenu']))
                      <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                          <i class="nav-icon {{ $pages[$i]['submenu'][$j]['icons'] }}"></i>
                            <p>
                              {{ $pages[$i]['submenu'][$j]['name'] }}
                              <i class="right fas fa-angle-left"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                              @for($k = 0 ; $k < count($pages[$i]['submenu'][$j]['submenu']) ; $k++)
                              @if(isset($pages[$i]['submenu'][$j]['submenu'][$k]['submenu']))
                              <li class="nav-item has-treeview">
                                  <a href="#" class="nav-link">
                                    <i class="nav-icon {{$pages[$i]['submenu'][$j]['submenu'][$k]['icons']}}"></i>
                                    <p>
                                      {{ $pages[$i]['submenu'][$j]['submenu'][$k]['name'] }}
                                      <i class="right fas fa-angle-left"></i>
                                    </p>
                                  </a>
                                </li>
                              @else
                              <li class="nav-item">
                                  <router-link :to="{{ $pages[$i]['submenu'][$j]['submenu'][$k]['pagelink'] }}" class="nav-link">
                                    
                                      <i class="nav-icon {{ $pages[$i]['submenu'][$j]['submenu'][$k]['icons'] }}" ></i>
                                      <p>
                                          {{ $pages[$i]['submenu'][$j]['submenu'][$k]['name'] }}
                                      </p>
                                    </router-link>
                                  </li>
                              @endif
                              @endfor
                          </ul>
                        </li>
                      @else
                      <li class="nav-item">
                          <router-link :to="{{ $pages[$i]['submenu'][$j]['pagelink']}}" class="nav-link">
                            
                          <i class="nav-icon {{ $pages[$i]['submenu'][$j]['icons'] }}" ></i>
                              <p>
                                {{ $pages[$i]['submenu'][$j]['name']}}
                              </p>
                            </router-link>
                          </li>
                      @endif
                    @endfor
                    </ul>
                  </li>
                  @else
                  <li class="nav-item">
                      <router-link :to="{{ $pages[$i]['pagelink'] }}" class="nav-link">
                        
                          <i class="nav-icon {{ $pages[$i]['icons'] }}" ></i>
                          <p>
                              {{ $pages[$i]['name'] }} 
                          </p>
                        </router-link>
                      </li>
                  @endif
               @endfor     
              {{-- <li class="nav-item">
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
        </li>  --}}
      
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <a href="#" class="float">
      <i class="fa fa-bars my-float nav-link" data-widget="pushmenu" style="position: relative;
      top: 15%;
      transform: translateY(-50%);">
      </i>
      </a>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
    </div>
    <div class="content">
          
            <div class="container-fluid" >
            
           <!-- <transition 
            name="page" 
            mode="out-in"
            >-->
            
            <transition 
            name="page" mode="out-in"
            >
                <router-view ></router-view>
             </transition>   
                <vue-progress-bar></vue-progress-bar>
              <!-- /.row -->
             
            </div><!-- /.container-fluid -->
          </div>
    
   
  </div>
  <!-- /.content-wrapper -->
  <div>
    {{-- <br><br><br>
    <br><br><br> --}}
  </div>
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      
    </div>
    <!-- Default to the left -->
    <strong style="display:none;">Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> 
    <center><strong>Copyright &copy; 2019 <a href="https://admedika.co.id/index.php/en/">Big Data</a>.</strong> <span style="color:red;">Admedika</span></center>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<script src="{{ asset('js/app.js')  }}"></script>
<script src="{{ asset('js/jquery-ui.js')  }}"></script>

<script>
  $(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
 
  
})
      var viz;
      var workbook;
      var containerDiv;
function initViz(params, sheetexc) {
 
  console.log('tableau is updated....')
  dispose();
            var containerDiv = document.getElementById("refs"),
                url = params,
                options = {
                    hideTabs: true,
                    hideToolbar: true,
                   onFirstInteractive: function() {

                    workbook = viz.getWorkbook();
                    dash = viz.getWorkbook().getActiveSheet();
                    workbook.activateSheetAsync(dash)
                      .then(function(dashboard) {
                        
                        var worksheets = dashboard.getWorksheets();
                        
                        var sheetNames = [];
                        
                        for (var i = 0, len = worksheets.length; i < len; i++) {

                          var sheet = worksheets[i];
                          sheetNames.push(sheet.getName());
                        }

                        var sel = document.getElementById('SheetList');
                        var fragment = document.createDocumentFragment();
                        if(sheetexc !=null){
                            sheetNames = sheetexc;
                        }
                        sheetNames.forEach(function(sheetName, index) {

                          var opt = document.createElement('option');
                          var shettemp = sheetName.length;
                          if(shettemp == 2){
                              opt.innerHTML = sheetName[1];
                              opt.value = sheetName[0];
                          } else {

                              opt.innerHTML = sheetName;
                              opt.value = sheetName;
                          }
                          fragment.appendChild(opt);
                        });

                        sel.appendChild(fragment);

                      });
                  }
                };

            viz = new tableau.Viz(containerDiv, url, options); 
            
        }
        function exportToPDF() {
            viz.showExportPDFDialog();
        }
        function getVizData() {
             options = {
              
                maxRows: 0, // Max rows to return. Use 0 to return all rows
                ignoreAliases: false,
                ignoreSelection: true,
                includeAllColumns: false
              };

              sheet = viz.getWorkbook().getActiveSheet();

              //if active tab is a worksheet, get data from that sheet
              if (sheet.getSheetType() === 'worksheet') {
                sheet.getUnderlyingDataAsync(options).then(function(t) {
                  buildMenu(t);
                });

                //if active sheet is a dashboard get data from a specified sheet
              } else {
                worksheetArray = viz.getWorkbook().getActiveSheet().getWorksheets();
                  
                if(document.getElementById("SheetList") != null){
                    for (var i = 0; i < worksheetArray.length; i++) {
                      worksheet = worksheetArray[i];
                      sheetName = worksheet.getName();
                          //get user's selection from dropdown of sheets
                          var selectedVal = document.getElementById("SheetList").value;

                          //get the data from the selected sheet
                          if (sheetName == selectedVal) {
                            viz.showExportCrossTabDialog(sheetName);
                          }

                    }
                } else {
                       
                    viz.showExportCrossTabDialog();

                }
              }
        }
        function dispose() {

            if (viz == null) {
                console.log("No Viz has been rendered, so I can't dispose anything");
                return;
            } else {
                viz.dispose();
            }
        }
        function vizResize() {
            var width = document.getElementById("resizeWidth").value;
            var height = document.getElementById("resizeHeight").value;

              viz.setFrameSize(parseInt('100%', 10), parseInt('100%', 10));
            }
        function getJson(url,data){
       // console.log(data);
            return JSON.parse(jQuery.ajax({
                type : "GET",
                url : url,
                data : data,
                dataType : "json",
                global : false,
                async : false,
                beforeSend: function(request){
                   // request.setRequestHeader("HTTP_X_REQUESTED_WITH",'xmlhttprequest')

                    //swal("loading");
                },
                success : function(msg){
                    //swal.close();
                }
            }).responseText);
        }
        
</script>
</body>
</html>
