<script setup>
	import { computed } from "vue";
	import { ElInputNumber } from "element-plus";
	const props = defineProps({
		modelValue: [String, Number], // loose strict checking.
		min: Number,
		max: Number,
	});

	// Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
	const emit = defineEmits(["update:modelValue"]);
	const value = computed({
		get() {
			return parseInt(props.modelValue);
		},
		set(newValue) {
			emit("update:modelValue", newValue);
		},
	});
	const { min, max } = props;
</script>
<template>
	<el-input-number
		v-model="value"
		size="large"
		:min="min ? min : 0"
		:max="max ? max : 365"
	/>
</template>
<style lang="scss">
	.adfy-options {
		.el-input-number--large {
			width: 140px;
		}
	}
</style>
