<script setup>
import Switch from "../inputs/Switch.vue";
import Text from "../inputs/Text.vue";
import Textarea from "../inputs/Textarea.vue";
import Number from "../inputs/Number.vue";
import Select from "../inputs/Select.vue";
import Checkbox from "../inputs/Checkbox.vue";
import CheckboxButton from "../inputs/CheckboxButton.vue";
import Radio from "../inputs/Radio.vue";
import RadioIcon from "../inputs/RadioIcon.vue";
import ColorPicker from "../inputs/ColorPicker.vue";
import InvalidControl from "../inputs/InvalidControl.vue";
//import { consoleLog } from "../../utils/debug.helper.js";

/**
 * Define props.
 *
 * @since 1.0.0
 */
const props = defineProps({
	field: {
		type: Object,
		required: true,
	},
	fieldKey: {
		type: String,
		required: true,
	},
	label: {
		type: String,
		required: false,
	},
	reactiveState: {
		type: Object,
		required: true,
	},
});

//if (props.field.type == "switch") {
//	consoleLog(props.field.label + ": " + props.reactiveState[props.fieldKey]);
//}
</script>
<template>
	<Switch
		v-if="props.field.type === 'switch'"
		v-model="props.reactiveState[props.fieldKey]"
	/>
	<Select
		v-else-if="props.field.type === 'select'"
		v-model="props.reactiveState[props.fieldKey]"
		:choices="props.field.choices"
		:placeholder="props.field.placeholder"
	/>
	<Text
		v-else-if="props.field.type === 'text'"
		v-model="props.reactiveState[props.fieldKey]"
		:placeholder="props.field.placeholder"
	/>
	<Textarea
		v-else-if="props.field.type === 'textarea'"
		v-model="props.reactiveState[props.fieldKey]"
		:placeholder="props.field.placeholder"
	/>
	<CheckboxButton
		v-else-if="
			props.field.type === 'checkbox' &&
			props.field.typeStyle === 'buttons'
		"
		v-model="props.reactiveState[props.fieldKey]"
		:choices="props.field.choices"
	/>
	<Checkbox
		v-else-if="props.field.type === 'checkbox'"
		v-model="props.reactiveState[props.fieldKey]"
		:choices="props.field.choices"
	/>
	<Number
		v-else-if="props.field.type === 'number'"
		v-model="props.reactiveState[props.fieldKey]"
		:placeholder="props.field.placeholder"
		:style="props.field.style"
		:min="props.field.min"
		:max="props.field.max"
		:step="props.field.step"
		:precision="props.field.precision"
		:unit="props.field.unit"
	/>
	<Radio
		v-else-if="props.field.type === 'radio'"
		v-model="props.reactiveState[props.fieldKey]"
		:choices="props.field.choices"
		:style="props.field.style"
	/>
	<RadioIcon
		v-else-if="props.field.type === 'radio-icons'"
		v-model="props.reactiveState[props.fieldKey]"
		:choices="props.field.choices"
	/>
	<ColorPicker
		v-else-if="props.field.type === 'color'"
		v-model:colorVal="props.reactiveState[props.fieldKey]"
		:isAlpha="props.field.isAlpha"
		:label="props.field.label"
	/>
	<InvalidControl v-else />
</template>
