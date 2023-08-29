<script setup>
	import { computed } from "vue";
	import { ElInputNumber } from "element-plus";

	/**
	 * Define props.
	 *
	 * @since 1.0.0
	 */
	const props = defineProps({
		modelValue: [String, Number], // loose strict checking.
		min: Number,
		max: Number,
	});

	const { min, max } = props;

	/**
	 * Define emit.
	 *
	 * @since 1.0.0
	 */
	const emit = defineEmits(["update:modelValue"]);
	const value = computed({
		get() {
			return parseInt(props.modelValue);
		},
		set(newValue) {
			emit("update:modelValue", newValue);
		},
	});
</script>
<template>
	<el-input-number
		v-model="value"
		size="large"
		:min="min ? min : 0"
		:max="max ? max : 365"
	/>
</template>
