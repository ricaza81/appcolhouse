<?php

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

//Route::get('/', function () { return redirect('/admin/home'); });
//Route::get('/', function () { return redirect('/admin/properties'); });
Route::get('/', function () { return redirect('welcome'); });

// Landing Routes...
$this->get('welcome', 'LandingController@welcome')->name('landing.index');
Route::get('contacto/{id}', 'LandingController@contacto')->name('landing.contacto');
Route::post('contacto/{id}', 'LandingController@contacto')->name('landing.contacto');
Route::post('landing.store', 'LandingController@store')->name('landing.store');
Route::get('contacto2', 'LandingController@contacto2')->name('landing.contacto2');
Route::get('publicar', 'LandingController@publicar')->name('landing.publicar');
Route::get('respuestapublicacion/{id}', 'LandingController@respuestapublicacion')->name('landing.respuestapublicacion');
Route::post('respuestapublicacion/{id}', 'LandingController@respuestapublicacion')->name('landing.respuestapublicacion');
//Route::post('respuestapublicacion', 'LandingController@respuestapublicacion')->name('landing.respuestapublicacion');
//Route::post('landing.storepublicar', 'LandingController@storepublicar')->name('landing.storepublicar');
//Route::post('contacto2', 'LandingController@contacto2')->name('landing.contacto2');
//$this->get('contacto2', 'LandingController@contacto2')->name('landing.contacto2');
$this->get('busqueda', 'LandingController@busqueda')->name('landing.busqueda');
//$this->post('contacto/{id}', 'LandingController@contacto')->name('landing.contacto');
//$this->post('busqueda', 'LandingController@busqueda')->name('landing.busqueda');
//Route::post('busqueda', ['uses' => 'LandingController@busqueda', 'as' => 'busqueda']);
//Route::resource('landing2', 'LandingController');
Route::post('busqueda', ['uses' => 'LandingController@busqueda', 'as' => 'landing2.busqueda']);
//Route::get('landing.contacto2', ['uses' => 'LandingController@contacto2', 'as' => 'landing.contacto2']);
/*Route::get('landing.contacto/{id}', ['uses' => 'LandingController@contacto', 'as' => 'landing.contacto']);
Route::post('landing.contacto/{id}', ['uses' => 'LandingController@contacto', 'as' => 'landing.contacto']);*/

/*$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');*/

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

//Sin registro
Route::group(['middleware' => 'guest'], function () {

   // Route::post('landing.storepublicar', 'LandingController@storepublicar')->name('landing.storepublicar');
     Route::post('landing.storepublicar', ['as' =>'landing.storepublicar', 'uses' => 'LandingController@storepublicar']);

});
    

// Registration Routes..
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

$this->get('invitation/{invitation_token}', 'Auth\RegisterController@processInvitation')->name('auth.invitation');

