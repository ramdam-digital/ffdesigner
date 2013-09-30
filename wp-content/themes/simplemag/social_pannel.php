<?php
add_action('admin_menu', 'ramdam_social_pannel');

function ramdam_social_pannel(){
	add_menu_page('FFDesigner Options', 'FFDesigner Options', 'activate_plugins', 'ramdam-social-plugin', 'render_pannel', null, 81);
}

function render_pannel(){
	if(isset($_POST['pannel_update'])){
		if(!wp_verify_nonce( $_POST['pannel_noncename'], 'ffd-pannel' )){
			die('Token non valide');
		}
		foreach ($_POST['options'] as $key => $value) {
			if(empty($value)){
				delete_option( $key );
			}else{
				update_option( $key, $value );
			}
		}

		?>
		<div id="message" class="updated fade">
			<p>Options sauvegardées avec succès!</p>
		</div>
		<?php
	}
	?>
	<div class="wrap theme-options-page">
		<div id="icon-options-general" class="icon32"><br></div>
		<h2>FFDesigner Options</h2>
		<form action="" method="post">
			<div class="theme-options-group">
				<table spellspacing="0" class="widefat options-table">
					<thead>
						<tr>
							<th colspan="2">Mes réseaux sociaux</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">
								<label for="facebook">Facebook</label>
							</th>
							<td>
								<input type="text" id="facebook" name="options[facebook]" value="<?= get_option('facebook', '');?>" size="75">
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="twitter">Twitter</label>
							</th>
							<td>
								<input type="text" id="twitter" name="options[twitter]" value="<?= get_option('twitter', '');?>" size="75">
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="pinterest">Pinterest</label>
							</th>
							<td>
								<input type="text" id="pinterest" name="options[pinterest]" value="<?= get_option('pinterest', '');?>" size="75">
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="instagram">Instagram</label>
							</th>
							<td>
								<input type="text" id="instagram" name="options[instagram]" value="<?= get_option('instagram', '');?>" size="75">
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="youtube">Youtube</label>
							</th>
							<td>
								<input type="text" id="youtube" name="options[youtube]" value="<?= get_option('youtube', '');?>" size="75">
							</td>
						</tr>
					</tbody>
				</table>

				<table spellspacing="0" class="widefat options-table">
					<thead>
						<tr>
							<th colspan="2">Mes coordonnées</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">
								<label for="latitude">Latitude</label>
							</th>
							<td>
								<input type="text" id="latitude" name="options[latitude]" value="<?= get_option('latitude', '');?>" size="75">
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="longitude">Longitude</label>
							</th>
							<td>
								<input type="text" id="longitude" name="options[longitude]" value="<?= get_option('longitude', '');?>" size="75">
							</td>
						</tr>

						<tr>
							<th scope="row">
								<label for="address">Adresse</label>
							</th>
							<td>
								<textarea id="address" name="options[address]" cols="74" rows="8"><?= get_option('address', '');?></textarea>
							</td>
						</tr>
						
					</tbody>
				</table>

			</div>
			<input type="hidden" name="pannel_noncename" value="<?= wp_create_nonce('ffd-pannel');?>">
			<p class="submit">
				<input type="submit" name="pannel_update" class="button-primary autowidth" value="Sauvegarder">
			</p>

		</form>
	</div>
	<?php
}