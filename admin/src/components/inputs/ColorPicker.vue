<script setup>
import { computed } from "vue";
import { ElColorPicker } from "element-plus";

const props = defineProps({
	colorVal: String,
	isAlphaPicker: [Boolean, String],
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

const handleColorChanged = (color) => {
	// Emit the color immediately. Don't wait till the "ok" button is clicked.
	emit("update:colorVal", color);
};

//console.log(props.isAlphaPicker);
</script>
<template>
	<el-color-picker
		v-model="value"
		:show-alpha="props.isAlphaPicker ? props.isAlphaPicker : true"
		@active-change="handleColorChanged"
	/>
	<span class="label" v-if="props.label">{{ props.label }}</span>
</template>
<style>
[class*="addonify_page"] .el-color-picker__panel.el-popper {
	padding: 15px;
	box-shadow: 0 0 30px 10px rgba(0, 0, 0, 0.1);
	border-radius: 10px;
}

.adfy-options .el-color-picker__trigger,
.adfy-options .el-color-picker__color,
.adfy-options .el-color-picker__color-inner {
	border-radius: 100%;
	border: none;
}

.adfy-options .el-color-picker__trigger {
	height: 42px;
	width: 42px;
	padding: 3px;
	border: 2px solid white;
	box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
}

.adfy-options .el-color-picker .el-color-picker__icon {
	font-size: 16px;
	color: white;
	line-height: 1;
}

.adfy-options .el-color-picker .el-color-picker__empty {
	font-size: 20px;
	color: red;
	line-height: 1;
}
</style>
