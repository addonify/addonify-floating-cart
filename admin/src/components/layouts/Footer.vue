<script setup>
const { __ } = wp.i18n;
const versionNumber = ADDONIFY_WOOFC_LOCOLIZER.version_number;
const thisYear = new Date().getFullYear();
</script>
<template>
	<footer class="adfy-colopon">
		<div class="adfy-row">
			<div class="adfy-col left">
				<p class="text">
					© 2020 - {{ thisYear }} Addonify Floating Cart
					<span class="version">
						{{ __("Version", "addonify-floating-cart") }}:
						{{ versionNumber }}
					</span>
				</p>
			</div>
			<div class="adfy-col right">
				<p class="text">
					<a
						href="https://wordpress.org/plugins/addonify-floating-cart/#reviews"
						class="adfy-link"
						target="_blank"
					>
						{{ __("Rate", "addonify-floating-cart") }}
						<span class="icon">
							<i class="dashicons dashicons-star-filled"></i>
							<i class="dashicons dashicons-star-filled"></i>
							<i class="dashicons dashicons-star-filled"></i>
							<i class="dashicons dashicons-star-filled"></i>
							<i class="dashicons dashicons-star-filled"></i>
						</span>
						:)
					</a>
				</p>
			</div>
		</div>
	</footer>
</template>
