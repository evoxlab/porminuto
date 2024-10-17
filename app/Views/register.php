<!DOCTYPE html>
<html lang="en-US" class="ut-no-js">

<!-- begin head -->
<?php echo view("head"); ?>
<!-- end head -->

<body id="ut-sitebody" class="post-template-default single single-post postid-300 single-format-audio ut-hover-cursor-parent ut-vc-disabled ut-spacing-160 ut-hero-height-100 ut-has-top-header ut-has-page-title has-hero ut-bklyn-multisite ut-header-display-on-hero wpb-js-composer js-comp-ver-5.8 vc_responsive" data-scrolleffect="easeInOutExpo" data-scrollspeed="1300">
	<div id="ut-floating-toTop"></div>
	<a class="ut-offset-anchor" id="top" style="top:0px !important;"></a>
	<!-- begin header -->
	<?php echo view("header2"); ?>
	<!-- end header -->
	<div class="clear"></div>
	<!-- hero section -->
	<!-- end hero section -->
	<div class="clear"></div>
	<div id="main-content" class="wrap ha-waypoint" data-animate-up="ha-header-hide" data-animate-down="ha-header-small">
		<a class="ut-offset-anchor" id="to-main-content"></a>
		<div class="main-content-background clearfix">
			<div class="grid-container">
				<div id="primary" class="grid-parent grid-100 tablet-grid-100 mobile-grid-100" style="margin-top:50px;">
					<div class="prefix-20 grid-60 prefix-20 tablet-grid-60 tablet-prefix-20 mobile-grid-100">
						<div class="comments-area clearfix">
							<div id="respond" class="comment-respond" style="text-align: left;">
								<form name="form-new_registro" action="javascript:void(0);" onsubmit="validate_captcha();" class="init" method="post" enctype="multipart/form-data">
									<input type="hidden" name="sponsor_id" name="sponsor_id" value="<?php echo $obj_customer->id; ?>">
									<input type="hidden" name="parent_id" value="<?php echo $obj_customer->id; ?>">
									<p class="comment-form-author">
									<h2 data-title="Nuevo Socio" class="section-title ut-flowtyped ut-title-loaded" style="font-size: 45px; line-height: 88px !important;text-align: center !important;"><span>Nuevo Socio</span></h2>
									</p>
									<p class="comment-form-author">
										<label for="input-email">Usted será patrocinado por:</label>
										<input type="text" class="form-control" value="<?php echo $obj_customer->name . " " . $obj_customer->lastname; ?>" readonly />
									</p>
									<hr />
									<p style="margin-bottom: 15px;">
										<input type="text" placeholder="Ingrese Usuario" name="username" id="username" autocomplete="off" onkeyup="this.value=Numtext(this.value)" onblur="validate_username(this.value);" onkeyup="javascript:this.value=this.value.toLowerCase();" autofocus required />
										<span class="alert-0"></span>
									</p>
									<p style="margin-bottom: 15px;">
										<input type="password" placeholder="Ingrese Contraseña" minlength="5" name="password" id="password" autocomplete="off" class="form-control bg-transparent" required />
									</p>
									<p style="margin-bottom: 15px;">
										<input type="password" placeholder="Confirme Contraseña" minlength="5" name="confirm_password" id="confirm_password" onkeyup="validate_pass()" autocomplete="off" class="form-control bg-transparent" required />
										<span class="alert-1"></span>
									</p>
									<br />
									<p style="margin-bottom: 15px;">
										<input type="text" placeholder="Ingrese Nombres" name="name" autocomplete="off" class="form-control bg-transparent" required style="background-color: white !important;" />
									</p>
									<p style="margin-bottom: 15px;">
										<input type="text" placeholder="Ingrese Apellidos" name="lastname" autocomplete="off" class="form-control bg-transparent" required style="background-color: white !important;" />
									</p>
									<p style="margin-bottom: 15px;">
										<input type="text" placeholder="Ingrese Co distribudor (opcional)" name="co_name" autocomplete="off" class="form-control bg-transparent" required style="background-color: white !important;" />
									</p>

									<p style="margin-bottom: 15px;">
										<input type="text" placeholder="Ingrese DNI" name="dni" autocomplete="off" class="form-control bg" minlength="8" maxlength="8" required style="background-color: white !important;" />
									</p>

									<p style="margin-bottom: 15px;">
										<input type="text" placeholder="Ingrese Dirección" name="address" autocomplete="off" class="form-control bg-transparent" required style="background-color: white !important;" />
									</p>

									<p style="margin-bottom: 15px;">
										<input type="email" placeholder="Ingrese Email" name="email" autocomplete="off" class="form-control" required style="background-color: white !important;" />
									</p>
									<p style="margin-bottom: 15px;">
										<input type="text" placeholder="Ingrese Teléfono" name="phone" autocomplete="off" class="form-control" required style="background-color: white !important;" />
									</p>
									<p style="margin-bottom: 15px;">
										<select name="country_id" id="country_id" class="form-control" required style="background-color: white !important;">
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
									</p>
									<p class="form-submit">
										<button id="submit" class="btn btn-block" style="width: 100%;border-radius: 5px;font-size: 16px;"><b>Registrar</b></button>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="ut-scroll-up-waypoint" data-section="section-i-want-music"></div>
		</div>

		<footer class="footer ut-footer-custom ut-footer-fullwidth-off"></footer>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:800%2C400%2C500%7CRoboto:500%2C400" rel="stylesheet" property="stylesheet" media="all" type="text/css">
		<link rel='stylesheet' id='vc_google_fonts_montserrat100100italic200200italic300300italicregularitalic500500italic600600italic700700italic800800italic900900italic-css' href='//fonts.googleapis.com/css?family=Montserrat%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;display=swap&#038;ver=5.3.6' type='text/css' media='all' />
		<link rel='stylesheet' id='vc_google_fonts_poppins100100italic200200italic300300italicregularitalic500500italic600600italic700700italic800800italic900900italic-css' href='//fonts.googleapis.com/css?family=Poppins%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;display=swap&#038;ver=5.3.6' type='text/css' media='all' />
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<script src="https://www.google.com/recaptcha/api.js?render=6LequQIqAAAAAMB6PlUNXRmRAh-TP-uY89l02_4G"></script>
		<script src='<?php echo site_url() . 'assets/front/js/app/new_registro.js'; ?>'></script>


		<script type='text/javascript' src='<?php echo site_url() . "assets/front/js/ut.scplugin.min.js?ver=4.9.2"; ?>'></script>
		<script type='text/javascript' src='<?php echo site_url() . "assets/front/js/anime.min.js?ver=4.9.5"; ?>'></script>
		<script type='text/javascript' src='<?php echo site_url() . "assets/front/js/digital.min.js?ver=4.9.5"; ?>'></script>
		<script type='text/javascript' src='<?php echo site_url() . "assets/front/js/ut-init.min.js?ver=4.9.5"; ?>'></script>
		<script type='text/javascript' src='<?php echo site_url() . "assets/front/js/wp-embed.min.js?ver=5.3.6"; ?>'></script>
		<script type='text/javascript' src='<?php echo site_url() . "assets/front/js/js_composer_front.min.js?ver=5.8"; ?>'></script>
		<script type='text/javascript' src='<?php echo site_url() . "assets/front/js/jquery.utmasonry.min.js?ver=4.8.2"; ?>'></script>
		<script type='text/javascript' src='<?php echo site_url() . "assets/front/js/ut.effects.min.js?ver=4.8.2"; ?>'></script>
</body>

</html>