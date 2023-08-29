<script setup>
import { computed } from "vue";
import { ElRadio, ElRadioGroup } from "element-plus";

/**
 * Define props.
 *
 * @since 1.1.8
 */
const props = defineProps({
	modelValue: {
		type: String,
		required: true,
	},
	choices: {
		type: [Object, Array],
		required: true,
	},
	style: {
		type: String,
		required: false,
		default: "default",
	},
});

/**
 * Define emit.
 * Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
 *
 * @since 1.1.8
 */
const emit = defineEmits(["update:modelValue"]);
const vModelVal = computed({
	get() {
		return props.modelValue;
	},
	set(newValue) {
		emit("update:modelValue", newValue);
	},
});
</script>
<template>
	<el-radio-group v-model="vModelVal">
		<el-radio v-for="(value, key) in props.choices" :label="key">
			{{ value }}
		</el-radio>
	</el-radio-group>
</template>
