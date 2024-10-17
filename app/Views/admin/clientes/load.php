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
                                 <h5 class="m-b-10">Formulario de Clientes</h5>
                              </div>
                              <ul class="breadcrumb">
                                 <li class="breadcrumb-item"><a href="<?php echo site_url()."dashboard/panel";?>">Panel</a></li>
                                 <li class="breadcrumb-item"><a href="<?php echo site_url()."dashboard/clientes";?>">Listado de Clientes</a></li>
                                 <li class="breadcrumb-item"><a>Cliente</a></li>
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
                                    <form name="form-customer" id="form-customer" enctype="multipart/form-data" method="post" action="javascript:void(0);" onsubmit="validate();">
                                          <input type="hidden" name="unilevel_id" id="unilevel_id" value="<?php echo isset($obj_sponsor)?$obj_sponsor->unilevel_id:"";?>">
                                          <input type="hidden" name="customer_id" id="customer_id" value="<?php echo isset($obj_customer)?$obj_customer->id:"";?>">
                                          <input type="hidden" name="sponsor_id" id="sponsor_id" value="<?php echo isset($obj_sponsor)?$obj_sponsor->customer_id:"";?>">
                                          <input type="hidden" name="customer_bank_id" id="customer_bank_id" value="<?php echo isset($obj_customer)?$obj_customer->customer_bank_id:"";?>">
                                          <input type="hidden" name="range_id" id="range_id" value="<?php echo isset($obj_customer)?$obj_customer->range_id:"";?>">
                                       <div class="form-row">
                                          <div class="form-group col-md-12">
                                             <div class="form-group">
                                                <label>ID</label>
                                                <input class="form-control" type="text" name="customer_id" value="<?php echo isset($obj_customer)?$obj_customer->id:"";?>" placeholder="ID" disabled="">
                                             </div>
                                          </div>
                                          <div class="form-group col-md-6">
                                             <!-- begin sponsor -->
                                             <div class="alert alert-secondary" role="alert">
                                                <div class="form-group">
                                                   <label>Patrocinador Usuario</label>
                                                   <input class="form-control" type="text" onblur="validate_user(this.value);" id="sponsor_username" name="sponsor_username" value="<?php echo isset($obj_sponsor)?$obj_sponsor->username:"";?>">
                                                   <span class="alert-0"></span>
                                                </div>
                                                <div class="form-group">
                                                   <label>Patrocinador Nombre</label>
                                                   <input class="form-control" type="text" id="customer" name="customer" value="<?php echo isset($obj_sponsor)?$obj_sponsor->name. " ". $obj_sponsor->lastname:"";?>" readonly>
                                                </div>
                                             </div>
                                             <!-- end sponsor -->
                                             <div class="form-group">
                                                <label>Usuario</label>
                                                <input class="form-control" type="text" id="username" name="username" value="<?php echo isset($obj_customer)?$obj_customer->username:"";?>" placeholder="Username">
                                             </div>
                                             <div class="form-group">
                                                <label>Nombres</label>
                                                <input class="form-control" type="text" id="name" name="name" value="<?php echo isset($obj_customer)?$obj_customer->name:"";?>" placeholder="Nombre">
                                             </div>
                                             <div class="form-group"> 
                                                <label>Apellidos</label>
                                                <input class="form-control" type="text" id="lastname" name="lastname" value="<?php echo isset($obj_customer)?$obj_customer->lastname:"";?>" placeholder="Apellidos">
                                             </div>
                                             <div class="form-group"> 
                                                <label>Contraseña <span style="color:chocolate"> (ingresar nueva contraseña en caso de actualización)</span></label>
                                                <input class="form-control" type="password" id="password" name="password" value="">
                                             </div>
                                             <div class="form-group">
                                                <label>E-mail</label>
                                                <input class="form-control" type="text" id="email" name="email" value="<?php echo isset($obj_customer)?$obj_customer->email:"";?>" placeholder="Correo Electrónico">
                                             </div>
                                          </div>
                                          <div class="form-group col-md-6">
                                             <?php 
                                             if($obj_customer->customer_bank_id != ""){ ?>
                                                <!-- begin bank -->
                                                <div class="alert alert-secondary" role="alert">
                                                   <div class="form-group">
                                                      <label for="inputState">Banco</label>
                                                      <select name="bank_id" id="bank_id" class="form-control">
                                                      <option value="">[ Seleccionar ]</option>
                                                         <?php foreach ($obj_bank as $value ): ?>
                                                         <option value="<?php echo $value->id;?>"
                                                            <?php 
                                                                  if(isset($obj_customer->bank_id)){
                                                                        if($obj_customer->bank_id==$value->id){
                                                                              echo "selected";
                                                                        }
                                                                  }else{
                                                                           echo "";
                                                                  }
                                                            ?>><?php echo $value->name;?>
                                                      </option>
                                                      <?php endforeach; ?>
                                                   </select>
                                                   </div>
                                                   <div class="form-group">
                                                      <label for="inputState">N° Cuenta</label>
                                                      <input class="form-control" type="text" id="number" name="number" value="<?php echo isset($obj_customer)?$obj_customer->number:"";?>" placeholder="Número de Cuenta">
                                                   </div>
                                                   <div class="form-group">
                                                      <label for="inputState">Interbancario CCi</label>
                                                      <input class="form-control" type="text" id="cci" name="cci" value="<?php echo isset($obj_customer)?$obj_customer->cci:"";?>" placeholder="Número de Cuenta">
                                                   </div>
                                                </div>
                                                <!-- end bank -->
                                             <?php } ?>
                                             <div class="form-group">
                                                <label>DNI</label>
                                                <input class="form-control" type="text" id="dni" name="dni" value="<?php echo isset($obj_customer)?$obj_customer->dni:"";?>" placeholder="DNI">
                                             </div>
                                             <!-- RUC -->
                                             <div class="alert alert-secondary" role="alert">
                                                <div class="form-group">
                                                   <label>RUC</label>
                                                   <input class="form-control" type="text" id="ruc" name="ruc" value="<?php echo isset($obj_sponsor->ruc)?$obj_sponsor->ruc:"";?>">
                                                   <span class="alert-0"></span>
                                                </div>
                                                <div class="form-group">
                                                   <label>Razón Social</label>
                                                   <input class="form-control" type="text" id="company_name" name="company_name" value="<?php echo isset($obj_sponsor->company_name)?$obj_sponsor->company_name:"9 ";?>" readonly>
                                                </div>
                                             </div>
                                             <!-- end RUC -->
                                             <div class="form-group">
                                                <label>Telefono</label>
                                                <input class="form-control" type="text" id="phone" name="phone" placeholder="Telefono" value="<?php echo isset($obj_customer)?$obj_customer->phone:"";?>">
                                             </div>   
                                             <div class="form-group">
                                                <label for="inputState">KYC</label>
                                                <select name="kyc" id="kyc" class="form-control">
                                                      <option value="">[ Seleccionar ]</option>
                                                      <option value="0" <?php if(isset($obj_customer)){
                                                            if($obj_customer->kyc == '0' || $obj_customer->kyc == null){ echo "selected";}
                                                      }else{echo "";} ?>>No Enviado</option>
                                                      <option value="1" <?php if(isset($obj_customer)){
                                                            if($obj_customer->kyc == '1'){ echo "selected";}
                                                      }else{echo "";} ?>>En Espera</option>
                                                      <option value="2" <?php if(isset($obj_customer)){
                                                            if($obj_customer->kyc == '2'){ echo "selected";}
                                                      }else{echo "";} ?>>Validado</option>
                                                      <option value="3" <?php if(isset($obj_customer)){
                                                            if($obj_customer->kyc == '3'){ echo "selected";}
                                                      }else{echo "";} ?>>Cancelado</option>
                                                </select>
                                             </div>
                                             <div class="form-group">
                                                <label for="inputState">Kit Afiliación</label>
                                                <select name="membership_id" id="membership_id" class="form-control">
                                                   <option value="">[ Seleccionar ]</option>
                                                   <?php foreach ($obj_memberships as $value ): ?>
                                                      <option value="<?php echo $value->id;?>"
                                                            <?php 
                                                                  if(isset($obj_customer)){
                                                                           if($obj_customer->membership_id == $value->id){
                                                                              echo "selected";
                                                                           }
                                                                  }else{
                                                                              echo "";
                                                                  }
                                                            ?>><?php echo $value->name;?>
                                                      </option>
                                                   <?php endforeach; ?>
                                                   </select>
                                             </div>
                                             <div class="form-group">
                                                <label for="inputState">Pais</label>
                                                <select name="country_id" id="country_id" class="form-control">
                                                   <option value="">[ Seleccionar ]</option>
                                                   <?php foreach ($obj_paises as $value ): ?>
                                                      <option value="<?php echo $value->id;?>"
                                                            <?php 
                                                                  if(isset($obj_customer->country_id)){
                                                                           if($obj_customer->country_id==$value->id){
                                                                              echo "selected";
                                                                           }
                                                                  }else{
                                                                              echo "";
                                                                  }
                                                            ?>><?php echo $value->nombre;?>
                                                      </option>
                                                   <?php endforeach; ?>
                                                   </select>
                                             </div>
                                             <div class="form-group">
                                                <label for="inputState">Pagos Líderes</label>
                                                <select name="pay" id="pay" class="form-control">
                                                      <option value="">[ Seleccionar ]</option>
                                                      <option value="1" <?php if(isset($obj_customer)){
                                                            if($obj_customer->pay == 1){ echo "selected";}
                                                      }else{echo "";} ?>>Activo</option>
                                                      <option value="0" <?php if(isset($obj_customer)){
                                                            if($obj_customer->pay == 0){ echo "selected";}
                                                      }else{echo "";} ?>>Inactivo</option>
                                                </select>
                                             </div>
                                             <div class="form-group">
                                                <label for="inputState">Estado</label>
                                                <select name="active" id="active" class="form-control">
                                                      <option value="">[ Seleccionar ]</option>
                                                      <option value="1" <?php if(isset($obj_customer)){
                                                            if($obj_customer->active == 1){ echo "selected";}
                                                      }else{echo "";} ?>>Activo</option>
                                                      <option value="0" <?php if(isset($obj_customer)){
                                                            if($obj_customer->active == 0){ echo "selected";}
                                                      }else{echo "";} ?>>Inactivo</option>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-cloud" aria-hidden="true"></i>Guardar</button>
                                       <button class="btn btn-danger" type="reset" onclick="cancelar_customer();"><i class="fa fa-arrow-left" aria-hidden="true"></i>Cancelar</button>                    
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
      <script src="<?php echo base_url('assets/admin/js/script/customer.js?2023'); ?>"></script> 
      <?php echo view("admin/footer"); ?>