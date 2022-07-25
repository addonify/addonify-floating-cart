<script setup>
	import Switch from "../inputs/Switch.vue";
	import Text from "../inputs/Text.vue";
	import Textarea from "../inputs/Textarea.vue";
	import Number from "../inputs/Number.vue";
	import Select from "../inputs/Select.vue";
	import Checkbox from "../inputs/Checkbox.vue";
	import CheckboxButton from "../inputs/CheckboxButton.vue";
	import Radio from "../inputs/Radio.vue";
	import ColorPicker from "../inputs/ColorPicker.vue";
	import InvalidControl from "../inputs/InvalidControl.vue";
	import NumberToggleButton from "../inputs/NumberToggleButton.vue";
	const props = defineProps({
		field: Object,
		fieldKey: String,
		label: String,
		reactiveState: Object,
	});
</script>
<template>
	<Switch
		v-if="props.field.type == 'switch'"
		v-model="props.reactiveState[props.fieldKey]"
	/>
	<Select
		v-else-if="props.field.type == 'select'"
		v-model="props.reactiveState[props.fieldKey]"
		:choices="props.field.choices"
		:placeholder="props.field.placeholder"
	/>
	<Text
		v-else-if="props.field.type == 'text'"
		v-model="props.reactiveState[props.fieldKey]"
		:placeholder="props.field.placeholder"
	/>
	<Textarea
		v-else-if="props.field.type == 'textarea'"
		v-model="props.reactiveState[props.fieldKey]"
		:placeholder="props.field.placeholder"
	/>
	<CheckboxButton
		v-else-if="
			props.field.type == 'checkbox' && props.field.typeStyle == 'buttons'
		"
		v-model="props.reactiveState[props.fieldKey]"
		:choices="props.field.choices"
	/>
	<Checkbox
		v-else-if="props.field.type == 'checkbox'"
		v-model="props.reactiveState[props.fieldKey]"
		:choices="props.field.choices"
	/>
	<NumberToggleButton
		v-else-if="
			props.field.type == 'number' && props.field.typeStyle == 'toggle'
		"
		v-model="props.reactiveState[props.fieldKey]"
		:placeholder="props.field.placeholder"
	/>
	<Number
		v-else-if="props.field.type == 'number'"
		v-model="props.reactiveState[props.fieldKey]"
		:placeholder="props.field.placeholder"
	/>
	<Radio
		v-else-if="props.field.type == 'radio'"
		v-model="props.reactiveState[props.fieldKey]"
		:choices="props.field.choices"
		:renderChoices="props.field.renderChoices"
	/>
	<ColorPicker
		v-else-if="props.field.type == 'color'"
		v-model:colorVal="props.reactiveState[props.fieldKey]"
		:isAlphaPicker="props.field.isAlphaPicker"
		:label="props.field.label"
	/>
	<InvalidControl v-else />
</template>
