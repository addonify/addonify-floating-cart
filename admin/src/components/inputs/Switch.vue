<script setup>
import { computed } from "vue";
import { ElSwitch } from "element-plus";
import { Check, Close } from "@element-plus/icons-vue";

const props = defineProps({
	modelValue: {
		type: [Boolean, String],
		required: true,
	},
});

// Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
const emit = defineEmits(["update:modelValue"]);
const value = computed({
	get() {
		let vals = props.modelValue;
		if (typeof vals === "boolean") {
			return vals;
		}
		if (typeof vals === "string") {
			return vals === "1" ? true : false;
		}
	},
	set(newValue) {
		emit("update:modelValue", newValue);
	},
});

//console.log(typeof props.modelValue);
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
