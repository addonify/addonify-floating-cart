<script setup>
	import { computed } from "vue";
	import { ElColorPicker } from "element-plus";

	/**
	 * Define props.
	 *
	 * @since 1.0.0
	 */
	const props = defineProps({
		colorVal: String,
		isAlpha: [Boolean, String],
		label: String,
	});

	/**
	 * Define emit.
	 *
	 * @since 1.0.0
	 */
	const emit = defineEmits(["update:colorVal"]);
	const value = computed({
		get() {
			return props.colorVal;
		},
		set(newValue) {
			emit("update:colorVal", newValue);
		},
	});

	/**
	 * Handle color changed.
	 * Emit the color immediately. Don't wait till the "ok" button is clicked.
	 *
	 * @since 1.0.0
	 */
	const handleColorChanged = (color) => {
		emit("update:colorVal", color);
	};
</script>
<template>
	<el-color-picker
		v-model="value"
		:show-alpha="props.isAlpha"
		@active-change="handleColorChanged"
	/>
</template>
