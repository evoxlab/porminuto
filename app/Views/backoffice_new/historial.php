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
					<div class="content flex-row-fluid" id="kt_content" data-select2-id="select2-data-kt_content">
						<div class="row g-xxl-9" data-select2-id="select2-data-217-k03t">
							<div class="col-xl-2  mb-xl-10 mb-5">
								<div class="card bgi-no-repeat h-xl-100">
									<div class="card-body" style="border-radius:10px;">
										<a href="#" class="card-title fw-bold text-muted text-hover-primary fs-4">Total</a>
										<div class="fs-2 fw-bold counted"><?php echo format_number_moneda_soles($obj_total->total_disponible); ?></div>
										<h6 class="fw-bold text-muted text-hover-primary fs-7"><?php echo formato_fecha_dia_mes_anio_abrev($date_begin). " - ". formato_fecha_dia_mes_anio_abrev($date_end);?></h6>
									</div>
								</div>
							</div>
							<div class="col-xl-2 mb-xl-10 mb-5">
								<div class="card bgi-no-repeat h-xl-100">
									<div class="card-body">
										<a href="#" class="card-title fw-bold text-muted text-hover-primary fs-4">Bono Patrocinio</a>
										<div class="fs-2 fw-bold counted"><?php echo format_number_moneda_soles($obj_total->total_patrocinio); ?></div>
									</div>
								</div>
							</div>
							<div class="col-xl-2 mb-xl-10 mb-5">
								<div class="card bgi-no-repeat h-xl-100">
									<div class="card-body">
										<a href="#" class="card-title fw-bold text-muted text-hover-primary fs-4">B. Reconsumo Propio</a>
										<div class="fs-2 fw-bold counted"><?php echo format_number_moneda_soles($obj_total->total_reconsumo_propio); ?></div>
									</div>
								</div>
							</div>
							<div class="col-xl-2 mb-xl-10 mb-5">
								<div class="card bgi-no-repeat h-xl-100">
									<div class="card-body">
										<a href="#" class="card-title fw-bold text-muted text-hover-primary fs-4">Bono Regalia MLM</a>
										<div class="fs-2 fw-bold counted"><?php echo format_number_moneda_soles($obj_total->total_residual_mlm); ?></div>
									</div>
								</div>
							</div>
							<div class="col-xl-2 mb-xl-10 mb-5">
								<div class="card bgi-no-repeat h-xl-100">
									<div class="card-body">
										<a href="#" class="card-title fw-bold text-muted text-hover-primary fs-4">Bono Liderazgo</a>
										<div class="fs-2 fw-bold counted"><?php echo format_number_moneda_soles($obj_total->total_liderazgo); ?></div>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header pt-7">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label text-dark"><?php echo lang('Global.historial_comisiones'); ?></span>
										<span class="text-gray-400 mt-1 fs-7"><?php echo formato_fecha_dia_mes_anio_abrev($date_begin). " - ". formato_fecha_dia_mes_anio_abrev($date_end);?></span>
									</h3>
								</div>
							<div class="card-header mt-3 mb-3">
								<div id="table_filter" class="dataTables_filter">
									<label>Buscar:<input type="search" id="customSearch" class="form-control form-control-sm" placeholder="">
									</label>
								</div>
									<form method="get" action="<?php echo site_url() . BACKOFFICE . "/historial"; ?>">
										<div class="menu">
											<div class="menu-item">
												<input name="search" class="form-control form-control-solid" placeholder="Pick date rage" id="kt_daterangepicker_1"/>
											</div>
											<div class="m-0">
												<button type="submit" class="btn btn-primary fw-bold fs-8 fs-lg-base"><i class="fa fa-search"></i></button>
											</div>
										</div>
									<form>
							</div>
							<div class="card-body">
								<table id="table" class="table align-middle table-row-dashed fs-6 gy-3">
									<thead>
										<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
											<th class="min-w-90px">ID</th>
											<th class="min-w-100px"><?php echo lang('Global.concepto'); ?></th>
											<th class="min-w-150px pe-3"><?php echo lang('Global.fecha'); ?></th>
											<th class="min-w-100px pe-3"><?php echo lang('Global.importe'); ?></th>
											<th class="pe-3 min-w-100px">De</th>
											<th class="min-w-100px pe-3"><?php echo lang('Global.estado'); ?></th>
										</tr>
									</thead>
									<tbody class="fw-bold text-gray-600">
										<?php
										foreach ($obj_commissions as $key => $value) { ?>
											<tr>
												<td>
													<?php echo $value->id; ?>
												</td>
												<td>
													<a class="text-dark text-hover-primary"><?php echo str_to_first_capital($value->bonus); ?>
														<?php 
														if($value->level){ ?>
															<span class="badge py-3 px-4 fs-7 badge-light-success">Nivel: <?php echo $value->level;?></span>
														<?php } ?>
													</a>
												</td>
												<td>
													<?php 
														if($value->date_shop){
															echo formato_fecha_dia_mes_anio_abrev($value->date_shop) . " - " . formato_fecha_minutos($value->date_shop);
														}else{
															echo formato_fecha_dia_mes_anio_abrev($value->date) . " - " . formato_fecha_minutos($value->date);
														}
													?>
												</td>
												<td>
													<?php
													if ($value->amount < 0) {  ?>
														<?php echo format_number_miles_decimal($value->amount); ?>S/
													<?php } else { ?>
														S/<?php echo format_number_miles_decimal($value->amount); ?>
													<?php } ?>
												</td>
												<td>
													<?php
													if (isset($value->name)) {
														echo $value->name . " " . $value->lastname; ?> <br />@<span class="text-dark text-hover-primary"><?php echo $value->username; ?></span>
													<?php } else {
														echo "-";
													} ?>
												</td>
												<td class="">
													<?php
													if ($value->amount < 0) { ?>
														<a class="badge py-3 px-4 fs-7 badge-light-danger"><?php echo lang('Global.salida'); ?></a>
													<?php } else { ?>
														<a class="badge py-3 px-4 fs-7 badge-light-success"><?php echo lang('Global.ingreso'); ?></a>
													<?php } ?>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<script>
					$(document).ready(function() {
						var table = $('#table').DataTable();
						$('#customSearch').on('keyup', function() {
							table.search(this.value).draw();
						});
					});
				</script>
				<?php echo view("backoffice_new/footer"); ?>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$("#kt_daterangepicker_1").daterangepicker();
		});
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
	<script src="<?php echo site_url() . "assets/metronic8/plugins/custom/datatables/datatables.bundle.js?123"; ?>"></script>
	<script src="<?php echo site_url() . "assets/metronic8/plugins/custom/prismjs/prismjs.bundle.js"; ?>"></script>
	<script src="<?php echo site_url() . "assets/metronic8/js/widgets.bundle.js"; ?>"></script>
	<script src="<?php echo site_url() . "assets/metronic8/js/custom/widgets.js"; ?>"></script>
</body>

</html>