Route::group(['middleware' => ['auth', 'check_invitation'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    //Route::get('/home', 'HomeController@index');
    Route::get('/properties', 'HomeController@index');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    //Properties
    Route::resource('properties', 'Admin\PropertiesController');
    Route::get('properties_index_tabla', ['uses' => 'Admin\PropertiesController@index_tabla', 'as' => 'properties.index_tabla']);
    Route::post('properties_mass_destroy', ['uses' => 'Admin\PropertiesController@massDestroy', 'as' => 'properties.mass_destroy']);
    Route::post('properties_restore/{id}', ['uses' => 'Admin\PropertiesController@restore', 'as' => 'properties.restore']);
    Route::delete('properties_perma_del/{id}', ['uses' => 'Admin\PropertiesController@perma_del', 'as' => 'properties.perma_del']);
    //Properties

      //Propietarios
    Route::resource('properties_propietarios', 'Admin\PropertiesPropietariosController');
    Route::get('properties_propietarios_create/{id}', ['uses' => 'Admin\PropertiesPropietariosController@create', 'as' => 'properties_propietarios.create']);
   
    Route::post('properties_propietarios_create/{id}', ['uses' => 'Admin\PropertiesPropietariosController@create', 'as' => 'properties_propietarios.create']);
    Route::get('properties_propietarios.index/{id}', ['uses' => 'Admin\PropertiesPropietariosController@index', 'as' => 'properties_propietarios.index']);
     Route::get('properties_propietarios.indextotal', ['uses' => 'Admin\PropertiesPropietariosController@indextotal', 'as' => 'properties_propietarios.indextotal']);
      Route::get('properties_propietarios.informe_propietario', ['uses' => 'Admin\PropertiesPropietariosController@informe_propietario', 'as' => 'properties_propietarios.informe_propietario']);
     Route::post('properties_propietarios.informe_fechas', ['uses' => 'Admin\PropertiesPropietariosController@informe_fechas', 'as' => 'properties_propietarios.informe_fechas']);
      Route::get('properties_propietarios.informe_fechas', ['uses' => 'Admin\PropertiesPropietariosController@informe_fechas', 'as' => 'properties_propietarios.informe_fechas']);
    /*Route::get('properties_index_tabla', ['uses' => 'Admin\PropertiesController@index_tabla', 'as' => 'properties.index_tabla']);
    Route::post('properties_mass_destroy', ['uses' => 'Admin\PropertiesController@massDestroy', 'as' => 'properties.mass_destroy']);
    Route::post('properties_restore/{id}', ['uses' => 'Admin\PropertiesController@restore', 'as' => 'properties.restore']);
    Route::delete('properties_perma_del/{id}', ['uses' => 'Admin\PropertiesController@perma_del', 'as' => 'properties.perma_del']);*/
    //Propietarios

    //Properties Facturas Pagos//
    Route::resource('properties_pagos', 'Admin\PropertiesPagosController');
    Route::get('properties_pagos_create/{id}', ['uses' => 'Admin\PropertiesPagosController@create', 'as' => 'properties_pagos.create']);
    Route::post('properties_pagos_create/{id}', ['uses' => 'Admin\PropertiesPagosController@create', 'as' => 'properties_pagos.create']);
    Route::get('properties_pagos.imprimirpago/{id}', ['uses' => 'Admin\PropertiesPagosController@imprimirpago', 'as' => 'properties_pagos.imprimirpago']);
    Route::delete('properties_pagos__perma_del/{id}', ['uses' => 'Admin\PropertiesPagosController@perma_del', 'as' => 'properties_pagos.perma_del']);  
    Route::post('properties_pagos_restore/{id}', ['uses' => 'Admin\PropertiesPagosController@restore', 'as' => 'properties_pagos.restore']);
     Route::post('properties_pagos_mass_destroy', ['uses' => 'Admin\PropertiesPagosController@massDestroy', 'as' => 'properties_pagos.mass_destroy']);
     Route::get('properties_pagos.pagos_propiedad_consulta/{id}', ['uses' => 'Admin\PropertiesPagosController@facturas_propiedad_consulta', 'as' => 'properties_facturas.facturas_propiedad_consulta']);
    //Properties Facturas Pagos//

        //facturas propiedades
    Route::get('properties_facturas.facturas_propiedad_consulta/{id}', ['uses' => 'Admin\PropertiesFacturasController@facturas_propiedad_consulta', 'as' => 'properties_facturas.facturas_propiedad_consulta']);
     Route::get('properties_facturas.facturas_vencidas_propiedad_consulta/{id}', ['uses' => 'Admin\PropertiesFacturasController@facturas_vencidas_propiedad_consulta', 'as' => 'properties_facturas.facturas_vencidas_propiedad_consulta']);
     Route::post('properties_facturas_restore/{id}', ['uses' => 'Admin\PropertiesFacturasController@restore', 'as' => 'properties_facturas.restore']);
    Route::delete('properties_facturas__perma_del/{id}', ['uses' => 'Admin\PropertiesFacturasController@perma_del', 'as' => 'properties_facturas.perma_del']);
    //Route::name('print')->get('/imprimir', 'PropertiesFacturasController@imprimir');
    //facturas propiedades
    Route::get('properties_facturas.imprimir/{id}', ['uses' => 'Admin\PropertiesFacturasController@imprimir', 'as' => 'properties_facturas.imprimir']);

     //SubProperties
    Route::resource('properties_sub', 'Admin\PropertiesSubController');
    
    Route::get('properties_sub_create/{id}', ['uses' => 'Admin\PropertiesSubController@create', 'as' => 'properties_sub.create']);

    Route::post('properties_sub_create/{id}', ['uses' => 'Admin\PropertiesSubController@create', 'as' => 'properties_sub.create']);
 //Route::get('properties_sub_store/{id}', ['uses' => 'Admin\PropertiesSubController@store', 'as' => 'properties_sub.store']);
    Route::post('properties_sub_store', ['uses' => 'Admin\PropertiesSubController@store', 'as' => 'properties_sub.store']);

    //editar subpropiedad
     Route::get('properties_sub_edit/{id}', ['uses' => 'Admin\PropertiesSubController@edit', 'as' => 'properties_sub.edit']);
    
    Route::post('properties_sub_mass_destroy', ['uses' => 'Admin\PropertiesSubController@massDestroy', 'as' => 'properties_sub.mass_destroy']);
    Route::post('properties_sub_restore/{id}', ['uses' => 'Admin\PropertiesSubController@restore', 'as' => 'properties_sub.restore']);
    Route::delete('properties_sub__perma_del/{id}', ['uses' => 'Admin\PropertiesSubController@perma_del', 'as' => 'properties_sub.perma_del']);
    Route::get('properties_sub.unidades_consulta/{id}', ['uses' => 'Admin\PropertiesSubController@unidades_consulta', 'as' => 'properties_sub.unidades_consulta']);
    Route::post('properties_sub_store_nuevo_canon', ['uses' => 'Admin\PropertiesSubController@store_nuevo_canon', 'as' => 'properties_sub.store_nuevo_canon']);
    //SubProperties

//<------->
    //Properties Facturas//
    Route::resource('properties_facturas', 'Admin\PropertiesFacturasController');
    //facturas subpropiedades
    Route::get('properties_facturas.facturas_consulta/{id}', ['uses' => 'Admin\PropertiesFacturasController@facturas_consulta', 'as' => 'properties_facturas.facturas_consulta']);
    Route::get('properties_facturas_create/{id}', ['uses' => 'Admin\PropertiesFacturasController@create', 'as' => 'properties_facturas.create']);
    //facturas subpropiedades
    //facturas propiedades
    Route::get('properties_facturas.facturas_propiedad_consulta/{id}', ['uses' => 'Admin\PropertiesFacturasController@facturas_propiedad_consulta', 'as' => 'properties_facturas.facturas_propiedad_consulta']);
    //facturas propiedades
    //Properties Facturas//
//<------->
//<------->

    //facturas subpropiedades
    Route::get('properties_facturas.facturas_consulta/{id}', ['uses' => 'Admin\PropertiesFacturasController@facturas_consulta', 'as' => 'properties_facturas.facturas_consulta']);
    //facturas subpropiedades
 


   
//<------->
    //Tenants
    Route::resource('tenants', 'Admin\TenantsController');
    //Tenants_Propiedad
    Route::get('tenants.inquilinos_consulta/{id}', ['uses' => 'Admin\TenantsController@inquilinos_consulta', 'as' => 'tenants.inquilinos_consulta']);
    Route::get('tenants.informe_inquilinos_consulta/{id}', ['uses' => 'Admin\TenantsController@informe_inquilinos_consulta', 'as' => 'tenants.informe_inquilinos_consulta']);
    Route::post('tenants.informe_inquilinos_consulta/{id}', ['uses' => 'Admin\TenantsController@informe_inquilinos_consulta', 'as' => 'tenants.informe_inquilinos_consulta']);
    Route::post('tenants.informe_inquilinos_consulta_fechas', ['uses' => 'Admin\TenantsController@informe_inquilinos_consulta_fechas', 'as' => 'tenants.informe_inquilinos_consulta_fechas']);
    Route::get('tenants.imprimir_informe', ['uses' => 'Admin\TenantsController@imprimir_informe', 'as' => 'tenants.imprimir_informe']);
    Route::get('tenants.enviar_informe', ['uses' => 'Admin\TenantsController@enviar_informe', 'as' => 'tenants.enviar_informe']);
//<!--renovacion_contratos-->
     Route::get('tenants.inquilinos_renovacion_contrato', ['uses' => 'Admin\TenantsController@inquilinos_renovacion_contrato', 'as' => 'tenants.inquilinos_renovacion_contrato']);
//<!--renovacion_contratos-->

    Route::post('tenants.enviar_informe', ['uses' => 'Admin\TenantsController@enviar_informe', 'as' => 'tenants.enviar_informe']);
    Route::post('tenants.imprimir_informe', ['uses' => 'Admin\TenantsController@imprimir_informe', 'as' => 'tenants.imprimir_informe']);

    Route::post('tenants.export_informe_excel', ['uses' => 'Admin\TenantsController@export_informe_excel', 'as' => 'tenants.export_informe_excel']);
     /*Route::get('tenants.crearEXCEL/{id}', ['uses' => 'Admin\TenantsController@crearEXCEL', 'as' => 'tenants.crearEXCEL']);
     Route::post('tenants.crearEXCEL/{id}', ['uses' => 'Admin\TenantsController@crearEXCEL', 'as' => 'tenants.crearEXCEL']);*/

      Route::get('tenants.crearEXCEL', ['uses' => 'Admin\TenantsController@crearEXCEL', 'as' => 'tenants.crearEXCEL']);
     Route::post('tenants.crearEXCEL', ['uses' => 'Admin\TenantsController@crearEXCEL', 'as' => 'tenants.crearEXCEL']);
      Route::post('tenants.crearEXCELquery', ['uses' => 'Admin\TenantsController@crearEXCELquery', 'as' => 'tenants.crearEXCELquery']);
       Route::get('tenants.crearEXCELview', ['uses' => 'Admin\TenantsController@crearEXCELview', 'as' => 'tenants.crearEXCELview']);
     Route::post('tenants.crearEXCELview', ['uses' => 'Admin\TenantsController@crearEXCELview', 'as' => 'tenants.crearEXCELview']);
     //->download('reporte.xlsx');

    //Tenants_Propiedad
    //Tenants_Propiedad_Unidad
    Route::get('tenants.inquilinos_consulta_unidad/{id}', ['uses' => 'Admin\TenantsController@inquilinos_consulta_unidad', 'as' => 'tenants.inquilinos_consulta_unidad']);
    //Tenants_Propiedad_Unidad
    //Crear_Tenant_Propiedad_Unidad
    Route::get('create_tenant_propiedad_unidad/{id}', ['uses' => 'Admin\TenantsController@create_tenant_propiedad_unidad', 'as' => 'tenants.create_tenant_propiedad_unidad']);
    //Crear_Tenant_Propiedad_Unidad
    //Consultar Facturas por Tenant//
     Route::get('properties_facturas.facturas_tenant/{id}', ['uses' => 'Admin\PropertiesFacturasController@facturas_tenant', 'as' => 'properties_facturas.facturas_tenant']);
    //Consultar Facturas por Tenant//

       //Consultar Facturas Vencidas por Tenant//
     Route::get('properties_facturas.facturas_tenant_vencidas/{id}', ['uses' => 'Admin\PropertiesFacturasController@facturas_tenant_vencidas', 'as' => 'properties_facturas.facturas_tenant_vencidas']);
    //Consultar Facturas por Tenant//

    //Borrar Tenant
      Route::post('tenants_mass_destroy', ['uses' => 'Admin\TenantsController@massDestroy', 'as' => 'tenants.mass_destroy']);
    //Borrar Tenant
    //Restaurar Tenant
      Route::post('tenants_restore/{id}', ['uses' => 'Admin\TenantsController@restore', 'as' => 'tenants.restore']);
    //Restart Tenant
    //Borra del todo
      Route::delete('tenants_perma_del/{id}', ['uses' => 'Admin\TenantsController@perma_del', 'as' => 'tenants.perma_del']);
    //Borrar del todo
    //Tenants

 //Properties Seguros
    Route::resource('properties_seguros', 'Admin\PropertiesSegurosController');
    Route::get('properties_seguros_create/{id}', ['uses' => 'Admin\PropertiesSegurosController@create', 'as' => 'properties_seguros.create']);
    Route::post('properties_seguros_create/{id}', ['uses' => 'Admin\PropertiesSegurosController@create', 'as' => 'properties_seguros.create']);
    Route::post('properties_seguros_mass_destroy', ['uses' => 'Admin\PropertiesSegurosController@massDestroy', 'as' => 'properties_seguros.mass_destroy']);
    Route::post('properties_seguros_restore/{id}', ['uses' => 'Admin\PropertiesSegurosController@restore', 'as' => 'properties_seguros.restore']);
    Route::delete('properties_seguros_perma_del/{id}', ['uses' => 'Admin\PropertiesSegurosController@perma_del', 'as' => 'properties_seguros.perma_del']);
//Properties Seguros

//Deducciones Propietarios
    Route::resource('propietarios_deducciones', 'Admin\PropietariosDeduccionesController');
     Route::get('propietarios_deducciones_edit/{id}', ['uses' => 'Admin\PropertiesDeduccionesController@edit', 'as' => 'properties_propietarios.editdeduccion']);
     Route::get('propietarios_deducciones_edit/{id}', ['uses' => 'Admin\PropertiesDeduccionesController@edit', 'as' => 'properties_propietarios.editdeduccion']);

   /* Route::get('properties_seguros_create/{id}', ['uses' => 'Admin\PropertiesSegurosController@create', 'as' => 'properties_seguros.create']);
    Route::post('properties_seguros_create/{id}', ['uses' => 'Admin\PropertiesSegurosController@create', 'as' => 'properties_seguros.create']);
    Route::post('properties_seguros_mass_destroy', ['uses' => 'Admin\PropertiesSegurosController@massDestroy', 'as' => 'properties_seguros.mass_destroy']);
    Route::post('properties_seguros_restore/{id}', ['uses' => 'Admin\PropertiesSegurosController@restore', 'as' => 'properties_seguros.restore']);
    Route::delete('properties_seguros_perma_del/{id}', ['uses' => 'Admin\PropertiesSegurosController@perma_del', 'as' => 'properties_seguros.perma_del']);*/
//Deducciones Propietarios

 //system_params
    Route::resource('system_params', 'Admin\SystemParamsController');
    Route::get('properties_seguros_create/{id}', ['uses' => 'Admin\PropertiesSegurosController@create', 'as' => 'properties_seguros.create']);
    Route::post('properties_seguros_create/{id}', ['uses' => 'Admin\PropertiesSegurosController@create', 'as' => 'properties_seguros.create']);
    Route::post('properties_seguros_mass_destroy', ['uses' => 'Admin\PropertiesSegurosController@massDestroy', 'as' => 'properties_seguros.mass_destroy']);
    Route::post('properties_seguros_restore/{id}', ['uses' => 'Admin\PropertiesSegurosController@restore', 'as' => 'properties_seguros.restore']);
    Route::delete('properties_seguros_perma_del/{id}', ['uses' => 'Admin\PropertiesSegurosController@perma_del', 'as' => 'properties_seguros.perma_del']);
//Properties Seguros

    
    Route::resource('documents', 'Admin\DocumentsController');
    //Route::post('documents_store', ['uses' => 'Admin\DocumentsController@store', 'as' => 'documents.store']);
    Route::post('documents_mass_destroy', ['uses' => 'Admin\DocumentsController@massDestroy', 'as' => 'documents.mass_destroy']);
    Route::post('documents_restore/{id}', ['uses' => 'Admin\DocumentsController@restore', 'as' => 'documents.restore']);
    Route::delete('documents_perma_del/{id}', ['uses' => 'Admin\DocumentsController@perma_del', 'as' => 'documents.perma_del']);
    Route::resource('notes', 'Admin\NotesController');
    Route::post('notes_mass_destroy', ['uses' => 'Admin\NotesController@massDestroy', 'as' => 'notes.mass_destroy']);
    Route::post('notes_restore/{id}', ['uses' => 'Admin\NotesController@restore', 'as' => 'notes.restore']);
    Route::delete('notes_perma_del/{id}', ['uses' => 'Admin\NotesController@perma_del', 'as' => 'notes.perma_del']);


    Route::model('messenger', 'App\MessengerTopic');
    Route::get('messenger/inbox', 'Admin\MessengerController@inbox')->name('messenger.inbox');
    Route::get('messenger/outbox', 'Admin\MessengerController@outbox')->name('messenger.outbox');
    Route::resource('messenger', 'Admin\MessengerController');

    
 
});
