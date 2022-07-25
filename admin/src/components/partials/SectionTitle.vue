<script setup>
	import { useOptionsStore } from "../../stores/options";
	const props = defineProps({
		section: Object,
		sectionkey: String,
	});
	const store = useOptionsStore();
</script>
<template>
	<h3
		v-if="props.section.title"
		class="option-box-title"
		v-show="
			props.sectionkey == 'general'
				? true
				: store.options.enable_product_comparison
		"
	>
		{{ props.section.title }}
	</h3>
</template>
