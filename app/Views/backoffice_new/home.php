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
						<div class="row g-5 g-xl-10">
							<?php
							if ($obj_customer->active == '0') { ?>
								<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
									<span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
											<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor"></rect>
											<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor"></rect>
										</svg>
									</span>
									<div class="d-flex flex-stack flex-grow-1">
										<div class="fw-semibold">
											<h4 class="text-gray-900"><?php echo lang('Global.su_atencion'); ?></h4>
											<div class="fs-6 text-gray-700">Para obtener todos los beneficios primero deberá de hacer una compra.</b>
												<a class="fw-bold text-black-mn" href="<?php echo site_url() . BACKOFFICE . "/plan"; ?>">Comprar Ahora!</a>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
							<div class="col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-md-5 mb-xl-10">
								<!--begin balance-->
								<div class="card card-flush h-md-50 mb-5 mb-xl-10">
									<div class="card-header pt-5">
										<div class="card-title d-flex flex-column">
											<div class="d-flex align-items-center">
												<span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">S/</span>
												<span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"><?php echo format_number_miles_decimal($total_periodo); ?></span>
												<span class="badge badge-light-success fs-base">
													<span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
															<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
														</svg>
													</span>
												</span>
											</div>
											<span class="text-gray-400 pt-1 fw-semibold fs-6">Balance Actual | Periodo <?php echo $code_period; ?></span>
										</div>
									</div>
									<div class="card-body pt-2 pb-4 d-flex align-items-center">
										<div class="d-flex flex-center me-5 pt-2">
											<div id="kt_card_widget_4_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70" data-kt-line="11"></div>
										</div>
										<div class="d-flex flex-column content-justify-center w-100">
											<div class="d-flex fs-6 fw-semibold align-items-center">
												<div class="bullet w-8px h-6px rounded-2 me-3" style="background-color: #E4E6EF"></div>
												<div class="text-gray-500 flex-grow-1 me-4"><?php echo lang('Global.disponible'); ?></div>
												<div class="fw-bolder text-gray-700 text-xxl-end">S/<?php echo format_number_miles_decimal($total_disponible); ?></div>
											</div>
											<div class="d-flex fs-6 fw-semibold align-items-center">
												<div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
												<div class="text-gray-500 flex-grow-1 me-4">Balance Total</div>
												<div class="fw-bolder text-gray-700 text-xxl-end">S/<?php echo format_number_miles_decimal($total_comissions); ?></div>
											</div>
										</div>
									</div>
								</div>
								<!--end balance-->
								<!--begin rango-->
								<div class="card card-flush h-md-50 mb-xl-10">
									<div class="card-header pt-5">
										<div class="card-title d-flex flex-column">
											<div class="d-flex align-items-center">
												<span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"><?php echo format_number_miles($point); ?> <span style="font-size:15px;">pts<span></span>
											</div>
											<span class="card-label fw-bold text-dark">
												<?php echo $obj_ranges->name ?>
											</span>
											<span class="text-gray-400 pt-1 fw-semibold fs-6">Rango Actual</span>
											<div class="separator separator-dashed my-3"></div>
											<?php if (!is_null($obj_ranges->next_range_point)) { ?>
												<?php
												if (is_null($obj_ranges)) { ?>
													<span class="card-label fw-bold"><?php echo lang('Global.completo'); ?> </span>
												<?php } else { ?>
													<span class="card-label fw-bold"><?php echo $obj_ranges->next_range_name ?></span>
												<?php } ?>
												<span class="text-gray-400 pt-1 fw-semibold fs-6"><?php echo lang('Global.proximo_rango'); ?></span>
											<?php } ?>
										</div>
										<div class="card-title d-flex flex-column">
											<?php
											if ($obj_ranges->id != 1) { ?>
												<img src="<?php echo site_url() . "rangos/$obj_ranges->id" . "/" . $obj_ranges->img; ?>" alt="<?php echo $obj_ranges->name; ?>" width="80">
												<div class="separator separator-dashed my-3"></div>
											<?php } ?>
										</div>
									</div>
									<?php if (!is_null($obj_ranges->next_range_point)) { ?>
										<div class="card-body d-flex align-items-end pt-0">
											<!--begin::Progress-->
											<div class="d-flex align-items-center flex-column w-100">
												<div class="d-flex justify-content-between w-100 mt-auto mb-2">
													<?php
													if (is_null($obj_ranges)) { ?>
														<span class="fw-bolder fs-6 text-dark">-</span>
														<span class="fw-bold fs-6 text-gray-400">100%</span>
													<?php } else { ?>
														<span class="fw-bolder fs-6 text-dark"><?php echo format_number_miles($point); ?> <?php echo lang('Global.de'); ?> <?php echo format_number_miles($obj_ranges->next_range_point); ?> <?php echo lang('Global.socios'); ?></span>
														<span class="fw-bold fs-6 text-gray-400"><?php echo format_number_miles($percent); ?>%</span>
													<?php } ?>
												</div>
												<div class="h-8px mx-3 w-100 bg-light-success rounded">
													<div class="bg-success rounded h-8px" role="progressbar" style="width: <?php echo $percent; ?>%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
								<!--end rango-->
							</div>
							<div class="col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-md-5 mb-xl-10">
								<!--begin referido-->
								<div class="card card-flush h-md-50 mb-5 mb-xl-10">
									<div class="card-header pt-5">
										<div class="card-title d-flex flex-column">
											<div class="d-flex align-items-center">
												<div class="col-xl-12">
													<h4 class="text-gray-800 mb-0"><?php echo lang('Global.link_referidos'); ?></h4>
													<p class="fs-6 fw-semibold text-gray-600 py-4 m-0"><?php echo lang('Global.gana_comisiones'); ?></p>
													<div class="d-grid gap-2">
														<input id="kt_referral_link_input" type="text" class="form-control form-control-solid me-3 flex-grow-1" value="<?php echo site_url() . "registro/" . $obj_customer->username; ?>">
													</div>
													<div class="d-grid gap-2 py-5">
														<button id="kt_referral_program_link_copy_btn" onclick='copy("<?php echo site_url() . "registro/" . $obj_customer->username; ?>")' class="btn btn-block btn-light btn-active-light-primary fw-bold flex-shrink-0">Copiar Link</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--end referido-->
								<!--begin equipo -->
								<div class="card card-flush h-lg-50">
									<div class="card-header pt-5">
										<h3 class="card-title text-gray-800"><?php echo lang('Global.red'); ?></h3>
										<div class="card-toolbar d-none">
											<div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-light d-flex align-items-center px-4" data-kt-initialized="1">
												<span class="svg-icon svg-icon-1 ms-2 me-0">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor"></path>
														<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor"></path>
														<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor"></path>
													</svg>
												</span>
											</div>
										</div>
									</div>
									<div class="card-body pt-5">
										<div class="d-flex flex-stack">
											<div class="text-gray-700 fw-semibold fs-6 me-2"><?php echo lang('Global.red'); ?></div>
											<div class="d-flex align-items-senter">
												<span class="svg-icon svg-icon-2 svg-icon-success me-2">
													<svg class="text-orange-mn" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect opacity="0.5" x="16.9497" y="8.46448" width="13" height="2" rx="1" transform="rotate(135 16.9497 8.46448)" fill="currentColor"></rect>
														<path d="M14.8284 9.97157L14.8284 15.8891C14.8284 16.4749 15.3033 16.9497 15.8891 16.9497C16.4749 16.9497 16.9497 16.4749 16.9497 15.8891L16.9497 8.05025C16.9497 7.49797 16.502 7.05025 15.9497 7.05025L8.11091 7.05025C7.52512 7.05025 7.05025 7.52513 7.05025 8.11091C7.05025 8.6967 7.52512 9.17157 8.11091 9.17157L14.0284 9.17157C14.4703 9.17157 14.8284 9.52975 14.8284 9.97157Z" fill="currentColor"></path>
													</svg>
												</span>
												<span class="text-gray-900 fw-bolder fs-6 text-white-mn"><?php echo format_number_miles($obj_customer->total_team); ?></span>
											</div>
										</div>
										<div class="separator separator-dashed my-3"></div>
										<div class="d-flex flex-stack">
											<div class="text-gray-700 fw-semibold fs-6 me-2"><?php echo lang('Global.activos'); ?></div>
											<div class="d-flex align-items-senter">
												<span class="svg-icon svg-icon-2 svg-icon-success me-2">
													<svg class="text-orange-mn" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect opacity="0.5" x="16.9497" y="8.46448" width="13" height="2" rx="1" transform="rotate(135 16.9497 8.46448)" fill="currentColor"></rect>
														<path d="M14.8284 9.97157L14.8284 15.8891C14.8284 16.4749 15.3033 16.9497 15.8891 16.9497C16.4749 16.9497 16.9497 16.4749 16.9497 15.8891L16.9497 8.05025C16.9497 7.49797 16.502 7.05025 15.9497 7.05025L8.11091 7.05025C7.52512 7.05025 7.05025 7.52513 7.05025 8.11091C7.05025 8.6967 7.52512 9.17157 8.11091 9.17157L14.0284 9.17157C14.4703 9.17157 14.8284 9.52975 14.8284 9.97157Z" fill="currentColor"></path>
													</svg>
												</span>
												<span class="text-gray-900 fw-bolder fs-6 text-white-mn"><?php echo format_number_miles($total_team_active); ?></span>
											</div>
										</div>
										<div class="separator separator-dashed my-3"></div>
										<div class="d-flex flex-stack">
											<div class="text-gray-700 fw-semibold fs-6"><?php echo lang('Global.directos'); ?></div>
											<div class="d-flex align-items-senter">
												<span class="svg-icon svg-icon-2 svg-icon-success me-2">
													<svg class="text-orange-mn" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect opacity="0.5" x="16.9497" y="8.46448" width="13" height="2" rx="1" transform="rotate(135 16.9497 8.46448)" fill="currentColor"></rect>
														<path d="M14.8284 9.97157L14.8284 15.8891C14.8284 16.4749 15.3033 16.9497 15.8891 16.9497C16.4749 16.9497 16.9497 16.4749 16.9497 15.8891L16.9497 8.05025C16.9497 7.49797 16.502 7.05025 15.9497 7.05025L8.11091 7.05025C7.52512 7.05025 7.05025 7.52513 7.05025 8.11091C7.05025 8.6967 7.52512 9.17157 8.11091 9.17157L14.0284 9.17157C14.4703 9.17157 14.8284 9.52975 14.8284 9.97157Z" fill="currentColor"></path>
													</svg>
												</span>
												<span class="text-gray-900 fw-bolder fs-6 text-white-mn"><?php echo format_number_miles($obj_customer->total_referred); ?></span>
											</div>
										</div>
									</div>
								</div>
								<!--end equipo -->
							</div>
							<div class="col-md-6 col-lg-6 col-xl-6 col-xxl-4 mb-md-5 mb-xl-10">
								<!--begin paquete-->
								<div class="card card-flush h-md-50 mb-5 mb-xl-10">
									<div class="card-header pt-5">
										<div class="card-header border-0" style="margin: auto;">
											<?php
											if ($obj_customer->membership_id != 1) { ?>
												<div class="card-title m-0">
													<img class="mt-5" src="<?php echo site_url() . "membresias/$obj_customer->membership_id/$obj_customer->membership_img"; ?>" alt="<?php echo $obj_customer->membership_name; ?>" width="100" style="border-radius:10px;">
												</div>
											<?php } ?>

										</div>
										<br>
										<div class="card-body w-100" style="text-align: center;">
											<div class="fs-3 fw-bold text-dark">&nbsp;&nbsp;<?php echo $obj_customer->membership_name; ?>&nbsp;&nbsp;</div>
											<p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7">Plan Adquirido</p>
											<!-- <hr/>
											<div class="fs-3 fw-bold text-dark">&nbsp;&nbsp;<?php echo "0"; ?>&nbsp;&nbsp;</div>
											<p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7">Acciones</p> -->
										</div>
									</div>
								</div>
								<!--end paquete-->
							</div>
							<!--begin historial -->
							<div class="col-xl-12">
								<div class="card card-flush h-xl-100">
									<div class="card-header pt-7">
										<h3 class="card-title align-items-start flex-column">
											<span class="card-label fw-bold text-dark"><?php echo lang('Global.historial_comisiones'); ?></span>
											<span class="text-gray-400 mt-1 fw-semibold fs-6"><?php echo formato_fecha_dia_mes_anio_abrev($dataPeriod->begin) . " - " . formato_fecha_dia_mes_anio_abrev($dataPeriod->end); ?></span>
										</h3>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-12 mb-4">
												<div id="table_filter" class="dataTables_filter">
													<label>Buscar:<input type="search" id="customSearch" class="form-control form-control-sm" placeholder="">
													</label>
												</div>
											</div>
										</div>
										<table id="table" class="table align-middle table-row-dashed fs-6 gy-3">
											<thead>
												<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
													<th class="min-w-80px">ID</th>
													<th class="min-w-100px"><?php echo lang('Global.bono'); ?></th>
													<th class="pe-3 min-w-150px"><?php echo lang('Global.fecha'); ?></th>
													<th class="pe-3 min-w-100px"><?php echo lang('Global.importe'); ?></th>
													<th class="pe-3 min-w-100px">De</th>
													<th class="pe-3 min-w-50px"><?php echo lang('Global.estado'); ?></th>
												</tr>
											</thead>
											<tbody class="fw-bold text-gray-600">
												<?php
												foreach ($obj_commissions_matching as $key => $value) { ?>
													<tr>
														<td>
															<?php echo $value->id; ?>
														</td>
														<td>
															<a class="text-dark text-hover-primary"><?php echo str_to_first_capital($value->bonus); ?></a>
														</td>
														<td class=""><?php echo formato_fecha_dia_mes_anio_abrev($value->date) . " - " . formato_fecha_minutos($value->date); ?></td>
														<?php
														if ($value->amount < 0) {  ?>
															<td class=""><?php echo format_number_miles_decimal($value->amount); ?>s/.</td>
														<?php } else { ?>
															<td class="">s/.<?php echo format_number_miles_decimal($value->amount); ?></td>
														<?php } ?>
														<td>
															<?php
															if (isset($value->name)) {
																echo $value->name . " " . $value->lastname; ?> <br />@<span class="text-dark text-hover-primary"><?php echo $value->username; ?></span>
															<?php } else {
																echo "-";
															} ?>
														</td>
														<td>
															<?php
															if ($value->amount < 0) {  ?>
																<span class="badge py-3 px-4 fs-7 badge-light-danger"><?php echo lang('Global.salida'); ?></span>
															<?php } else { ?>
																<span class="badge py-3 px-4 fs-7 badge-light-success"><?php echo lang('Global.ingreso'); ?></span>
															<?php } ?>
														</td>
													</tr>
												<?php } ?>
												<?php
												foreach ($obj_commissions as $key => $value) { ?>
													<tr>
														<td>
															<?php echo $value->id; ?>
														</td>
														<td>
															<a class="text-dark text-hover-primary"><?php echo str_to_first_capital($value->bonus); ?>
																<?php
																if ($value->level) { ?>
																	<span class="badge py-3 px-4 fs-7 badge-light-success">Nivel: <?php echo $value->level; ?></span>
																<?php } ?>
															</a>
														</td>
														<td class="">
															<?php
															if ($value->date_shop) {
																echo formato_fecha_dia_mes_anio_abrev($value->date_shop) . " - " . formato_fecha_minutos($value->date_shop);
															} else {
																echo formato_fecha_dia_mes_anio_abrev($value->date) . " - " . formato_fecha_minutos($value->date);
															}
															?>
														</td>
														<?php
														if ($value->amount < 0) {  ?>
															<td class=""><?php echo format_number_miles_decimal($value->amount); ?>S/</td>
														<?php } else { ?>
															<td class="">S/<?php echo format_number_miles_decimal($value->amount); ?></td>
														<?php } ?>
														<td>
															<?php
															if (isset($value->name)) {
																echo $value->name . " " . $value->lastname; ?> <br />@<span class="text-dark text-hover-primary"><?php echo $value->username; ?></span>
															<?php } else {
																echo "-";
															} ?>
														</td>
														<td>
															<?php
															if ($value->amount < 0) {  ?>
																<span class="badge py-3 px-4 fs-7 badge-light-danger"><?php echo lang('Global.salida'); ?></span>
															<?php } else { ?>
																<span class="badge py-3 px-4 fs-7 badge-light-success"><?php echo lang('Global.ingreso'); ?></span>
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
						<!--end historial -->
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
				<script src='<?php echo site_url() . 'assets/backoffice/js/home_new.js'; ?>'></script>
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
	<script src="<?php echo site_url() . "assets/metronic8/plugins/custom/datatables/datatables.bundle.js?123"; ?>"></script>
	<script src="<?php echo site_url() . "assets/metronic8/plugins/custom/prismjs/prismjs.bundle.js"; ?>"></script>
	<script src="<?php echo site_url() . "assets/metronic8/js/widgets.bundle.js"; ?>"></script>
	<script src="<?php echo site_url() . "assets/metronic8/js/custom/widgets.js"; ?>"></script>
</body>

</html>