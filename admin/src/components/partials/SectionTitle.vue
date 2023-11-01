<script setup>
import { useOptionsStore } from "../../stores/options";
const props = defineProps({
	section: Object,
	sectionkey: String,
	currentPage: String,
});
const store = useOptionsStore();

const titleVisibility = (page) => {
	if (page === "design") {
		return props.sectionkey.includes("general")
			? true
			: store.options.load_styles_from_plugin;
	} else if (page === "settings") {
		return props.sectionkey.includes("general")
			? true
			: store.options.enable_floating_cart;
	} else {
		return false;
	}
};
</script>
<template>
	<h3
		v-if="props.section.title"
		class="option-box-title"
		v-show="titleVisibility(props.currentPage)"
	>
		{{ props.section.title }}
	</h3>
</template>
