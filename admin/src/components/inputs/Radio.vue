<script setup>
	import { computed } from "vue";
	import { ElRadio, ElRadioGroup } from "element-plus";
	const props = defineProps({
		modelValue: String,
		choices: [Object, Array],
		renderChoices: String,
	});

	// Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
	const emit = defineEmits(["update:modelValue"]);
	const vModelVal = computed({
		get() {
			return props.modelValue;
		},
		set(newValue) {
			emit("update:modelValue", newValue);
		},
	});

	const { choices, renderChoices } = props;
</script>
<template>
	<div v-if="renderChoices == 'html'" class="adfy-radio-input">
		<el-radio
			v-model="vModelVal"
			v-for="(value, key) in choices"
			:label="key"
		>
			<span v-html="value"></span>
		</el-radio>
	</div>
	<div v-else class="adfy-radio-group">
		<el-radio-group v-model="vModelVal" v-for="(value, key) in choices">
			<el-radio :label="key"> {{ value }} </el-radio>
		</el-radio-group>
	</div>
</template>
<style lang="scss">
	.radio-input-group.svg-icons-choices {
		.adfy-radio-input {
			display: flex;
			flex-direction: row;
			align-items: center;
			gap: 20px;

			label.el-radio {
				display: inline-flex;
				align-items: center;
				border: 1px solid var(--addonify_border_color);
				padding: 20px;
				margin: 0;
				border-radius: 4px;

				svg {
					fill: #444444;
					width: 16px;
					height: 16px;
					line-height: 1;
				}
			}

			label.el-radio.is-checked {
				border-color: #468cff;

				svg {
					fill: #468cff;
				}
			}
		}
	}
</style>
