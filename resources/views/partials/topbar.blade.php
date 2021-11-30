<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('landing.index') }}" class="logo"
       style="font-size: 16px;" target="_blank">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
           @lang('global.global_title')</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
           @lang('global.global_title')</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
  
       <div class="navbar-custom-menu" style="float:left;padding-left:66px;">
                  <ul class="nav navbar-nav">
                    <li class="dropdown messages-menu"> 
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <span class="hidden-xs">Otros informes</span>
                          <i class="ion-chevron-down"></i>
                          <span class="label label-success"></span>
                      </a>
                      <ul class="dropdown-menu" style="width:255px;right:-40px;">
                        <li class="header">Adicionales</li>
                          <li>                  
                             <ul class="menu"> 
                              <li>
                                    <a href="{{route('admin.tenants.inquilinos_renovacion_contrato')}}" style="color:#000000">
                                      <div class="pull-left"> 
                                      <h4>Aumento de Canon</h4>
                                      </div>
                                    </a>
                                   <!-- <a href="https://localhost/encampo/public/customer/ticket_new" style="color:#000000">
                                      <div class="pull-left"> 
                                      <h4>Solicitar soporte</h4>
                                      </div>
                                    </a> -->
                              </li>
                            </ul>
                          </li>
                      </ul>
                    </li>
         
              
            </ul>
          </ul></div>


  <div id="preloader"></div>
        
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>


        

    </nav>



</header>



