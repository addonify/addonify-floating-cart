<script setup>
	import { computed } from "vue";
	import { ElCheckboxGroup, ElCheckboxButton } from "element-plus";

	/**
	 * Define props.
	 *
	 * @since 1.0.0
	 */
	const props = defineProps({
		modelValue: [Array],
		choices: Object,
	});

	/**
	 * Define emit.
	 *
	 * @since 1.0.0
	 */
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
	<el-checkbox-group v-model="value" size="large">
		<el-checkbox-button v-for="(label, key) in props.choices" :label="key">
			{{ label }}
		</el-checkbox-button>
	</el-checkbox-group>
</template>
