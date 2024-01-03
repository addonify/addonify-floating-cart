<script setup>
import { computed } from "vue";
import { ElSwitch } from "element-plus";
import { Check, Close } from "@element-plus/icons-vue";

/**
 * Define props
 *
 * @since 1.0.0
 */
const props = defineProps({
	modelValue: {
		type: [String, Boolean, Number],
		required: true,
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
		switch (typeof props.modelValue) {
			case "boolean":
				return props.modelValue;
			case "number":
				return props.modelValue > 0;
			case "string":
				return props.modelValue === "1" ? true : false;
			default:
				return false;
		}
	},
	set(newValue) {
		emit("update:modelValue", newValue);
	},
});
</script>
<template>
	<el-switch
		v-model="value"
		size="large"
		inline-prompt
		:active-icon="Check"
		:inactive-icon="Close"
	/>
</template>
