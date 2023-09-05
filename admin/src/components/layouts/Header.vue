<script setup>
import Logo from "../global/Logo.vue";
import Icon from "../icons/Icons.vue";
import { useOptionsStore } from "../../stores/options";

const { __ } = wp.i18n;

const store = useOptionsStore();
</script>
<template>
	<header class="adfy-header">
		<div class="adfy-row">
			<div class="adfy-col start">
				<div class="branding">
					<router-link class="adfy-link" to="/">
						<Logo />
					</router-link>
				</div>
			</div>
			<div class="adfy-col end">
				<div class="action-buttons">
					<div class="links">
						<a
							href="https://docs.addonify.com/kb/floating-cart/"
							class="adfy-button fake-button has-underline"
							target="_blank"
						>
							<Icon icon="paper" />
							{{ __("AFC docs", "addonify-floating-cart") }}
						</a>
						<a
							href="https://wordpress.org/support/plugin/addonify-floating-cart/reviews/?filter=5"
							class="adfy-button fake-button has-underline"
							target="_blank"
						>
							<Icon icon="sparkling-stars" />
							{{ __("Rate AFC", "addonify-floating-cart") }}
						</a>
					</div>
					<div class="buttons">
						<button
							type="submit"
							@click="store.handleUpdateOptions()"
							class="adfy-button"
							:disabled="!store.needSaving"
							:loading="store.isSaving"
						>
							<span class="loading-icon">
								<Icon icon="spinner" />
							</span>
							{{ __("Save Options", "addonify-floating-cart") }}
						</button>
					</div>
				</div>
			</div>
		</div>
	</header>
</template>
