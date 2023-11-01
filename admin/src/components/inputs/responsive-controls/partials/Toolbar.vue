<script setup>
import { computed } from "vue";
import { ElRadioButton, ElRadioGroup } from "element-plus";

/**
 *
 * Define props.
 *
 * @since 1.0.0
 */
const props = defineProps({
	modelValue: {
		type: String,
		required: true,
	},
	choices: {
		type: [Array, Object],
		required: true,
	},
});

/**
 *
 * Define emits.
 * Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
 *
 * @since 1.1.9
 */
const emit = defineEmits(["update:modelValue"]);
const currentDevice = computed({
	get() {
		return props.modelValue.toString();
	},
	set(newValue) {
		emit("update:modelValue", newValue);
	},
});

/**
 *
 * Render icons for direction inputs.
 *
 * @param {string} key string. i.e: desktop, tablet, mobile
 * @return {string} icon SVG.
 * @since 1.1.9
 */
const renderIcon = (key) => {
	const icons = {
		desktop:
			"<svg viewBox='0 0 24 24'><path d='M4 5V16H20V5H4ZM2 4.00748C2 3.45107 2.45531 3 2.9918 3H21.0082C21.556 3 22 3.44892 22 4.00748V18H2V4.00748ZM1 19H23V21H1V19Z'></path></svg>",
		tablet: "<svg viewBox='0 0 24 24'><path d='M6 4V20H18V4H6ZM5 2H19C19.5523 2 20 2.44772 20 3V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V3C4 2.44772 4.44772 2 5 2ZM12 17C12.5523 17 13 17.4477 13 18C13 18.5523 12.5523 19 12 19C11.4477 19 11 18.5523 11 18C11 17.4477 11.4477 17 12 17Z'></path></svg>",
		mobile: "<svg viewBox='0 0 24 24'><path d='M7 4V20H17V4H7ZM6 2H18C18.5523 2 19 2.44772 19 3V21C19 21.5523 18.5523 22 18 22H6C5.44772 22 5 21.5523 5 21V3C5 2.44772 5.44772 2 6 2ZM12 17C12.5523 17 13 17.4477 13 18C13 18.5523 12.5523 19 12 19C11.4477 19 11 18.5523 11 18C11 17.4477 11.4477 17 12 17Z'></path></svg>",
	};
	return icons[key];
};
</script>
<template>
	<div class="res-toolbar">
		<el-radio-group v-model="currentDevice" size="large">
			<template v-for="device in props.choices">
				<el-radio-button :label="device.id">
					<span v-html="renderIcon(device.id)"></span>
				</el-radio-button>
			</template>
		</el-radio-group>
	</div>
</template>
