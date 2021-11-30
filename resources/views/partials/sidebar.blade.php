@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             
            <!--
            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>
            -->

            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('permission_access')
                <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.permissions.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan

           
                
               @can('property_access')
                <li class="{{ $request->segment(2) == 'properties' ? 'active' : '' }}">
                    <a href="{{ route('admin.properties.index') }}">
                        <i class="fa fa-home"></i>
                        <span class="title">@lang('global.properties.title')</span>
                    </a>
                </li>

                <!-- <li class="{{ $request->segment(2) == 'properties_sub' ? 'active' : '' }}">
                    <a href="{{ route('admin.properties_sub.index') }}">
                        <i class="fa fa-gears"></i>
                        <span class="title">SubPropiedades</span>
                    </a>
                </li>-->
                @endcan
              
               


            @can('property_access')
                <!--<li class="{{ $request->segment(2) == 'properties' ? 'active' : '' }}">
                    <a href="{{ route('admin.properties.index') }}">
                        <i class="fa fa-gears"></i>
                        <span class="title">@lang('global.properties.title')</span>
                    </a>
                </li>-->

                <li class="{{ $request->segment(2) == 'tenants' ? 'active' : '' }}">
                    <a href="{{ route('admin.tenants.index') }}">
                        <i class="fa fa-building"></i>
                        <span class="title">@lang('global.tenants.title')</span>
                    </a>
                </li>
            @endcan

            <!-- @can('properties_facturas_access')
            <li class="{{ $request->segment(2) == 'facturas' ? 'active' : '' }}">
                <a href="{{ route('admin.properties_facturas.index') }}">
                    <i class="fa fa-money"></i>
                    <span class="title">@lang('global.facturas.title')</span>
                </a>
            </li>
            @endcan-->

             @can('properties_pagos_access')
            <li class="{{ $request->segment(2) == 'pagos' ? 'active' : '' }}">
                <a href="{{ route('admin.properties_pagos.index') }}">
                    <i class="fa fa-camera-retro"></i>
                    <span class="title">@lang('global.pagos.title')</span>
                </a>
            </li>
            @endcan

            @can('document_access')
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">Informes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('permission_access')
                <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.properties_propietarios.indextotal') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                               Propietarios
                            </span>
                        </a>
                    </li>
                @endcan
                @can('role_access')
                <!--<li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.properties_facturas.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                               Inquilinos
                            </span>
                        </a>
                    </li>-->
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.properties_sub.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                              Unidades
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
          
            
            @can('document_access')
            <li class="{{ $request->segment(2) == 'documents' ? 'active' : '' }}">
                <a href="{{ route('admin.system_params.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">Parametros</span>
                </a>
            </li>
            @endcan
            
           <!-- @can('note_access')
            <li class="{{ $request->segment(2) == 'notes' ? 'active' : '' }}">
                <a href="{{ route('admin.notes.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('global.notes.title')</span>
                </a>
            </li>
            @endcan-->
            

            

            
          <!--  @php ($unread = App\MessengerTopic::countUnread())
            <li class="{{ $request->segment(2) == 'messenger' ? 'active' : '' }} {{ ($unread > 0 ? 'unread' : '') }}">
                <a href="{{ route('admin.messenger.index') }}">
                    <i class="fa fa-envelope"></i>

                    <span class="title">Mensajes</span>
                    @if($unread > 0)
                        {{ ($unread > 0 ? '('.$unread.')' : '') }}
                    @endif
                </a>
            </li>
            <style>
                .page-sidebar-menu .unread * {
                    font-weight:bold !important;
                }
            </style>-->



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
            <li>
                <a style="margin-top: 122px;">
                    <i class=""></i>
                    <span class="title">Fecha y hora del servidor:<br/>
                    {{$zona_horaria->toFormattedDateString()}} / 
                    {{date("g:i a", strtotime($zona_horaria->toTimeString()))}}
                    
                    <br/></span>
                </a>
            </li>
        </ul>
    </section>
</aside>

<style>
.title {
    color: #fff;
}
</style>

