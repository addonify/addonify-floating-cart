<script setup>
	import { computed } from "vue";
	import { ElCheckboxGroup, ElCheckboxButton } from "element-plus";
	const props = defineProps({
		modelValue: [Array],
		choices: Object,
	});

	const emit = defineEmits(["update:modelValue"]); // Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
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
