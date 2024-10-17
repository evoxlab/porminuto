<nav class="pcoded-navbar navbar-collapsed" style="overflow-y:auto;overflow-x: hidden !important;">
   <div class="navbar-wrapper">
      <div class="navbar-brand header-logo">
         <a class="b-brand">
            <div class="">
               <img alt="Logo" src="<?php echo site_url() . "assets/front/img/logo/logo.png"; ?>" width="30" />
            </div>
            <span class="b-title">Alelife Global</span>
         </a>
         <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
      </div>
      <?php
      $url = explode("/", uri_string());
      if (isset($url[1])) {
         $nav = $url[1];
      } else {
         $nav = "";
      }
      $panel_style = null;
      $panel_color = null;
      $ventas_style = null;
      $ventas_color = null;
      $nuevo_socio_style = null;
      $nuevo_socio_color = null;
      $nueva_venta_style = null;
      $nueva_venta_color = null;
      $mantenimientos_style = null;
      $bonos_color =  null;
      $bancos_color =  null;
      $almacenes_color = null;
      $clientes_color =  null;
      $comentarios_color =  null;
      $facturas_color =  null;
      $planes_color =  null;
      $pagos_color =  null;
      $puntos_color =  null;
      $rangos_color =  null;
      $usuarios_color = null;
      $usuarios_style = null;
      $recarga_style = null;
      $recarga_pendiente_color = null;
      $recarga_verificado_color = null;
      $activaciones_style = null;
      $activaciones_pendientes = null;
      $activaciones_verificadas = null;
      $nuevos_rangos_style = null;
      $pagos_style = null;
      $activar_pagos_color = null;
      $integracion_pagos_style = null;
      $concepto_ticket_color = null;
      $integracion_pagos_color = null;
      $integracion_descuentos_color = null;
      $integracion_puntos_color = null;
      $integracion_puntos_rango_color = null;
      $soporte_style = null;
      $setting_color = null;
      $ticket_color = null;
      $nuevos_rangos_color = null;
      // $kyc_style = null;
      // $kyc_pendientes_color = null;
      // $kyc_verificados_color = null;
      $anuncios_style = null;
      $anuncios_color = null;
      $comisiones_color = null;
      $periodo_color = null;
      $reportes_style = null;
      $reportes_clientes_color = null;
      $reportes_ventas_color = null;
      $reportes_pagos_color = null;
      $reportes_ganancias_color = null;
      $estructura_style = null;
      $estructura_color = null;
      $pago_tienda_style = null;
      $pago_tienda_color = null;
      $pago_tienda_verificadas_color = null;
      $proveedores_style = null;
      $proveedores_verificadas_color = null;
      $entradas_verificadas_color = null;
      $traspaso_color = null;
      $salidas_color = null;
      $kardex_color = null;
      $sugerencias_color = null;
      $sugerencias_style = null;
      $inventario_color = null;
      $calificados_style = null;
      $calificados_color = null;
      $kit_afiliacion_color = null;
      $periodo_color = null;

      switch ($nav) {
         case "ventas":
            $ventas_style = "active pcoded-trigger";
            $ventas_color = "active_nav";
            break;
         case "usuarios":
            $mantenimientos_style = "active pcoded-trigger";
            $usuarios_color = "active_nav";
            break;
         // case "kyc_pendientes":
         //    $kyc_style = "active pcoded-trigger";
         //    $kyc_pendientes_color = "active_nav";
         //    break;
         // case "kyc_verificados":
         //    $kyc_style = "active pcoded-trigger";
         //    $kyc_verificados_color = "active_nav";
         //    break;
         case "recargas_pendientes":
            $recarga_style = "active pcoded-trigger";
            $recarga_pendiente_color = "active_nav";
            break;
         case "recargas_completas":
            $recarga_style = "active pcoded-trigger";
            $recarga_verificado_color = "active_nav";
            break;
         case "nuevos_rangos":
            $mantenimientos_style = "active pcoded-trigger";
            $nuevos_rangos_color = "active_nav";
            break;
         case "bonos":
            $mantenimientos_style = "active pcoded-trigger";
            $bonos_color = "active_nav";
            break;
         case "periodos":
            $mantenimientos_style = "active pcoded-trigger";
            $periodo_color = "active_nav";
            break;
         case "bancos":
            $mantenimientos_style = "active pcoded-trigger";
            $bancos_color = "active_nav";
            break;
         case "almacenes":
            $mantenimientos_style = "active pcoded-trigger";
            $almacenes_color = "active_nav";
            break;
         case "kit_afiliacion":
            $mantenimientos_style = "active pcoded-trigger";
            $kit_afiliacion_color = "active_nav";
            break;
         case "clientes":
            $mantenimientos_style = "active pcoded-trigger";
            $clientes_color = "active_nav";
            break;
         case "comentarios":
            $mantenimientos_style = "active pcoded-trigger";
            $comentarios_color = "active_nav";
            break;
         case "concepto_ticket":
            $mantenimientos_style = "active pcoded-trigger";
            $concepto_ticket_color = "active_nav";
            break;
         case "comisiones":
            $mantenimientos_style = "active pcoded-trigger";
            $comisiones_color = "active_nav";
            break;
         case "facturas":
            $mantenimientos_style = "active pcoded-trigger";
            $facturas_color = "active_nav";
            break;
         case "planes":
            $proveedores_style = "active pcoded-trigger";
            $planes_color = "active_nav";
            break;
         case "pagos":
            $mantenimientos_style = "active pcoded-trigger";
            $pagos_color = "active_nav";
            break;
         case "rangos":
            $mantenimientos_style = "active pcoded-trigger";
            $rangos_color = "active_nav";
            break;
         case "usuarios":
            $mantenimientos_style = "active pcoded-trigger";
            $usuarios_color = "active_nav";
            break;
         case "activaciones":
            $activaciones_style = "active pcoded-trigger";
            $activaciones_pendientes = "active_nav";
            break;
         case "activaciones_verificadas":
            $activaciones_style = "active pcoded-trigger";
            $activaciones_verificadas = "active_nav";
            break;
         case "activar_pagos":
            $pagos_style = "active pcoded-trigger";
            $activar_pagos_color = "active_nav";
            break;
         case "integracion_pagos":
            $integracion_pagos_style = "active pcoded-trigger";
            $integracion_pagos_color = "active_nav";
            break;
         case "integracion_puntos":
            $integracion_pagos_style = "active pcoded-trigger";
            $integracion_puntos_color = "active_nav";
            break;
         case "integracion_puntos_rango":
            $integracion_pagos_style = "active pcoded-trigger";
            $integracion_puntos_rango_color = "active_nav";
            break;
         case "ticket":
            $soporte_style = "active pcoded-trigger";
            $ticket_color = "active_nav";
            break;
         case "reportes_clientes":
            $reportes_style = "active pcoded-trigger";
            $reportes_clientes_color = "active_nav";
            break;
         case "reportes_ventas":
            $reportes_style = "active pcoded-trigger";
            $reportes_ventas_color = "active_nav";
            break;
         case "reportes_pagos":
            $reportes_style = "active pcoded-trigger";
            $reportes_pagos_color = "active_nav";
            break;
         case "reportes_ganancias":
            $reportes_style = "active pcoded-trigger";
            $reportes_ganancias_color = "active_nav";
            break;
         case "estructura":
            $estructura_style = "pcoded-trigger";
            $estructura_color = "active_nav";
            break;
         case "nuevo_socio":
            $nuevo_socio_style = "pcoded-trigger";
            $nuevo_socio_color = "active_nav";
            break;
         case "nueva_venta":
            $nueva_venta_style = "pcoded-trigger";
            $nueva_venta_color = "active_nav";
            break;
         case "nueva_venta":
            $nueva_venta_style = "pcoded-trigger";
            $nueva_venta_color = "active_nav";
            break;
         case "sugerencias":
            $sugerencias_style = "active pcoded-trigger";
            $sugerencias_color = "active_nav";
            break;
         case "calificados":
            $calificados_style = "pcoded-trigger";
            $calificados_color = "active_nav";
            break;
         case "pago_tienda":
            $pago_tienda_style = "active pcoded-trigger";
            $pago_tienda_color = "active_nav";
            break;
         case "pago_tienda_verificadas":
            $pago_tienda_style = "active pcoded-trigger";
            $pago_tienda_verificadas_color = "active_nav";
            break;
         case "proveedores":
            $proveedores_style = "active pcoded-trigger";
            $proveedores_verificadas_color = "active_nav";
            break;
         case "entradas":
            $proveedores_style = "active pcoded-trigger";
            $entradas_verificadas_color = "active_nav";
            break;
         case "traspaso":
            $proveedores_style = "active pcoded-trigger";
            $traspaso_color = "active_nav";
            break;
         case "salidas":
            $proveedores_style = "active pcoded-trigger";
            $salidas_color = "active_nav";
            break;
         case "kardex":
            $proveedores_style = "active pcoded-trigger";
            $kardex_color = "active_nav";
            break;
         case "inventario":
            $proveedores_style = "active pcoded-trigger";
            $inventario_color = "active_nav";
            break;

         default:
            $panel_style = "active pcoded-trigger";
            $panel_color = "active_nav";
            break;
      }
      ?>
      <div class="navbar-content scroll-div">
         <ul class="nav pcoded-inner-navbar">
            <li class="nav-item pcoded-menu-caption">
               <label>Inicio</label>
            </li>
            <li class="nav-item <?php echo $panel_style; ?>">
               <a href="/dashboard/panel" class="nav-link <?php echo $panel_color; ?>">
                  <span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Panel </span>
               </a>
            </li>
            <li class="nav-item <?php echo $ventas_style; ?>">
               <a href="/dashboard/ventas" class="nav-link <?php echo $ventas_color; ?>">
                  <span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span>
                  <span class="pcoded-mtext">Ventas</span><span class="label pcoded-badge badge-danger">Hoy</span>
               </a>
            </li>
            <li class="nav-item <?php echo $estructura_style; ?>">
               <a href="/dashboard/estructura" class="nav-link <?php echo $estructura_color; ?>">
                  <span class="pcoded-micon"><i class="feather icon-share-2"></i></span><span class="pcoded-mtext">Estructura</span>
               </a>
            </li>
            <li class="nav-item <?php echo $calificados_style; ?>">
               <a href="/dashboard/calificados" class="nav-link <?php echo $calificados_color; ?>">
                  <span class="pcoded-micon"><i class="feather icon-star"></i></span><span class="pcoded-mtext">Calificados</span>
               </a>
            </li>
            <li class="nav-item <?php echo $nuevo_socio_style; ?>">
               <a href="/dashboard/nuevo_socio" class="nav-link <?php echo $nuevo_socio_color; ?>">
                  <span class="pcoded-micon"><i class="feather icon-user-plus"></i></span><span class="pcoded-mtext">Nuevo Socio</span>
               </a>
            </li>
            <li class="nav-item <?php echo $sugerencias_style; ?>">
               <a href="/dashboard/sugerencias" class="nav-link <?php echo $sugerencias_color; ?>">
                  <span class="pcoded-micon"><i class="feather icon-help-circle"></i></span>
                  <span class="pcoded-mtext">Sugerencias</span><span class="label pcoded-badge badge-warning">Nuevo</span>
               </a>
            </li>
            
            <li class="nav-item pcoded-menu-caption">
               <label>Ventas & Pago en Tienda</label>
            </li>
            <li class="nav-item <?php echo $nueva_venta_style; ?>">
               <a href="/dashboard/nueva_venta" class="nav-link <?php echo $nueva_venta_color; ?>">
                  <span class="pcoded-micon"><i class="fa fa-cart-plus"></i></span>
                  <span class="pcoded-mtext">Nueva venta</span><span class="label pcoded-badge badge-success">Ventas</span>
               </a>
            </li>
            <li class="nav-item pcoded-hasmenu <?php echo $pago_tienda_style; ?>">
               <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="fa fa-money"></i></span><span class="pcoded-mtext">Pago en tienda</span></a>
               <ul class="pcoded-submenu">
                  <li class=""><a href="/dashboard/pago_tienda" class="<?php echo $pago_tienda_color; ?>">Pago Pendiente</a></li>
                  <li class=""><a href="/dashboard/pago_tienda_verificadas" class="<?php echo $pago_tienda_verificadas_color; ?>">Pago Procesado</a></li>
               </ul>
            </li>
            
            <li class="nav-item pcoded-menu-caption">
               <label>Kardex & Almacen</label>
            </li>
            <li class="nav-item pcoded-hasmenu <?php echo $proveedores_style; ?>">
               <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="fa fa-list-alt"></i></span><span class="pcoded-mtext">kardex</span></a>
               <ul class="pcoded-submenu">
                  <li class=""><a href="/dashboard/kardex" class="<?php echo $kardex_color; ?>">Kardex <span class="label pcoded-badge label-danger">nuevo</span></a></li>
                  <li class=""><a href="/dashboard/inventario" class="<?php echo $inventario_color; ?>">Inventario</a></li>
                  <li class=""><a href="/dashboard/entradas" class="<?php echo $entradas_verificadas_color; ?>">Entradas</a></li>
                  <li class=""><a href="/dashboard/traspaso" class="<?php echo $traspaso_color; ?>">Traspaso</a></li>
                  <li class=""><a href="/dashboard/salidas" class="<?php echo $salidas_color; ?>">Salidas</a></li>
                  <li class=""><a href="/dashboard/planes" class="<?php echo $planes_color; ?>">Productos</a></li>
                  <li class=""><a href="/dashboard/proveedores" class="<?php echo $proveedores_verificadas_color; ?>">Proveedores</a></li>
               </ul>
            </li>

            <!-- <li class="nav-item pcoded-hasmenu <?php //echo $kyc_style; ?>">
               <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="fa fa-id-badge"></i></span><span class="pcoded-mtext">KYC</span></a>
               <ul class="pcoded-submenu">
                  <li class=""><a href="/dashboard/kyc_pendientes" class="<?php //echo $kyc_pendientes_color; ?>">KYC Pendientes</a></li>
                  <li class=""><a href="/dashboard/kyc_verificados" class="<?php //echo $kyc_verificados_color; ?>">KYC Verificados</a></li>
               </ul>
            </li> -->
            <li class="nav-item pcoded-hasmenu <?php echo $mantenimientos_style; ?>">
               <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Gestión de datos</span></a>
               <ul class="pcoded-submenu">
                  <li>
                     <a href="/dashboard/almacenes" class="<?php echo $almacenes_color; ?>">Almacenes</a></li>
                  <li>
                     <a href="/dashboard/bancos" class="<?php echo $bancos_color; ?>">Bancos</a></li>
                  <li>
                     <a href="/dashboard/bonos" class="<?php echo $bonos_color; ?>">Bonos</a></li>
                  <li>
                     <a href="/dashboard/clientes" class="<?php echo $clientes_color; ?>">Clientes</a></li>
                  <li>
                     <a href="/dashboard/comentarios" class="<?php echo $comentarios_color; ?>">Comentarios</a></li>
                  <li>
                     <a href="/dashboard/comisiones" class="<?php echo $comisiones_color; ?>">Comisiones</a></li>
                  <li>
                     <a href="/dashboard/facturas" class="<?php echo $facturas_color; ?>">Facturas</a></li>
                  <li>
                     <a href="/dashboard/kit_afiliacion" class="<?php echo $kit_afiliacion_color; ?>">Kit de Afiliación</a></li>
                  <li>
                     <a href="/dashboard/nuevos_rangos" class="<?php echo $nuevos_rangos_color; ?>">Nuevos Rangos &nbsp;&nbsp;<span class="badge badge-danger">Nuevo</span></a></li>
                  <li>
                     <a href="/dashboard/periodos" class="<?php echo $periodo_color; ?>">Periodos</a></li>
                  <li>
                     <a href="/dashboard/pagos" class="<?php echo $pagos_color; ?>">Pagos</a></li>
                  <li>
                     <a href="/dashboard/rangos" class="<?php echo $rangos_color; ?>">Rangos</a></li>
                  <li>
                     <a href="/dashboard/concepto_ticket" class="<?php echo $concepto_ticket_color; ?>">Concepto Tikect</a></li>
                  <?php
                  if ($_SESSION['privilage'] == '3') { ?>
                     <li class=""><a href="/dashboard/usuarios" class="<?php echo $usuarios_color; ?>">Usuarios</a></li>
                  <?php } ?>
               </ul>
            </li>
            <li class="nav-item <?php echo $pagos_style; ?>">
               <a href="/dashboard/activar_pagos" class="nav-link <?php echo $activar_pagos_color; ?>">
                  <span class="pcoded-micon"><i class="fa fa-money"></i></span><span class="pcoded-mtext">Pagos</span>
               </a>
            </li>
            <li class="nav-item pcoded-hasmenu <?php echo $integracion_pagos_style; ?>">
               <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-plus"></i></span><span class="pcoded-mtext">Integración</span></a>
               <ul class="pcoded-submenu">
                  <li class=""><a href="/dashboard/integracion_pagos" class="<?php echo $integracion_pagos_color; ?>">Integración & Descuento</a></li>
               </ul>
            </li>
            <li class="nav-item <?php echo $soporte_style; ?>">
               <a href="/dashboard/ticket" class="nav-link <?php echo $ticket_color; ?>">
                  <span class="pcoded-micon"><i class="fa fa-headphones"></i></span><span class="pcoded-mtext">Soporte</span>
               </a>
            </li>
            <li class="nav-item pcoded-hasmenu <?php echo $reportes_style; ?>">
               <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-printer"></i></span><span class="pcoded-mtext">Reportes</span></a>
               <ul class="pcoded-submenu">
                  <li class=""><a href="/dashboard/reportes_clientes" class="<?php echo $reportes_clientes_color; ?>">Clientes</a></li>
                  <li class=""><a href="/dashboard/reportes_ventas" class="<?php echo $reportes_ventas_color; ?>">Ventas</a></li>
                  <li class=""><a href="/dashboard/reportes_pagos" class="<?php echo $reportes_pagos_color; ?>">Pagos</a></li>
                  <li class=""><a href="/dashboard/reportes_ganancias" class="<?php echo $reportes_ganancias_color; ?>">Ganancias</a></li>
               </ul>
            </li>
         </ul>
      </div>
   </div>
