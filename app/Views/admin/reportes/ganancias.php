<!DOCTYPE html>
<html lang="en-US">
<?php echo view("admin/head"); ?>

<body data-new-gr-c-s-check-loaded="14.1042.0" data-gr-ext-installed="">
   <?php echo view("admin/header"); ?>
   <section class="pcoded-main-container">
      <div class="pcoded-wrapper">
         <div class="pcoded-content">
            <div class="pcoded-inner-content">
               <div class="page-header">
                  <div class="page-block">
                     <div class="row align-items-center">
                        <div class="col-md-12">
                           <div class="page-header-title">
                              <h5 class="m-b-10">Reportes</h5>
                           </div>
                           <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="/dashboard/">Panel</a></li>
                              <li class="breadcrumb-item"><a>Reporte de Ganancias</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="main-body">
                  <div class="page-wrapper">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="card">
                              <div class="card-header">
                                 <h5>Listado de Pagos</h5>
                              </div>
                              <!-- begin filter -->
                              <form name="form" method="post" action="<?php echo site_url() . "dashboard/reportes_ganancias"; ?>">
                                 <div class="card-body">
                                    <div class="row">
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <input type="text" name="daterange" class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <select name="search_type" class="form-control">
                                                <option value="dni">DNI</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="usuario">Usuario</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <input type="text" name="search_term" class="form-control" placeholder="Ingrese término de búsqueda" />
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="card-footer">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i> Buscar</button>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                              <!-- end filter -->
                              <div class="card-block">
                                 <div class="table-responsive">
                                    <table class="table">
                                       <thead>
                                          <tr>
                                             <th>ID</th>
                                             <th>Usuario</th>
                                             <th>Celular</th>
                                             <th>DNI</th>
                                             <th>Correo</th>
                                             <th>Fecha</th>
                                             <th>Estado</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php if ($obj_customer): ?>
                                             <tr>
                                                <td><?php echo $obj_customer->id; ?></td>
                                                <td><?php echo $obj_customer->username; ?></td>
                                                <td><?php echo $obj_customer->phone; ?></td>
                                                <td><?php echo $obj_customer->dni; ?></td>
                                                <td><?php echo $obj_customer->email; ?></td>
                                                <td><?php echo $obj_customer->date; ?></td>
                                                <td><?php echo $obj_customer->tipo_comprobante; ?></td>
                                             </tr>
                                          <?php endif; ?>
                                       </tbody>
                                    </table>
                                 </div>
                                 <div class="card-footer">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <h6>Total De Comisiones: <?php echo "S/" . format_number_miles($total_commissions); ?></h6>
                                       </div>
                                       <div class="col-md-6">
                                          <h6>Total De Comisiones dentro del Periodo: <?php echo "S/" . format_number_miles($total_commissions_period); ?></h6>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <script type="text/javascript">
      $(function() {
         $('input[name="daterange"]').daterangepicker({
            locale: {
               format: 'YYYY-MM-DD'
            },
            startDate: '<?php echo $first_day; ?>',
            endDate: '<?php echo $last_day; ?>'
         });
      });
   </script>
   <?php echo view("admin/footer"); ?>
</body>

</html>