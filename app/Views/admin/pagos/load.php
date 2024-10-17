<!doctype html>
<html lang="es-PE">
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
                                 <h5 class="m-b-10">Formulario de Pagos</h5> 
                              </div>
                              <ul class="breadcrumb">
                                 <li class="breadcrumb-item"><a href="<?php echo site_url()."dashboard/panel";?>">Panel</a></li>
                                 <li class="breadcrumb-item"><a href="<?php echo site_url()."dashboard/pagos";?>">Listado de Pagos</a></li>
                                 <li class="breadcrumb-item"><a>Pagos</a></li>
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
                                    <h5>Datos</h5>
                                 </div>
                                 <div class="card-body">
                                    <form name="form-pay" enctype="multipart/form-data" method="post" action="javascript:void(0);"; onsubmit="validate();">
                                       <div class="form-row">
                                          <div class="form-group col-md-12">
                                                <div class="form-group">
                                                      <label>ID</label>
                                                      <input class="form-control" type="text" value="<?php echo isset($obj_pays)?$obj_pays->id:"";?>" class="input-xlarge-fluid" placeholder="ID" disabled="">
                                                      <input type="hidden" id="pay_id" name="pay_id" value="<?php echo isset($obj_pays)?$obj_pays->id:"";?>">
                                                </div>
                                          </div>
                                       <div class="form-group col-md-6">
                                             <div class="form-group">
                                                   <label>ID Cliente</label>
                                                   <input class="form-control" type="text" id="customer_id" name="customer_id" value="<?php echo isset($obj_pays)?$obj_pays->customer_id:"";?>" class="input-xlarge-fluid" placeholder="Cliente" disabled="">
                                             </div>
                                             <div class="form-group">
                                                   <label>Usuario</label>
                                                   <input class="form-control" type="text" id="username" name="username" value="<?php echo isset($obj_pays)?$obj_pays->username:"";?>" class="input-xlarge-fluid" disabled="">
                                             </div>
                                             <div class="form-group">
                                                   <label>Nombre</label>
                                                   <input class="form-control" stype="text" id="name" name="name" value="<?php echo isset($obj_pays)?$obj_pays->name." ".$obj_pays->lastname:"";?>" class="input-xlarge-fluid" placeholder="Nombre" disabled="">
                                             </div>
                                             <div class="form-group">
                                                   <label for="inputState">Estado</label>
                                                   <select class="form-control" name="active" id="active">
                                                            <option value="1" <?php if($obj_pays->active == 1){ echo "selected";}?>>Es espera</option>
                                                            <option value="2" <?php if($obj_pays->active == 2){ echo "selected";}?>>Pagado</option>
                                                            <option value="3" <?php if($obj_pays->active == 3){ echo "selected";}?>>Cancelado</option>
                                                   </select>
                                             </div>
                                          </div>
                                          <div class="form-group col-md-6">
                                             <div class="form-group">
                                                      <label>Importe s/.</label>
                                                      <input class="form-control" stype="text" id="amount" name="amount" value="<?php echo isset($obj_pays)?$obj_pays->amount:0;?>" class="input-xlarge-fluid">
                                             </div>
                                             <div class="form-group">
                                                      <label>Descuento s/.</label>
                                                      <input class="form-control" type="text" id="descount" name="descount" value="<?php echo isset($obj_pays)?$obj_pays->discount:0;?>" class="input-xlarge-fluid">
                                             </div>
                                             <div class="form-group">
                                                   <label>Total s/.</label>
                                                   <input class="form-control" type="text" id="amount_total" name="amount_total" value="<?php echo isset($obj_pays)?$obj_pays->total:0;?>" class="input-xlarge-fluid">
                                             </div>
                                             <div class="form-group">
                                                   <label>Fecha</label>
                                                   <input class="form-control" type="text" id="date" name="date" value="<?php echo isset($obj_pays)?formato_fecha_db_time($obj_pays->date):"";?>" class="input-xlarge-fluid">
                                             </div>
                                          </div>
                                       </div>
                                       <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-cloud" aria-hidden="true"></i>Guardar</button>
                                       <button class="btn btn-danger" type="reset" onclick="cancel_pay();"><i class="fa fa-arrow-left" aria-hidden="true"></i>Cancelar</button>                    
                                 </form>
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
      <script src="<?php echo base_url('assets/admin/js/script/cobros.js'); ?>"></script> 
      <?php echo view("admin/footer"); ?>