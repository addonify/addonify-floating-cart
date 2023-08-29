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
		required: false,
	},
});

/**
 * Define emit.
 * Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
 *
 * @since 1.1.8
 */
const emit = defineEmits(["update:modelValue"]);
const vModalVal = computed({
	get() {
		return props.modelValue;
	},
	set(newValue) {
		emit("update:modelValue", newValue);
	},
});
</script>
<template>
	<el-radio-group v-model="vModalVal">
		<el-radio
			v-for="(value, key) in props.choices"
			:label="key"
			size="large"
			border
		>
			<span v-html="value"></span>
		</el-radio>
	</el-radio-group>
</template>
