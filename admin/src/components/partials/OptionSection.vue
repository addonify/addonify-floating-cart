<script setup>
import { useOptionsStore } from "../../stores/options";

/**
 * Define props.
 *
 * @since 1.0.0
 */
const props = defineProps({
	sectionKey: {
		type: String,
		required: true,
	},
	currentPage: {
		type: String,
		required: true,
	},
	className: {
		type: String,
		required: false,
	},
});

const { className, sectionKey, currentPage } = props;
const store = useOptionsStore();

/**
 * Keys for options.
 *
 * @since 1.0.0
 */
const enablePlugin = "enable_floating_cart";
const enableStyles = "load_styles_from_plugin";

/**
 * Render options section
 *
 * @param {null} null
 * @return {boolean} true|false
 * @since 1.2.9
 */
const renderOptionsSection = () => {
	switch (currentPage) {
		case "settings":
			return store.options[enablePlugin];
		case "design":
			return store.options[enableStyles];
		default:
			return false;
	}
};
</script>
<template>
	<section
		class="addonify-section"
		:class="className"
		:data_section="sectionKey"
		v-if="sectionKey === 'general' ? true : renderOptionsSection()"
	>
		<slot></slot>
	</section>
</template>
