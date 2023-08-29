<script setup>
import { ElTag } from "element-plus";
import Icon from "../icons/Icons.vue";
import InputControl from "./InputControl.vue";
import { useOptionsStore } from "../../stores/options";

/**
 * Define props.
 *
 * @since 1.0.0
 */
const props = defineProps({
	section: {
		type: Object,
		required: true,
	},
	sectionKey: {
		type: String,
		required: true,
	},
	reactiveState: {
		type: Object,
		required: true,
	},
	currentPage: {
		type: String,
		required: true,
	},
});

const store = useOptionsStore();

const { currentPage } = props;

/**
 * Keys for options.
 *
 * @since 1.0.0
 */
const enablePlugin = "enable_floating_cart";
const enableStyles = "load_styles_from_plugin";

/**
 * Option dependency handler.
 *
 * @param {string|array} args Option dependency.
 * @return {boolean} true if option is enabled, false otherwise.
 * @since 1.0.0
 */
function optionDependency(args) {
	if (Array.isArray(args)) {
		return args.every((key) => {
			return store.options[key];
		});
	} else {
		return store.options[args];
	}
}

/**
 * Option visibility handler.
 *
 * @param {string} key Option key.
 * @param {string|array} dependent Option dependency.
 * @return {boolean} true if option is visible, false otherwise.
 * @since 1.0.0
 */
function optionVisibility(key, dependent) {
	switch (currentPage) {
		case "settings":
			return key === enablePlugin ? true : optionDependency(dependent);
		case "design":
			return key === enableStyles ? true : optionDependency(dependent);
		default:
			return false;
	}
}
</script>
<template>
	<slot></slot>
	<template v-for="(field, key) in props.section.fields">
		<div v-if="optionVisibility(key, field.dependent)" class="adfy-options">
			<div
				class="adfy-option-columns option-box"
				:class="field.className"
			>
				<div class="adfy-col left">
					<div class="label">
						<p v-if="field.label" class="option-label">
							{{ field.label }}
							<el-tag v-if="field.badge">
								{{ field.badge }}
							</el-tag>
						</p>
						<p v-if="field.description" class="option-description">
							<span class="icon">
								<Icon icon="bulb-solid" />
							</span>
							<span class="text">
								{{ field.description }}
							</span>
						</p>
					</div>
				</div>
				<div class="adfy-col right">
					<div class="input">
						<InputControl
							:field="field"
							:fieldKey="key"
							:reactiveState="props.reactiveState"
						/>
					</div>
				</div>
			</div>
		</div>
	</template>
</template>
