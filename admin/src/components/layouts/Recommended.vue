<script setup>
import { ref } from "vue";
import { ElButton, ElMessage } from "element-plus";
import { Loading } from "@element-plus/icons-vue";
import { useProductStore } from "../../stores/product";

/**
 * Define props.
 *
 * @since 1.0.0
 */
const props = defineProps({
	slug: {
		type: String,
		required: false,
	},
	name: {
		type: String,
		required: false,
	},
	description: {
		type: String,
		required: false,
	},
	thumb: {
		type: String,
		required: false,
	},
	category: {
		type: String,
		required: false,
	},
	status: {
		type: String,
		required: false,
	},
});

const { __ } = wp.i18n;
const proStore = useProductStore();
const { slug, name, thumb, description, category } = props;

const isLoading = ref(false);
const isDisabled = ref(false);
const isActiviting = ref(false);
const isInstalling = ref(false);

const activateText = __("Activate now", "addonify-floating-cart");
const activitingText = __("Activating...", "addonify-floating-cart");
const installText = __("Install now", "addonify-floating-cart");
const installingText = __("Installing...", "addonify-floating-cart");
const installedText = __("Installed", "addonify-floating-cart");

const activeAddonHandler = (slug) => {
	isLoading.value = true;
	isActiviting.value = true;

	try {
		const res = proStore.updateAddonStatus(slug);

		if (res.status == "active") {
			isLoading.value = false;
			isActiviting.value = false;
			isDisabled.value = true;
		}
	} catch (error) {
		isLoading.value = false;
		isActiviting.value = false;
		isDisabled.value = false;
	}
};

const installAddonHandler = async (slug) => {
	isLoading.value = true;
	isInstalling.value = true;

	try {
		const res = await proStore.handleAddonInstallation(slug);

		if (res.status == "active") {
			isLoading.value = false;
			isInstalling.value = false;
			isDisabled.value = true;
		}
	} catch (error) {
		isLoading.value = false;
		isInstalling.value = false;
		isDisabled.value = false;
	}
};
</script>

<template>
	<div class="adfy-product-card">
		<span class="adfy-category">{{ category }}</span>
		<div class="adfy-product-box">
			<figure class="adfy-product-thumb">
				<img :src="thumb" :alt="slug" />
			</figure>
			<div class="content">
				<h3 class="adfy-product-title" v-html="name"></h3>
				<p class="adfy-product-description" v-html="description"></p>
				<div class="adfy-product-actions">
					<el-button
						v-if="
							props.status == 'active' ||
							props.status == 'network-active'
						"
						size="large"
						:id="slug"
						plain
						disabled
					>
						{{ installedText }}
					</el-button>
					<el-button
						v-else-if="props.status == 'inactive'"
						type="success"
						size="large"
						:id="slug"
						plain
						:loading="isLoading"
						:disabled="isDisabled"
						@click="activeAddonHandler(slug)"
					>
						{{ isActiviting ? activitingText : activateText }}
					</el-button>
					<el-button
						v-else
						type="primary"
						size="large"
						:id="slug"
						plain
						:loading="isLoading"
						:disabled="isDisabled"
						@click="installAddonHandler(slug)"
					>
						{{ isInstalling ? installingText : installText }}
					</el-button>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
#recommended-hot-products .el-skeleton.is-animated .el-skeleton__item {
	background: linear-gradient(90deg, #e1e1e1 25%, #d8d8d8 37%, #c7c7c7 63%);
	background-size: 400% 100%;
}
</style>
