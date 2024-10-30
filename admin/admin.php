<div class="group">
	<div class="wrap">


		<h1>Best Splash <small><sup>1.0</sup></small></h1>
		<form id="myform" method="post">
			<?php ?>
			<table>
				<tbody>
					<tr>
						<td class="splashTitle">Activate</td>
						<td><input type="checkbox" <?php echo esc_html(($data_['activate_Splash_button']==1)? 'checked' :''); ?> name="activate" id="SplashActivate"></td>
					</tr>
				</tbody>
			</table>
			<table class="SplashImage" id="<?php echo esc_html(($data_['splashSelect']==0) ? 'SplashImage' : 'SplashImage2'); ?>">
				<tbody>
					<tr>
						<td>
							<input type="radio" value="1" name="splashSelect" checked="checked" class="splashSelect" />
							<img class="SplashInnerImage  <?php echo esc_html(($data_['splashSelect']==1) ? 'selected' : ''); ?>" src="<?php echo BESTSPLASH__PLUGIN_ASSETS.'/images/Preloader_1.gif'; ?>">
						</td>
						<td>
							<input type="radio" value="2" name="splashSelect" class="splashSelect" />
							<img class="SplashInnerImage <?php echo esc_html(($data_['splashSelect']==2) ? 'selected' : ''); ?>" src="<?php echo BESTSPLASH__PLUGIN_ASSETS.'/images/Preloader_2.gif'; ?>">
						</td>
						<td>
							<input type="radio" value="3" name="splashSelect" class="splashSelect" />
							<img class="SplashInnerImage <?php echo esc_html(($data_['splashSelect']==3) ? 'selected' : ''); ?>" src="<?php echo BESTSPLASH__PLUGIN_ASSETS.'/images/Preloader_3.gif'; ?>">
						</td>
						<td>
							<input type="radio" value="4" name="splashSelect" class="splashSelect" />
							<img class="SplashInnerImage <?php echo esc_html(($data_['splashSelect']==4) ? 'selected' : ''); ?>" src="<?php echo BESTSPLASH__PLUGIN_ASSETS.'/images/Preloader_4.gif'; ?>">
						</td>
					</tr>
					<tr>
						<td>
							<input type="radio" value="5" name="splashSelect" class="splashSelect" />
							<img class="SplashInnerImage <?php echo esc_html(($data_['splashSelect']==5) ? 'selected' : ''); ?>" src="<?php echo BESTSPLASH__PLUGIN_ASSETS.'/images/Preloader_5.gif'; ?>">
						</td>
						<td>
							<input type="radio" value="6" name="splashSelect" class="splashSelect" />
							<img class="SplashInnerImage <?php echo esc_html(($data_['splashSelect']==6) ? 'selected' : ''); ?>" src="<?php echo BESTSPLASH__PLUGIN_ASSETS.'/images/Preloader_6.gif'; ?>">
						</td>
						<td>
							<input type="radio" value="7" name="splashSelect" class="splashSelect" />
							<img class="SplashInnerImage <?php echo esc_html(($data_['splashSelect']==7) ? 'selected' : ''); ?>" src="<?php echo BESTSPLASH__PLUGIN_ASSETS.'/images/Preloader_7.gif'; ?>">
						</td>
					</tr>
				</tbody>
			</table>
			<table>
				<tbody>
					<tr>
						<td>
							<input type="submit" name="button" class="SplashBtn">
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<div id="ohsnap"></div>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('#SplashActivate').click(function(){
					var val = jQuery('#SplashActivate').prop('checked');
					if (val == true) {
						jQuery('.SplashImage').fadeIn(1000);
					}else{
						jQuery('.SplashImage').fadeOut(1000);
					}
				});
				jQuery('.SplashInnerImage').click(function(){
					jQuery(this).parent().find('input').click();
					jQuery(this).parent().parent().parent().find('img').removeClass('selected');
					jQuery(this).addClass('selected');
				});
				jQuery('#myform').submit(function(e){
					e.preventDefault();
					var data = jQuery(this).serialize();

					jQuery(".wrap").css("opacity", 0.2);
					jQuery("#loading-img").css({"display": "block"});
					jQuery.post('admin-ajax.php?action=bestsplash_updated', data, function(response){
						if (response.status == true) {
							ohSnap(response.html, {color: 'green'});
						}else{
							ohSnap(response.html, {color: 'red'});
						}
						// ohSnap('Yeeaahh! You are now registered.', {'duration':'2000'});
						jQuery(".wrap").css("opacity", 1);
						jQuery("#loading-img").css({"display": "none"});
						return false;
					});
				});
			});
		</script>
	</div>
	<div id="loading-img"></div>
</div>