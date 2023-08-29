<script setup>
import { computed } from "vue";
import { ElInput } from "element-plus";

/**
 * Define props
 *
 * @since 1.0.0
 */
const props = defineProps({
	modelValue: {
		type: String,
		required: false,
	},
	className: {
		type: String,
		required: false,
	},
	placeholder: {
		type: String,
		required: false,
	},
});

/**
 * Define emit.
 * Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
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

const { __ } = wp.i18n;
</script>
<template>
	<el-input
		v-model="value"
		:class="className"
		type="textarea"
		rows="10"
		:placeholder="
			props.placeholder
				? props.placeholder
				: __('Enter text here...', 'addonify-floating-cart')
		"
		resize="vertical"
		input-style="display:block;width: 100%;"
	/>
</template>
<style>
.adfy-options .el-textarea__inner {
	display: block;
	width: 100%;
	font-family: monospace;
	min-height: 200px;
	padding: 15px;
}
</style>
