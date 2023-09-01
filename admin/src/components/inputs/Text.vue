<script setup>
import { computed } from "vue";
import { ElInput } from "element-plus";

/**
 * Define props
 *
 * @since 1.0.0
 */
const props = defineProps({
	modelValue: String,
	placeholder: String,
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
		:placeholder="
			props.placeholder
				? props.placeholder
				: __('Enter text here...', 'addonify-floating-cart')
		"
		size="large"
	/>
</template>
