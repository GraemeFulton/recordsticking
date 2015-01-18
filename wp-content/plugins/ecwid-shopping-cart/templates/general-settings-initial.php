<div class="wrap">

	<form method="POST" action="options.php" class="pure-form ecwid-settings general-settings">
		<h2><?php _e('Ecwid Shopping Cart — General settings', 'ecwid-shopping-cart'); ?></h2>
		<?php settings_fields('ecwid_options_page'); ?>
		<fieldset>

			<input type="hidden" name="settings_section" value="general" />

			<div class="greeting-box">

				<div class="image-container">
					<img class="greeting-image" src="<?php echo(esc_attr(ECWID_PLUGIN_URL)); ?>/images/store_inprogress.png" width="142" />
				</div>

				<div class="messages-container">
					<div class="main-message">

						<?php _e('Thank you for choosing Ecwid to build your online store', 'ecwid-shopping-cart'); ?>
					</div>
					<div class="secondary-message">
						<?php _e('The first step towards opening your online business: <br />Let’s get started and add a store to your WordPress website in <strong>3</strong> simple steps.', 'ecwid-shopping-cart'); ?>
					</div>
				</div>

			</div>
			<hr />

			<ol>
				<li>
					<h4><?php _e('Register at Ecwid', 'ecwid-shopping-cart'); ?></h4>
					<div>
						<?php _e('Create a new Ecwid account which you will use to manage your store and inventory. The registration is free.', 'ecwid-shopping-cart'); ?>
					</div>
					<div class="ecwid-account-buttons">
						<a class="pure-button pure-button-secondary" target="_blank" href="https://my.ecwid.com/cp/?source=wporg#register">
							<?php _e('Create new Ecwid account', 'ecwid-shopping-cart'); ?>
						</a>
						<a class="pure-button pure-button-secondary" target="_blank" href="https://my.ecwid.com/cp/?source=wporg#t1=&t2=Dashboard">
							<?php _e('I already have Ecwid account, sign in', 'ecwid-shopping-cart'); ?>
						</a>
					</div>
					<div class="note">
						<?php _e('You will be able to sign up through your existing Google, Facebook or PayPal profiles as well.', 'ecwid-shopping-cart'); ?>
					</div>
				</li>
				<li>
					<h4><?php _e('Find your Store ID', 'ecwid-shopping-cart'); ?></h4>
					<div>
						<?php _e('Store ID is a unique identifier of any Ecwid store, it consists of several digits. You can find it on the "Dashboard" page of Ecwid control panel. Also the Store ID will be sent in the Welcome email after the registration.', 'ecwid-shopping-cart'); ?>
					</div>
				</li>
				<li>
					<h4>
						<?php _e('Enter your Store ID', 'ecwid-shopping-cart'); ?>
					</h4>
					<div><label for="ecwid_store_id"><?php _e('Enter your Store ID here:', 'ecwid-shopping-cart'); ?></label></div>
					<div class="pure-control-group store-id">
						<input
							id="ecwid_store_id"
							name="ecwid_store_id"
							type="text"
							placeholder="<?php _e('Store ID', 'ecwid-shopping-cart'); ?>"
							value="<?php if (get_ecwid_store_id() != 1003) echo esc_attr(get_ecwid_store_id()); ?>"
							/>
						<button type="submit" class="<?php echo ECWID_MAIN_BUTTON_CLASS; ?>"><?php _e('Save and connect your Ecwid store to the site', 'ecwid-shopping-cart'); ?></button>
					</div>

				</li>
			</ol>
			<hr />
			<p><?php _e('Questions? Visit <a href="http://help.ecwid.com/?source=wporg">Ecwid support center</a>', 'ecwid-shopping-cart'); ?></p>
		</fieldset>
	</form>
</div>
