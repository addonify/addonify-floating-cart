<script setup>
	import { computed } from "vue";
	import { ElColorPicker } from "element-plus";
	const props = defineProps({
		colorVal: String,
		isAlphaPicker: Boolean,
		label: String,
	});
	const emit = defineEmits(["update:colorVal"]); // Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
	const value = computed({
		get() {
			return props.colorVal;
		},
		set(newValue) {
			emit("update:colorVal", newValue);
		},
	});
	console.log(props.isAlphaPicker);
</script>
<template>
	<el-color-picker
		v-model="value"
		:show-alpha="props.isAlphaPicker ? props.isAlphaPicker : true"
	/>
	<span class="label" v-if="props.label">{{ props.label }}</span>
</template>
<style>
	.adfy-options .el-color-picker__trigger,
	.adfy-options .el-color-picker__color,
	.adfy-options .el-color-picker__color-inner {
		border-radius: 100%;
	}
	.adfy-options .el-color-picker__color {
		border: none;
	}
	.adfy-options .el-color-picker__trigger {
		height: 36px;
		width: 36px;
		padding: 5px;
		border: 2px dotted #bbbbbb;
	}
</style>
