<script setup>
	import { computed } from "vue";
	import { ElInput } from "element-plus";
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
	<el-input type="number" v-model="value" :min="min ? min : 0" :max="max" />
</template>
