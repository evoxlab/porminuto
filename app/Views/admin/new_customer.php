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
                              <h5 class="m-b-10">Formulario de Socio</h5>
                           </div>
                           <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="<?php echo site_url() . "dashboard/panel"; ?>">Panel</a></li>
                              <li class="breadcrumb-item"><a>Nuevo Socio</a></li>
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
                                 <form name="form" action="javascript:void(0);" onsubmit="validate();" class="wpcf7-form" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                       <div class="form-group col-md-6">
                                          <div class="form-group">
                                             <label>Patrocinador</label>
                                             <select name="sponsor_id" style="border-radius: 3px 0px 0px 3px;" required class="selectpicker form-control" data-live-search="true">
                                                <option value="">Seleccionar patrocinador</option>
                                                <?php foreach ($obj_customer as $value) : ?>
                                                   <option value="<?php echo $value->id; ?>"> <?php echo $value->username . "  - (" . $value->name . " " . $value->lastname . ")"; ?></option>
                                                <?php endforeach; ?>
                                             </select>
                                          </div>
                                          <div class="form-group">
                                             <label>Usuario</label>
                                             <input type="text" placeholder="Ingrese Usuario" name="username" id="username" autocomplete="off" onkeyup="this.value=Numtext(this.value)" onblur="validate_username(this.value);" class="form-control" minlength="8" style="text-transform:lowercase;" onkeyup="javascript:this.value=this.value.toLowerCase();" autofocus required />
                                             <div class="alert-0"></div>
                                          </div>
                                          <div class="form-group">
                                             <label>Contraseña</label>
                                             <input type="password" placeholder="Ingrese Contraseña" minlength="5" name="password" id="password" autocomplete="off" class="form-control" required />
                                          </div>
                                          <div class="form-group">
                                             <label>Confirme contraseña</label>
                                             <input type="password" placeholder="Confirme Contraseña" minlength="5" name="confirm_password" id="confirm_password" onkeyup="validate_pass()" autocomplete="off" class="form-control" required />
                                             <div class="alert-1"></div>
                                          </div>

                                          <div class="form-group">
                                             <label>Nombre</label>
                                             <input type="text" placeholder="Ingrese Nombre" name="name" autocomplete="off" class="form-control" required />
                                          </div>
                                          <div class="form-group">
                                             <label>Apellidos</label>
                                             <input type="text" placeholder="Ingrese Apellido" name="lastname" autocomplete="off" class="form-control" required />
                                          </div>
                                          <div class="form-group">
                                             <label>Co Distribuidor (opcional)</label>
                                             <input type="text" placeholder="Ingrese co distribuidor" name="co_name" autocomplete="off" class="form-control" required />
                                          </div>
                                       </div>
                                       <div class="form-group col-md-6">
                                          <div class="form-group">
                                             <label>Teléfono</label>
                                             <input type="text" placeholder="Ingrese teléfono" name="phone" autocomplete="off" class="form-control" required />
                                          </div>
                                          <div class="form-group">
                                             <label>DNI</label>
                                             <input type="text" placeholder="Ingrese DNI" name="dni" autocomplete="off" minlength="8" maxlength="8" class="form-control" required />
                                          </div>
                                          <div class="form-group">
                                             <label>Dirección</label>
                                             <input type="text" placeholder="Ingrese dirección" name="address" autocomplete="off" class="form-control" required />
                                          </div>
                                          <div class="form-group">
                                             <label>Email</label>
                                             <input type="email" placeholder="Ingrese Email" name="email" autocomplete="off" class="form-control" required />
                                          </div>
                                          <div class="form-group">
                                             <label>País</label>
                                             <select name="country_id" id="country_id" class="form-control" required>
                                                <option value="">Seleccionar País...</option>
                                                <option value="5">Argentina (+54)</option>
                                                <option value="123">Bolivia (+591)</option>
                                                <option value="12">Brasil (+55)</option>
                                                <option value="81">Chile (+56)</option>
                                                <option value="82">Colombia (+57)</option>
                                                <option value="36">Costa Rica (+506)</option>
                                                <option value="113">Cuba (+53)</option>
                                                <option value="103">Ecuador (+593)</option>
                                                <option value="51">El Salvador (+503)</option>
                                                <option value="185">Guatemala (+502)</option>
                                                <option value="42">México (+52)</option>
                                                <option value="209">Nicaragua (+505)</option>
                                                <option value="124">Panamá (+507)</option>
                                                <option value="89">Perú (+51)</option>
                                                <option value="246">Puerto Rico (+1)</option>
                                                <option value="138">República Dominicana (+1809)</option>
                                                <option value="111">Uruguay (+598)</option>
                                                <option value="95">Venezuela (+58)</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-cloud" aria-hidden="true"></i>Registrar</button>
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
   <script src='<?php echo site_url() . 'assets/js/script/new_registro.js?20232'; ?>'></script>
   <script src="<?php echo site_url() . "assets/admin/js/script/new_customer.js"; ?>"></script>

   <!-- LIVE SEARCH -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

   <link rel="stylesheet" href="">
   <?php echo view("admin/footer"); ?>