</nav>
<header class="navbar pcoded-header navbar-expand-lg navbar-light">
   <div class="m-header">
      <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
      <a href="index.html" class="b-brand">
         <div class="b-bg">
            <img alt="Logo" src="<?php echo site_url() . "assets/front/img/logo/logo.png"; ?>" width="30" />
         </div>
         <span class="b-title">Alelife</span>
      </a>
   </div>
   <a class="mobile-menu" id="mobile-header" href="#!">
      <i class="feather icon-more-horizontal"></i>
   </a>
   <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
         <li><a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
      </ul>
      <ul class="navbar-nav ml-auto">
         <li>
            <div class="dropdown drp-user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon feather icon-settings"></i>
               </a>
               <div class="dropdown-menu dropdown-menu-right profile-notification">
                  <div class="pro-head">
                     <img src="<?php echo site_url("assets/metronic8/media/avatars/300-1.jpg"); ?>" class="img-radius" alt="Imagen de Perfil">
                     <span><?php echo corta_texto($session_name, 10); ?></span>
                     <a href="/dashboard/logout" class="dud-logout" title="Logout">
                        <i class="feather icon-log-out"></i>
                     </a>
                  </div>
                  <ul class="pro-body">
                     <li><a href="/dashboard/logout" class="dropdown-item"><i class="feather icon-lock"></i> Salir</a></li>
                  </ul>
               </div>
            </div>
         </li>
      </ul>
   </div>
</header>