<!DOCTYPE html>

<html lang="en">

<?php echo view("backoffice_new/head"); ?>



<body data-kt-name="metronic" id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">

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

                <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">

                    <div class="content flex-row-fluid" id="kt_content">

                        <div class="card">

                            <div class="card-body p-lg-20">

                                <div class="d-flex flex-column flex-xl-row">

                                    <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">

                                        <div class="mt-n1">

                                            <div class="d-flex flex-stack pb-10">

                                                <a href="#">

                                                    <img alt="Logo" src="<?php echo site_url() . "assets/front/img/logo/logo.png"; ?>" width="50" />

                                                </a>

                                            </div>

                                            <div class="m-0">

                                                <form name="form" method="post" enctype="multipart/form-data" action="<?php echo site_url() . "backoffice_new/planes/checkout"; ?>">

                                                    <div class="row g-5 mb-11">

                                                        <div class="col-sm-3">

                                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Fecha</div>

                                                            <div class="fw-bold fs-6 text-gray-800"><?php echo date("Y-m-d"); ?></div>

                                                        </div>

                                                        <div class="col-sm-3">

                                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Teléfono de contacto</div>

                                                            <input type="text" name="phone" id="phone" min="5" value="<?php echo $obj_customer->phone; ?>" class="form-control" required autofocus />

                                                        </div>

                                                        <div class="col-sm-3">

                                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Recojo de productos</div>

                                                            <select name="store_id" class="form-control" required>

                                                                <option value="">Seleccionar</option>

                                                                <?php

                                                                foreach ($obj_store as $key => $value) { ?>

                                                                    <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>

                                                                <?php } ?>

                                                            </select>

                                                        </div>

                                                    </div>

                                                    <div class="flex-grow-1">

                                                        <div class="table-responsive border-bottom mb-9">

                                                            <table class="table mb-3">

                                                                <thead>

                                                                    <tr class="border-bottom fs-6 fw-bold text-muted">

                                                                        <th class="min-w-100px pb-2"><?php echo lang('Global.descripcion'); ?></th>

                                                                        <th class="min-w-100px pb-2">Cantidad</th>

                                                                        <th class="min-w-80px pb-2">Precio</th>

                                                                        <th class="min-w-80px pb-2"><?php echo lang('Global.importe'); ?></th>

                                                                        <th class="min-w-150px pb-2"></th>

                                                                    </tr>

                                                                </thead>

                                                                <tbody>

                                                                    <?php

                                                                    foreach ($content as $key => $row) { ?>

                                                                        <tr class="fw-bold text-gray-700 fs-5">

                                                                            <td class="d-flex align-items-center">

                                                                                <i class="fa fa-genderless text-primary fs-2 me-2"></i>

                                                                                <span>

                                                                                    <?php echo $row->name; ?>

                                                                                </span>

                                                                            </td>

                                                                            <td class="">

                                                                                <input id="<?php echo $key; ?>" type="number" class="form-control form-control-lg form-control-solid" name="qty_<?php echo $row->rowId; ?>" value="<?php echo $row->qty; ?>" min="1" />

                                                                            </td>

                                                                            <td class="fs-5 text-dark fw-bolder"><?php echo $row->price; ?></td>

                                                                            <td class="fs-5 text-dark fw-bolder"><?php echo format_number_miles_decimal($row->subtotal); ?></td>

                                                                            <td class="fs-5 text-dark fw-bolder">

                                                                                <button type="button" id="edit_<?php echo $row->rowId; ?>" onclick="edit('<?php echo $row->rowId; ?>', '<?php echo $key; ?>');" class="btn btn-sm btn-light btn-active-light-primary"><i class="fa fa-pencil"></i></button>

                                                                                <button type="button" onclick="deleted('<?php echo $row->rowId; ?>');" class="btn btn-sm btn-light btn-active-light-danger"><i class="fa fa-trash"></i></button>

                                                                            </td>

                                                                        </tr>

                                                                    <?php } ?>

                                                                    <tr class="fw-bold text-gray-700 fs-5 text-end">

                                                                        <td class="d-flex align-items-center"></td>

                                                                        <td class="">

                                                                            Sub Total

                                                                        </td>

                                                                        <td class="fs-5 text-dark fw-bolder"><?php echo $sub_total; ?></td>

                                                                        <td class="fs-5 text-dark fw-bolder"></td>

                                                                    </tr>

                                                                    <tr class="fw-bold text-gray-700 fs-5 text-end">

                                                                        <td class="d-flex align-items-center"></td>

                                                                    </tr>

                                                                </tbody>

                                                            </table>

                                                        </div>

                                                    </div>

                                                    <div class="row g-5 mb-11">

                                                        <div class="col-sm-6"></div>

                                                        <div class="col-sm-6" style="text-align: center !important;">

                                                            <?php

                                                            if ($cart_count) { ?>

                                                                <?php

                                                                if ($obj_customer->membership_id == 1) {

                                                                    $style = "disabled";
                                                                } else {

                                                                    $style = "";
                                                                }

                                                                ?>

                                                                <button type="submit" id="btn_submit" class="btn btn-sm btn-primary btn-active-light-primary" <?php echo site_url() . BACKOFFICE . "/checkout"; ?>>Finalizar Compra</button>

                                                                <a href="<?php echo site_url() . BACKOFFICE . "/planes"; ?>" onclick="removeSessionStorage()" class="btn btn-sm btn-light btn-active-light-primary"><i class="fa fa-shopping-bag"></i> Seguir comprando</a>

                                                            <?php } else { ?>

                                                                <a href="<?php echo site_url() . BACKOFFICE . "/planes"; ?>" onclick="removeSessionStorage()" class="btn btn-sm btn-light btn-active-light-primary"><i class="fa fa-shopping-bag"></i> Seguir comprando</a>

                                                            <?php } ?>

                                                        </div>

                                                    </div>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="m-0">

                                        <div class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">

                                            <h6 class="mb-8 text-custom fw-bold text-hover-primary"><?php echo lang('Global.detalle_compra'); ?></h6>

                                            <div class="mb-6">

                                                <div class="text-custom fw-bold"><?php echo lang('Global.nombre'); ?></div>

                                                <div class="fw-bold text-gray-800 fs-6"><?php echo $obj_customer->name . " " . $obj_customer->lastname; ?></div>

                                            </div>

                                            <div class="mb-6">

                                                <div class="text-custom fw-bold fs-7"><?php echo lang('Global.dni'); ?></div>

                                                <div class="fw-bold text-gray-800 fs-6"><?php echo $obj_customer->dni; ?></div>

                                            </div>

                                            <div class="mb-6">

                                                <div class="text-custom fw-bold fs-7">Email:</div>

                                                <div class="fw-bold text-gray-800 fs-6"><?php echo $obj_customer->email; ?></div>

                                            </div>

                                            <div class="mb-6">

                                                <div class="text-custom fw-bold fs-7"><?php echo lang('Global.pais'); ?></div>

                                                <div class="fw-bold text-gray-800 fs-6">

                                                    <img src="<?php echo site_url() . 'assets/metronic8/media/flags/' . $obj_customer->pais_img; ?>" width="20" alt="<?php echo $obj_customer->pais; ?>" style="border-radius:5px;">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <script src='<?php echo site_url() . 'assets/backoffice/js/plan_new.js?12'; ?>'></script>
                <?php echo view("backoffice_new/footer"); ?>

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

    <script src="<?php echo site_url() . "assets/metronic8/plugins/global/plugins.bundle.js"; ?>"></script>

    <script src="<?php echo site_url() . "assets/metronic8/js/scripts.bundle.js"; ?>"></script>

    <script src="<?php echo site_url() . "assets/metronic8/js/link_nav.js"; ?>"></script>

    <script src="<?php echo site_url() . "assets/metronic8/plugins/custom/datatables/datatables.bundle.js"; ?>"></script>

    <script src="<?php echo site_url() . "assets/metronic8/plugins/custom/prismjs/prismjs.bundle.js"; ?>"></script>

    <script src="<?php echo site_url() . "assets/metronic8/js/widgets.bundle.js"; ?>"></script>

    <script src="<?php echo site_url() . "assets/metronic8/js/custom/widgets.js"; ?>"></script>

</body>



</html>

<style>
    .btn.btn-active-light-primary:focus:not(.btn-active) {

        background-color: var(--kt-light) !important;

    }

    .btn.btn-active-light-primary:hover:not(.btn-active) {

        background-color: var(--kt-light) !important;

    }
</style>