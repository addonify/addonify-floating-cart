<script setup>
import { onMounted } from "vue";
import Loading from "../components/layouts/Loading.vue";
import Navigation from "../components/layouts/Navigation.vue";
import Recommended from "../components/layouts/Recommended.vue";
import Notice from "../components/layouts/Notice.vue";

import { useProductStore } from "../stores/product";
import { useNoticeStore } from "../stores/notice";

const proStore = useProductStore();
const noticeStore = useNoticeStore();

/**
 * Hook: onMounted.
 *
 * @since 1.0.0
 */
onMounted(() => {
	/**
	 * Get the recommended products list.
	 * Use cache if available.
	 *
	 * @since 1.2.0
	 */
	if (!proStore.hasAddonsStateInMemory) {
		proStore.getRecommdedProductsList().then((res) => {
			res.status === 200 ? proStore.fetchInstalledAddons() : null;
		});
	}
});
</script>

<template>
	<section class="adfy-container" id="addonify-layout">
		<Notice />
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
