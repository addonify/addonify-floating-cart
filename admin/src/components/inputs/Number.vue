<script setup>
import { computed } from "vue";
import { ElInput, ElInputNumber, ElSlider } from "element-plus";

/**
 * Define props.
 *
 * @since 1.2.8
 */
const props = defineProps({
	modelValue: {
		type: [Number, String],
		required: true,
	},
	min: {
		type: [String, Number],
		required: false,
	},
	max: {
		type: [String, Number],
		required: false,
	},
	step: {
		type: [String, Number],
		required: false,
	},
	precision: {
		type: [String, Number],
		required: false,
	},
	placeholder: {
		type: String,
		required: false,
		default: "",
	},
	style: {
		type: String,
		required: false,
		default: "default",
	},
	unit: {
		type: String,
		required: false,
		default: "px",
	},
	sliderDirection: {
		type: String,
		required: false,
		default: "horizontal",
	},
});

// Desctructure props.
const { style, min, max, precision, step, unit, placeholder } = props;

/**
 * Define emit.
 *
 * @param {String/Number} value
 * @returns {String/Number} updated value
 * @since 1.2.8
 */
const emit = defineEmits(["update:modelValue"]);
const value = computed({
	get() {
		return parseFloat(props.modelValue);
	},
	set(newValue) {
		emit("update:modelValue", newValue);
	},
});

/**
 * Add the unit to the tooltip for slider control.
 *
 * @param {Number} val
 * @returns {String} i.e 10px
 * @since 1.2.8
 */
const processToolTip = (val) => val + " " + unit;
</script>
<template>
	<template v-if="style === 'default'">
		<el-input
			type="number"
			v-model="value"
			:min="min ? min : 0"
			:max="max"
			:step="step"
			:precision="precision"
			:placeholder="placeholder"
		/>
	</template>
	<template v-if="style === 'buttons-plus-minus'">
		<el-input-number
			v-model="value"
			size="large"
			:min="min ? min : 0"
			:max="max"
			:step="step"
			:precision="precision"
			:placeholder="placeholder"
		/>
	</template>
	<template v-if="style === 'buttons-arrows'">
		<el-input-number
			v-model="value"
			size="large"
			:min="min ? min : 0"
			:max="max"
			:step="step"
			:precision="precision"
			:placeholder="placeholder"
			controls-position="right"
		/>
	</template>
	<template v-if="style === 'slider'">
		<el-slider
			v-model="value"
			show-tooltip
			:min="min"
			:max="max"
			:step="step ? step : 1"
			:format-tooltip="processToolTip"
			size="large"
		/>
	</template>
</template>
