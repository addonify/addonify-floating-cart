<script setup>
import { onMounted, onBeforeMount } from "vue";
import Loading from "../components/layouts/Loading.vue";
import Navigation from "../components/layouts/Navigation.vue";
import Recommended from "../components/layouts/Recommended.vue";
import { useProductStore } from "../stores/product";

const proStore = useProductStore();

onBeforeMount(() => {
	/**
	 *
	 * Check product store state in memory before fetching data from server.
	 *
	 * @since: 1.1.7
	 */
	if (!proStore.haveAddonStateInMemory) {
		proStore.fetchInstalledAddons();
	}
});
onMounted(() => {
	/**
	 *
	 * Check product store state in memory before fetching data from github repo.
	 *
	 * @since: 1.1.7
	 */
	if (!proStore.haveAddonStateInMemory) {
		proStore.fetchGithubRepo();
	}
});
</script>

<template>
	<section class="adfy-container">
		<main class="adfy-columns main-content">
			<aside class="adfy-col start aside secondary">
				<Navigation />
			</aside>
			<section class="adfy-col end site-primary">
				<Loading
					v-if="
						proStore.isFetching === true ||
						proStore.isFetchingAllInstalledAddons === true ||
						proStore.isSettingAddonStatus === true
					"
				/>
				<section v-else id="recommended-products">
					<div id="recommended-hot-products">
						<div class="adfy-grid">
							<template
								v-for="(addon, key) in proStore.hotAddons"
							>
								<Recommended
									:slug="key"
									:name="addon.name"
									:description="addon.description"
									:thumb="addon.thumbnail"
									:status="proStore.allProductSlugStatus[key]"
								/>
							</template>
						</div>
					</div>
					<div id="recommended-general-products"></div>
				</section>
			</section>
		</main>
	</section>
</template>
