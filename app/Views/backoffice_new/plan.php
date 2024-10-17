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
	<style>
		.btn-kit-option {
			margin-right: 1.5rem !important;
		}

		@media (max-width: 487px) {
			.btn-kit-option {
				margin-right: 0 !important;
				margin-bottom: 10px !important;
			}
		}
	</style>
	<div class="d-flex flex-column flex-root">
		<div class="page d-flex flex-row flex-column-fluid">
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<?php echo view("backoffice_new/header"); ?>
				<!--Begin Toolbar-->
				<?php echo view("backoffice_new/toolbar"); ?>
				<!--End Toolbar-->
				<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
					<div class="content flex-row-fluid" id="kt_content">
						<div class="card" id="kt_pricing">
							<div class="card-header text-center d-flex justify-content-center align-items-center">
								<h4>Selecciona tu mejor opción</h4>
							</div>
							<div class="card-body d-flex justify-content-center">
								<div class="row">
									<div class="col text-center">
										
										<!-- Disable if you do not already have a kit -->
										<?php
										if ($membership_id == 1) { ?>
											<a href="<?php echo site_url() . 'backoffice_new/kit'; ?>" class="btn btn-lg text-white btn-kit-option btn-kit-option-custom" style="width: 200px;background-color: var(--kt-header-menu-link-active-bg-color)">Kit de afiliación</a>	
										<?php }else{ ?>
											<a href="<?php echo site_url() . 'backoffice_new/planes'; ?>" class="btn btn-lg text-white btn-kit-option btn-kit-option-custom" style="width: 200px; background-color: var(--kt-header-menu-link-active-bg-color)">Compras</a>
										<?php } ?>
									</div>
									<span class="mt-10 legend-option" style="color: #888;">
										<b>Kit de afiliación:</b> Según el kit que selecciones, podras seleccionar una cantidad de productos <br />
									</span>
									<!-- Disable if you do not already have a kit -->
									<?php
									if ($membership_id != 1) { ?>
										<span class="mt-2" style="color: #888;">
											<b>Arma tu compra:</b> Selecciona tus productos a tu gusto
										</span>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script src='<?php echo site_url() . 'assets/backoffice/js/plan_new.js?2024'; ?>'></script>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
	<script src="<?php echo site_url() . "assets/front/js/quantity.min.js?ver=2.0.4"; ?>" id="smartic-input-quantity-js"></script>
</body>

</html>