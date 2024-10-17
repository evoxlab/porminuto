<!doctype html>
<html lang="es-PE">
   <?php echo view("backoffice/admin/head"); ?>
   <body data-new-gr-c-s-check-loaded="14.1042.0" data-gr-ext-installed="">
      <?php echo view("backoffice/admin/header"); ?>
      <section class="pcoded-main-container">
         <div class="pcoded-wrapper">
            <div class="pcoded-content">
               <div class="pcoded-inner-content">
                  <div class="page-header">
                     <div class="page-block">
                        <div class="row align-items-center">
                           <div class="col-md-12">
                              <div class="page-header-title">
                                 <h5 class="m-b-10">Puntos de Binario</h5>
                              </div>
                              <ul class="breadcrumb">
                                 <li class="breadcrumb-item"><a href="/dashboard">Panel</a></li>
                                 <li class="breadcrumb-item"><a>Puntos de Binario</a></li>
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
                                    <h5>Listado de Puntos de Binario</h5>
                                 </div>
                                 <div class="card-block">
                                    <div class="table-responsive">
                                       <div id="zero-configuration_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                          <div class="row">
                                             <div class="col-sm-12">
                                                <div id="zero-configuration_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                   <div class="row">
                                                      <div class="col-sm-12">
                                                         <table id="zero-configuration" class="display table nowrap table-striped table-hover dataTable" style="width: 100%;" role="grid" aria-describedby="zero-configuration_info">
                                                            <thead>
                                                               <tr role="row">
                                                                  <th class="sorting_asc" rowspan="1" colspan="1">ID</th>
                                                                  <th class="sorting" rowspan="1" colspan="1">Fecha</th>
                                                                  <th class="sorting" rowspan="1" colspan="1">Usuario</th>
                                                                  <th class="sorting" rowspan="1" colspan="1">Cliente</th>
                                                                  <th class="sorting" rowspan="1" colspan="1">Pts Izq</th>
                                                                  <th class="sorting" rowspan="1" colspan="1">Pts Der</th>
                                                                  <th class="sorting" rowspan="1" colspan="1">Por Sistema</th>
                                                                  <th class="sorting" rowspan="1" colspan="1">Estado</th>
                                                                  <th class="sorting" rowspan="1" colspan="1">Acciones</th>
                                                               </tr>
                                                            </thead>
                                                            <tbody>
                                                               <?php foreach ($obj_points as $value): ?>
                                                                  <td><?php echo $value->id;?></td>
                                                                  <td><?php echo formato_fecha_barras($value->date);?></td>
                                                                  <td>
                                                                     <span class="text-c-purple ml-3"><?php echo "@".$value->username;?></span>
                                                                  </td>
                                                                  <td><?php echo $value->first_name." ".$value->last_name;?></td>
                                                                  <td><h6>
                                                                     <?php 
                                                                     if($value->left == 0){
                                                                        echo "";
                                                                     }else{
                                                                        echo $value->left;
                                                                     }
                                                                     ?></h6>
                                                                  </td>
                                                                  <td><h6>
                                                                     <?php 
                                                                     if($value->right == 0){
                                                                        echo "";
                                                                     }else{
                                                                        echo $value->right;
                                                                     }
                                                                     ?></h6>
                                                                  </td>
                                                                  <td>
                                                                        <?php if ($value->system == 1) { ?>
                                                                        <a class="label theme-bg2 text-white f-12">Si</a>
                                                                        <?php } ?>
                                                                  </td>
                                                                  <td>
                                                                        <?php if ($value->status == 1) {
                                                                           $valor = "Abonado";
                                                                           $stilo = "label label-success";
                                                                        }else{
                                                                           $valor = "No Abonado";
                                                                           $stilo = "label label-danger";
                                                                        } ?>
                                                                        <span class="<?php echo $stilo ?>"><?php echo $valor; ?></span>
                                                                  </td>
                                                                  <td>
                                                                        <div class="operation">
                                                                              <div class="btn-group">
                                                                                    <button type="button" class="btn btn-icon btn-info" onclick="edit_points('<?php echo $value->id;?>');"><i class="fa fa-edit"></i></button>
                                                                                    <button type="button" class="btn btn-icon btn-danger" onclick="delete_points('<?php echo $value->id;?>');"><i class="fa fa-trash"></i></button>
                                                                              </div>
                                                                        </div>
                                                                  </td>
                                                            </tr>
                                                            <?php endforeach; ?>   
                                                            </tbody>
                                                            <tfoot>
                                                               <tr>
                                                                  <th rowspan="1" colspan="1">ID</th>
                                                                  <th rowspan="1" colspan="1">Fecha</th>
                                                                  <th rowspan="1" colspan="1">Cliente</th>
                                                                  <th rowspan="1" colspan="1">Pts Izq</th>
                                                                  <th rowspan="1" colspan="1">Pts Der</th>
                                                                  <th rowspan="1" colspan="1">Por Sistema</th>
                                                                  <th rowspan="1" colspan="1">Estado</th>
                                                                  <th rowspan="1" colspan="1">Acciones</th>
                                                               </tr>
                                                            </tfoot>
                                                         </table>
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
                  </div>
               </div>
            </div>
         </div>
      </section>
      <script src="<?php echo base_url('js/backoffice/admin/point_list.js'); ?>"></script> 
      <!-- [ Header ] end -->
      <!-- [ Main Content ] end -->
      <?php echo view("backoffice/admin/footer"); ?>