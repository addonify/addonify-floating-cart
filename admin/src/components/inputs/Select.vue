<script setup>
	import { computed } from "vue";
	import { ElSelect, ElOption } from "element-plus";
	const { __ } = wp.i18n;

	const props = defineProps({
		modelValue: [Number, String, Array],
		choices: [Object, Array],
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
	<el-select
		v-model="value"
		:placeholder="
			props.placeholder
				? props.placeholder
				: __('Select', 'addonify-wishlist')
		"
		size="large"
	>
		<el-option
			v-for="(label, key) in props.choices"
			:label="label"
			:value="key"
		/>
	</el-select>
</template>
<style lang="css">
	.wp-admin .el-select-dropdown__item.selected {
		font-weight: normal;
	}
</style>
