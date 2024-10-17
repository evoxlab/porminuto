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

                                    <div class="flex-lg-row-fluid me-xl-10 mb-10 mb-xl-0">

                                        <div class="mt-n1">

                                            <div class="d-flex flex-stack pb-10">

                                                <a>

                                                    <img alt="Logo" src="<?php echo site_url() . "assets/front/img/logo/logo.png"; ?>" width="50" />

                                                </a>

                                            </div>

                                            <div class="m-0">

                                                <form name="form" method="post" enctype="multipart/form-data" action="<?php echo site_url() . "backoffice_new/kit/checkout"; ?>">

                                                    <input type="hidden" name="membership_id" value="<?php echo $membership_id; ?>">

                                                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                                                    <div class="row mb-11">

                                                        <div class="col-sm-3 p-3">

                                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Fecha</div>

                                                            <div class="fw-bold fs-6 text-gray-800"><?php echo date("Y-m-d"); ?></div>

                                                        </div>

                                                        <div class="col-sm-3 p-3">

                                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Kit de Afiliación</div>

                                                            <div class="fw-bold fs-6 text-gray-800"><?php echo $name; ?></div>
                                                            Productos: <?php echo $qty_product;?>

                                                        </div>

                                                        <div class="col-sm-3 p-3">

                                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Teléfono de contacto</div>

                                                            <input type="text" name="phone" id="phone" min="5" value="<?php echo $obj_customer->phone; ?>" class="form-control" required autofocus />

                                                        </div>

                                                        <div class="col-sm-3 p-3">

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

                                                    <div class="row">

                                                        <div class="col-12">

                                                            <h4 class="card-title-kit">Seleccionar Productos</h4>

                                                            <div class="row g-10">

                                                                <?php foreach ($obj_products as $key => $value) { ?>

                                                                    <script>

                                                                        var productos = <?= json_encode($obj_products); ?>;

                                                                    </script>

                                                                    <div class="col-xl-4" style="padding-left:6px;">

                                                                        <div class="d-flex h-100 align-items-center">

                                                                            <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 px-5" style="height: 600px !important;">

                                                                                <div class="text-center">

                                                                                    <img src="<?= site_url() . 'membresias/' . $value->id . '/' . $value->img; ?>" alt="<?= esc($value->name); ?>" style="width: 100px; border-radius:10px;margin-bottom: 10px;">

                                                                                </div>

                                                                                <div class="text-center">

                                                                                    <div class="text-center">

                                                                                        <h3 class="fw-bold text-primary"><?php echo $value->name; ?></h3>

                                                                                    </div>

                                                                                </div>

                                                                                <div class="mb-7 text-center">

                                                                                    <!-- <div class="text-center">

                                                                                        <span class="mb-2 text-primary">S/</span>

                                                                                        <span class="fs-3x fw-bold text-primary"><?php echo format_number_miles_decimal($value->price); ?></span>

                                                                                    </div> -->

                                                                                    <div class="fw-semibold mb-5 text-primary">Beneficios</div>

                                                                                </div>

                                                                                <div class="w-100 mb-10 h-25 overflow-auto">

                                                                                    <?php echo $value->description; ?>

                                                                                </div>

                                                                                <div>

                                                                                    <div class="row">

                                                                                        <div class="col-lg-12 fv-row flex-fill">

                                                                                            <input type="number" id="qty_<?php echo $value->id; ?>" class="form-control form-control-lg mb-3 mb-lg-0 qty text" name="quantity" value="1" title="Qty" size="4" max="" step="1" placeholder="" inputmode="Cantidad" autocomplete="off">

                                                                                            <br />

                                                                                            <button type="button" id="a_<?php echo $value->id; ?>" onclick="seleccionarProducto('<?= esc($value->id); ?>', '<?= esc($value->name); ?>', '<?= esc($value->price); ?>', '<?= esc($value->point); ?>', document.getElementById('qty_<?= esc($value->id); ?>').value, '<?= site_url() . 'membresias/' . esc($value->id) . '/' . esc($value->img); ?>')" class="btn-primary btn fw-bold fs-8 fs-lg-base w-100 btn_add_cart"><i class="fa fa-shopping-cart"></i> <span id="txt_6">Agregar al carro</span></button>

                                                                                            <a style="display:none;" href="<?php echo site_url()."backoffice_new/planes/carrito";?>" id="aa_<?php echo $value->id; ?>" class="btn-warning btn fw-bold fs-8 fs-lg-base"><i class="fa fa-shopping-basket"></i> Ver Carrito</a>

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                <?php } ?>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row ">

                                                        <div class="col-12" style="text-align: center !important;margin-top: 10px !important;">

                                                            <a href="<?= site_url() . BACKOFFICE . '/kit'; ?>" onclick="removeSessionStorage()" class="btn btn-sm btn-light btn-active-light-primary" id="btn_seguir_comprando" disabled><i class="fa fa-shopping-bag"></i> Seguir comprando</a>

                                                            <button type="submit" id="btn_submit" class="btn btn-sm btn-primary btn-active-light-primary" disabled>Finalizar Compra</button>

                                                        </div>

                                                    </div>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- begin site bar -->

                                    <div class="m-0">

                                        <div class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">

                                            <h6 class="mb-8 fw-bolder text-white-mn">Lista de productos seleccionados <span style="font-weight: normal;font-size: 13px;">Seleccionar: <?php echo $qty_product;?> productos</span></h6>

                                            <div class="col-12">

                                                <h4 class="card-title-kit"></h4>

                                                <ul id="listaProductos" class="list-products-added" style="list-style: none; padding-left: 0rem;"></ul>

                                                <hr />

                                                <p class="card-price-kit" style="text-align: right; font-size: 1.3rem;">Total: <span id="totalPrecio">0</span></p>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- end site bar -->

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <script src='<?php echo site_url() . 'assets/backoffice/js/kit_plan_new.js'; ?>'></script>

                <?php echo view("backoffice_new/footer"); ?>

            </div>

        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        let productosSeleccionados = JSON.parse(localStorage.getItem('productosSeleccionados')) || [];
        function seleccionarProducto(id, name, price, point, qty, img) {
            price = parseFloat(price);
            qty = parseInt(qty);
            if (isNaN(price) || isNaN(qty)) {
                console.error("Price or quantity is not a number");
                return;
            }

            let existingProductIndex = productosSeleccionados.findIndex(product => product.id === id);
            if (existingProductIndex !== -1) {
                productosSeleccionados[existingProductIndex].qty += qty;
            } else {
                let producto = {
                    id,
                    name,
                    price,
                    point,
                    qty,
                    img
                };

                productosSeleccionados.push(producto);
            }

            localStorage.setItem('productosSeleccionados', JSON.stringify(productosSeleccionados));

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo site_url('b_plan/add_cart'); ?>", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log("Product added to cart successfully");
                        actualizarLista();
                    } else {
                        console.error("Failed to add product to cart");
                    }
                }
            };

            xhr.send(`id=${id}&name=${name}&price=${price}&qty=${qty}`);
            actualizarLista();
            add_cart_product(id, name, price, qty, point, img);
        }

        function eliminarProducto(index) {
            let producto = productosSeleccionados[index];
            productosSeleccionados.splice(index, 1);
            localStorage.setItem('productosSeleccionados', JSON.stringify(productosSeleccionados));
            deleted(producto.id);
            actualizarLista();
        }

        function actualizarLista() {
            const lista = document.getElementById('listaProductos');
            const totalPrecio = document.getElementById('totalPrecio');
            const btnFinalizarCompra = document.getElementById('btn_submit');
            const btnSeguirComprando = document.getElementById('btn_seguir_comprando');
            let total = 0;
            const membershipId = parseInt(document.querySelector('input[name="membership_id"]').value);
            // Definir los valores mínimos según el membership_id

            const minValues = {
                2: 3,
                3: 7,
                4: 12
            };

            lista.innerHTML = '';
            productosSeleccionados.forEach((producto, index) => {
                total += producto.qty;
                const li = document.createElement('li');
                li.innerHTML = `
                <img src="${producto.img}" alt="${producto.name}" style="width: 50px;border-radius:10px;">
                <span class="card-text-kit">${producto.name}</span>
                <button type="button" class="btn btn-sm" style="float: inline-end;" onclick="eliminarProducto(${index})"><i class="fa fa-times" aria-hidden="true"></i></button>
            `;
                lista.appendChild(li);
            });

            totalPrecio.textContent = total.toFixed(0);

            if (total >= (minValues[membershipId] || 0)) {
                btnFinalizarCompra.removeAttribute('disabled');
                btnSeguirComprando.removeAttribute('disabled');
            } else {
                btnFinalizarCompra.setAttribute('disabled', 'true');
                btnSeguirComprando.setAttribute('disabled', 'true');
            }
        }

        window.onload = actualizarLista;
    </script>

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