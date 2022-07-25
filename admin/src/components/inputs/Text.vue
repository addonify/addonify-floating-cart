<script setup>
	import { computed } from "vue";
	import { ElInput } from "element-plus";
	const { __ } = wp.i18n;
	const props = defineProps({
		modelValue: String,
		placeholder: String,
	});
	// Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
	const emit = defineEmits(["update:modelValue"]);
	const value = computed({
		get() {
			return props.modelValue;
		},
		set(newValue) {
			emit("update:modelValue", newValue);
		},
	});
</script>
<template>
	<el-input
		v-model="value"
		:placeholder="
			props.placeholder
				? props.placeholder
				: __('Enter text here...', 'addonify-wishlist')
		"
		size="large"
	/>
</template>
