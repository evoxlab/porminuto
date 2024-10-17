<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<?php echo view("backoffice_new/head"); ?>
<!--end::Head-->
<!--begin::Body-->

<body data-kt-name="metronic" id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
  <!--begin::Theme mode setup on page load-->
  <script>
    if (document.documentElement) {
      const defaultThemeMode = "system";
      const name = document.body.getAttribute("data-kt-name");
      let themeMode = localStorage.getItem("kt_" + (name !== null ? name + "_" : "") + "theme_mode_value");
      if (themeMode === null) {
        if (defaultThemeMode === "system") {
          themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        } else {
          themeMode = defaultThemeMode;
        }
      }
      document.documentElement.setAttribute("data-theme", themeMode);
    }
  </script>
  <div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
      <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <?php echo view("backoffice_new/header"); ?>
        <?php echo view("backoffice_new/toolbar"); ?>
        <!--------------->
        <!--begin::BODY-->
        <!--------------->
        <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
          <div class="content flex-row-fluid" id="kt_content">
            <div class="row g-6 g-xl-9" style="margin-bottom: 2.5em;">
              <div class="col-md-4 col-xl-3">
                <div class="card card-flush h-md-100 mb-xl-10">
                  <div class="card-header pt-5 h-md-100">
                    <div class="card-title d-flex flex-column">
                      <div class="d-flex align-items-center">
                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"><?php echo format_number_miles($obj_total_referidos[0]->total); ?></span>
                      </div>
                      <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Personas en Red Unilevel</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-xl-3">
                <div class="card card-flush h-md-100 mb-xl-10">
                  <div class="card-header pt-5 h-md-100">
                    <div class="card-title d-flex flex-column">
                      <div class="d-flex align-items-center">
                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"><?php echo format_number_miles($obj_total_direct); ?></span>
                      </div>
                      <span class="text-gray-400 pt-1 fw-semibold fs-6"> Total Referidos Directos </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-xl-3">
                <div class="card card-flush h-md-100 mb-xl-10">
                  <div class="card-header pt-5 h-md-100">
                    <div class="card-title d-flex flex-column">
                      <div class="d-flex align-items-center">
                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"><?php echo format_number_miles_decimal($point_personal); ?></span>
                      </div>
                      <span class="text-gray-400 pt-1 fw-semibold fs-6"> Puntos Personales</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-xl-3">
                <div class="card card-flush h-md-100 mb-xl-10">
                  <div class="card-header pt-5 h-md-100">
                    <div class="card-title d-flex flex-column">
                      <div class="d-flex align-items-center">
                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"><?php echo format_number_miles_decimal($obj_customer->point_grupal); ?></span>
                      </div>
                      <span class="text-gray-400 pt-1 fw-semibold fs-6"> Puntos Grupales</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-12">
              <div class="card card-flush">
                <div class="card-header cursor-pointer pt-10">
                  <div class="page-title d-flex flex-column me-3">
                    <h1 class="d-flex text-dark fw-bold my-1 fs-3">Arbol Unilevel</h1>
                  </div>
                  <div class="p-1 input-group" style="display: block !important">
                    <div class="input-group-append" style="text-align: center;">
                      <a title="inicio" href="<?php echo site_url() . "backoffice_new/unilevel"; ?>" type="submit" class="btn btn-dark" style="color:white;border-radius:5px;"><i class="fa fa-home"></i></a>
                      <a title="regresar" href="javascript:history.back()" type="submit" class="btn btn-dark" style="color:white;"><i class="fa fa-undo"></i></a>
                      <button title="subir" id="up" onclick="up('<?php echo $obj_customer->id; ?>', event);" class="btn btn-dark" disabled style="color:white;"><i class="fa fa-chevron-up"></i></button>
                    </div>
                    <hr />
                  </div>
                </div>
                <!------------->
                <!--BEGIN TREE-->
                <!------------->
                <div class="col-md-12 col-xl-12">

                  <div class="element-box" style="overflow-x: scroll;">
                    <div class="tree" style="padding: 0px !important;width:max-content">
                      <div class="card widget">
                        <ul class="arvore" style="padding-bottom: 80px">
                          <li>
                            <div>
                              <!------------->
                              <!--//NIVEL 1-->
                              <!------------->
                              <ul class="init" style="padding-top: 0px !important;">
                                <li style="overflow-x: auto;">
                                  <!-- Meu Usuario -->
                                  <a href="javascript:void(0);">
                                    <div id="level-0">
                                      <?php
                                      if ($obj_customer->range_img) { ?>
                                        <img src='<?php echo site_url() . "rangos/$obj_customer->range_id/$obj_customer->range_img"; ?>' alt="Rango" class="img-responsive symbol symbol-30px symbol-md-40px" style="width: 40px;">
                                        <?php } else {
                                        if (is_null($obj_customer->avatar)) { ?>
                                          <img src='<?php echo site_url() . "assets/metronic8/media/avatars/300-1.jpg"; ?>' alt="avatar" class="img-responsive symbol symbol-30px symbol-md-40px" style="width: 40px;">
                                        <?php } else { ?>
                                          <img src='<?php echo site_url() . "avatar/" . $obj_customer->id . "/" . $obj_customer->avatar; ?>' alt="avatar" class="img-responsive symbol symbol-30px symbol-md-40px" style="width: 40px;">
                                      <?php }
                                      }  ?>
                                    </div>
                                  </a>
                                  <br />
                                  <?php
                                  if ($obj_customer->active == '1') {
                                    $style = "btn-light-success";
                                    $color = 'green';
                                  } else {
                                    $style = "btn-light-danger";
                                    $color = 'red';
                                  }
                                  ?>
                                  <a style="color:<?php echo $color; ?>!important" class="btn btn-sm <?php echo $style; ?> fs-9 py-1 px-1" href="#" onclick="show_info('<?php echo $obj_customer->name; ?>', '<?php echo $obj_customer->lastname; ?>', '<?php echo $obj_customer->username; ?>', '<?php echo $obj_customer->range_name; ?>', '<?php echo $obj_customer->active; ?>', '<?php echo $obj_customer->pais_img; ?>', '<?php echo format_number_miles($obj_customer->point_personal); ?>', '<?php echo format_number_miles($obj_customer->point_grupal); ?>');" data-bs-toggle="modal" data-bs-target="#kt_modal_info"><?php echo $obj_customer->username; ?></a>
                                  <!------------->
                                  <!--//NIVEL 2-->
                                  <!------------->
                                  <?php if (count($obj_customer_n2) > 0) { ?>
                                    <ul>
                                      <?php foreach ($obj_customer_n2 as $value) { ?>
                                        <li>
                                          <a href="<?php echo site_url() . 'backoffice_new/unilevel/' . encrypt($value->customer_id2); ?>">
                                            <div id="level-1">
                                              <?php
                                              if ($value->range_img) { ?>
                                                <img src='<?php echo site_url() . "rangos/$value->range_id/$value->range_img"; ?>' alt="Rango" class="img-responsive symbol symbol-30px symbol-md-40px" style="width: 40px;">
                                                <?php } else {
                                                if (is_null($value->avatar)) { ?>
                                                  <img src='<?php echo site_url() . "assets/metronic8/media/avatars/300-1.jpg"; ?>' alt="avatar" class="img-responsive symbol symbol-30px symbol-md-40px" style="width: 40px;;">
                                                <?php } else { ?>
                                                  <img src='<?php echo site_url() . "avatar/" . $value->customer_id2 . "/" . $value->avatar; ?>' alt="avatar" class="img-responsive symbol symbol-30px symbol-md-40px" style="width: 40px;;">
                                                <?php } ?>
                                              <?php } ?>
                                            </div>
                                          </a>
                                          <br />
                                          <?php
                                          if ($value->active == '1') {
                                            $style = "btn-light-success";
                                            $color = 'green';
                                          } else {
                                            $style = "btn-light-danger";
                                            $color = 'red';
                                          }
                                          ?>
                                          <a href="#" style="color:<?php echo $color; ?> !important" class="btn btn-sm <?php echo $style; ?> fs-9 py-1 px-1" onclick="show_info('<?php echo $value->name; ?>', '<?php echo $value->lastname; ?>', '<?php echo $value->username; ?>', '<?php echo $value->range_name; ?>', '<?php echo $value->active; ?>', '<?php echo $value->pais_img; ?>', '<?php echo format_number_miles($value->point_personal); ?>', '<?php echo format_number_miles($value->point_grupal); ?>');" data-bs-toggle="modal" data-bs-target="#kt_modal_info"><?php echo $value->username; ?></a>
                                          <!------------->
                                          <!--//NIVEL 3-->
                                          <!------------->
                                          <?php if (count($obj_customer_n3) > 0) {
                                          ?>
                                            <ul class="d-sm-block">
                                              <?php foreach ($obj_customer_n3 as $value3) { ?>
                                                <?php if ($value->customer_id2 == $value3->sponsor_id) { ?>
                                                  <li>
                                                    <a href="<?php echo site_url() . 'backoffice_new/unilevel/' . encrypt($value3->customer_id2); ?>">
                                                      <div id="level-2">
                                                        <?php
                                                        if ($value3->range_img) { ?>
                                                          <img src='<?php echo site_url() . "rangos/$value3->range_id/$value3->range_img"; ?>' alt="Rango" class="img-responsive symbol symbol-30px symbol-md-40px" style="width: 40px;">
                                                          <?php } else {
                                                          if (is_null($value3->avatar)) { ?>
                                                            <img src='<?php echo site_url() . "assets/metronic8/media/avatars/300-1.jpg"; ?>' alt="avatar" class="img-responsive symbol symbol-30px symbol-md-40px" style="width: 40px;">
                                                          <?php } else { ?>
                                                            <img src='<?php echo site_url() . "avatar/" . $value3->customer_id2 . "/" . $value3->avatar; ?>' alt="avatar" class="img-responsive symbol symbol-30px symbol-md-40px" style="width: 40px;">
                                                        <?php }
                                                        } ?>
                                                      </div>
                                                    </a>
                                                    <br />
                                                    <?php
                                                    if ($value3->active == '1') {
                                                      $style = "btn-light-success";
                                                      $color = 'green';
                                                    } else {
                                                      $style = "btn-light-danger";
                                                      $color = 'red';
                                                    }
                                                    ?>
                                                    <a href="#" style="color:<?php echo $color; ?> !important" class="btn btn-sm <?php echo $style; ?> fs-9 py-1 px-1" onclick="show_info('<?php echo $value3->name; ?>', '<?php echo $value3->lastname; ?>', '<?php echo $value3->username; ?>', '<?php echo $value3->range_name; ?>', '<?php echo $value3->active; ?>', '<?php echo $value3->pais_img; ?>', '<?php echo format_number_miles($value3->point_personal); ?>', '<?php echo format_number_miles($value3->point_grupal); ?>');" data-bs-toggle="modal" data-bs-target="#kt_modal_info"><?php echo $value3->username; ?></a>
                                                    <!------------->
                                                    <!--//NIVEL 4-->
                                                    <!------------->
                                                    <?php if (count($obj_customer_n4) > 0) { ?>
                                                      <ul class="d-sm-block">
                                                        <?php foreach ($obj_customer_n4 as $value4) { ?>
                                                          <?php if ($value3->customer_id2 == $value4->sponsor_id) { ?>
                                                            <li>
                                                              <a href="<?php echo site_url() . 'backoffice_new/unilevel/' . encrypt($value4->customer_id2); ?>">
                                                                <div id="level-3">
                                                                  <?php
                                                                  if ($value4->range_img) { ?>
                                                                    <img src='<?php echo site_url() . "rangos/$value4->range_id/$value4->range_img"; ?>' alt="Rango" class="img-responsive symbol symbol-30px symbol-md-40px" style="width: 40px;">
                                                                    <?php } else {
                                                                    if (is_null($value3->avatar)) { ?>
                                                                      <img src='<?php echo site_url() . "assets/metronic8/media/avatars/300-1.jpg"; ?>' alt="avatar" class="img-responsive symbol symbol-30px symbol-md-40px" style="width: 40px;">
                                                                    <?php } else { ?>
                                                                      <img src='<?php echo site_url() . "avatar/" . $value4->customer_id2 . "/" . $value4->avatar; ?>' alt="avatar" class="img-responsive symbol symbol-30px symbol-md-40px" style="width: 40px;">
                                                                  <?php }
                                                                  } ?>
                                                                </div>
                                                              </a>
                                                              <br />
                                                              <?php
                                                              if ($value4->active == '1') {
                                                                $style = "btn-light-success";
                                                                $color = 'green';
                                                              } else {
                                                                $style = "btn-light-danger";
                                                                $color = 'red';
                                                              }
                                                              ?>
                                                              <a href="#" style="color:<?php echo $color; ?> !important" class="btn btn-sm <?php echo $style; ?> fs-9 py-1 px-1" onclick="show_info('<?php echo $value4->name; ?>', '<?php echo $value4->lastname; ?>', '<?php echo $value4->username; ?>', '<?php echo $value4->range_name; ?>', '<?php echo $value4->active; ?>', '<?php echo $value4->pais_img; ?>', '<?php echo format_number_miles($value4->point_personal); ?>', '<?php echo format_number_miles($value4->point_grupal); ?>');" data-bs-toggle="modal" data-bs-target="#kt_modal_info"><?php echo $value4->username; ?></a>
                                                            </li>
                                                          <?php } ?>
                                                        <?php } ?>
                                                      </ul>
                                                    <?php } ?>
                                                  </li>
                                                <?php } ?>
                                              <?php } ?>
                                            </ul>
                                          <?php } ?>
                                        </li>
                                      <?php } ?>
                                    </ul>
                                  <?php } ?>
                                </li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!------------->
            <!--END TREE-->
            <!------------->
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="kt_modal_info" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content rounded">
          <div class="modal-header pb-0 border-0 justify-content-end">
            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
              <span class="svg-icon svg-icon-1">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                  <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                </svg>
              </span>
            </div>
          </div>
          <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
            <form>
              <div class="mb-13 text-center">
                <h1 class="text-custom">Información de Socio</h1>
                <div class="text-gray-400 fw-semibold fs-5">
                  <span id="i_country" class="text-muted"></span>
                </div>
              </div>
              <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                  <span class="text-custom pt-1">Nombre Completo</span>
                </label>
                <input type="text" name="i_name" id="i_name" class="form-control form-control-solid" readonly>
              </div>
              <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                  <span class="text-custom pt-1">Usuario</span>
                </label>
                <input type="text" name="i_username" id="i_username" class="form-control form-control-solid" readonly>
              </div>
              <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                  <span class="text-custom pt-1">Rango</span>
                </label>
                <input type="text" name="i_range" id="i_range" class="form-control form-control-solid" readonly>
              </div>
              <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                  <span class="text-custom pt-1">Puntos Personales</span>
                </label>
                <input type="text" name="i_point" id="i_point" class="form-control form-control-solid" readonly>
              </div>
              <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                  <span class="text-custom pt-1">Puntos Grupales</span>
                </label>
                <input type="text" name="i_pointgroup" id="i_pointgroup" class="form-control form-control-solid" readonly>
              </div>
              <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                  <span class="text-custom pt-1">Estado</span>
                </label>
                <div id="i_status"></div>
              </div>
              <div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
      const btn = document.getElementById("up")
      const obj = <?php echo json_encode($obj_customer); ?>;
      const idParent = sessionStorage.getItem('id_parent')
      console.log("obj", obj);
      console.log("idParent", idParent);
      console.log("btn", btn);

      if (!idParent) {
        sessionStorage.setItem('id_parent', obj.id);
        btn.disabled = true
      } else if (obj.id == sessionStorage.getItem('id_parent')) {
        btn.disabled = true
      } else {
        btn.disabled = false
      }
    </script>
    <script src='<?php echo site_url() . 'assets/backoffice/js/unilevel.js?2'; ?>'></script>
    <!--------------->
    <!--end::BODY-->
    <!--------------->
    <!--begin::Footer-->
    <?php echo view("backoffice_new/footer"); ?>
    <!--end::Footer-->
  </div>
  </div>
  </div>
  <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <span class="svg-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
      </svg>
    </span>
  </div>
  <!--begin::Global Javascript Bundle(used by all pages)-->
  <script src="<?php echo site_url() . "assets/metronic8/plugins/global/plugins.bundle.js"; ?>"></script>
  <script src="<?php echo site_url() . "assets/metronic8/js/scripts.bundle.js"; ?>"></script>
  <script src="<?php echo site_url() . "assets/metronic8/js/link_nav.js"; ?>"></script>
  <!--end::Global Javascript Bundle-->
  <script src="<?php echo site_url() . "assets/metronic8/plugins/custom/datatables/datatables.bundle.js"; ?>"></script>
  <script src="<?php echo site_url() . "assets/metronic8/plugins/custom/prismjs/prismjs.bundle.js"; ?>"></script>
  <!--end::Vendors Javascript-->
  <script src="<?php echo site_url() . "assets/metronic8/js/widgets.bundle.js"; ?>"></script>
  <script src="<?php echo site_url() . "assets/metronic8/js/custom/widgets.js"; ?>"></script>
</body>

</html>