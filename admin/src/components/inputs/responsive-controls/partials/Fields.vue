<script setup>
import { reactive } from "vue";
import { ElInput, ElSelect, ElOption } from "element-plus";
import Debugger from "./Debugger.vue";

/**
 * Define props.
 *
 * @since 1.0.0
 */
const props = defineProps({
	activeDevice: {
		type: String,
		required: true,
	},
	device: {
		type: [Object, Array],
		required: true,
	},
	className: {
		type: String,
		required: false,
	},
});

const { device } = props;

/**
 *
 * Mock store.
 * @todo: Replace this with pinia store.
 *
 * @since 1.1.9
 */
const store = reactive({
	desktop: {
		id: "desktop",
		visibility: "visible",
		location: {
			top: "",
			right: "40",
			bottom: "40",
			left: "",
		},
		unit: "px",
	},
	tablet: {
		id: "tablet",
		visibility: "hidden",
		location: {
			top: "",
			right: "",
			bottom: "",
			left: "",
		},
		unit: "px",
	},
	mobile: {
		id: "mobile",
		visibility: "visible",
		location: {
			top: "",
			right: "",
			bottom: "1",
			left: "1",
		},
		unit: "percent",
	},
});

/**
 *
 * Disable direction input field.
 *
 * @param {string} field. i.e: top, right, bottom, left
 * @return {boolean} true | false.
 * @since 1.1.9
 */
const isFieldDisabled = (field) => {
	switch (field) {
		case "top":
			return store[props.activeDevice].location.bottom === ""
				? false
				: true;

		case "right":
			return store[props.activeDevice].location.left === ""
				? false
				: true;

		case "bottom":
			return store[props.activeDevice].location.top === "" ? false : true;

		case "left":
			return store[props.activeDevice].location.right === ""
				? false
				: true;
		default:
			return true;
	}
};

/**
 *
 * Render icons for direction inputs.
 *
 * @param {string} key string. i.e: top, right, bottom, left
 * @return {string} icon SVG.
 * @since 1.1.9
 */
const renderIcon = (key) => {
	const icons = {
		top: '<svg viewBox="0 0 24 24"><path d="M13 12V20H11V12H4L12 4L20 12H13Z"></path></svg>',
		right: '<svg viewBox="0 0 24 24"><path d="M12 13H4V11H12V4L20 12L12 20V13Z"></path></svg>',
		bottom: '<svg viewBox="0 0 24 24"><path d="M13 12H20L12 20L4 12H11V4H13V12Z"></path></svg>',
		left: '<svg viewBox="0 0 24 24"><path d="M12 13V20L4 12L12 4V11H20V13H12Z"></path></svg>',
		eye: '<svg viewBox="0 0 24 24"> <g> <path d="M23.821,11.181v0C22.943,9.261,19.5,3,12,3S1.057,9.261.179,11.181a1.969,1.969,0,0,0,0,1.64C1.057,14.739,4.5,21,12,21s10.943-6.261,11.821-8.181A1.968,1.968,0,0,0,23.821,11.181ZM12,19c-6.307,0-9.25-5.366-10-6.989C2.75,10.366,5.693,5,12,5c6.292,0,9.236,5.343,10,7C21.236,13.657,18.292,19,12,19Z"/><path d="M12,7a5,5,0,1,0,5,5A5.006,5.006,0,0,0,12,7Zm0,8a3,3,0,1,1,3-3A3,3,0,0,1,12,15Z" /></g></svg>',
	};
	return icons[key];
};
</script>
<template>
	<div class="input-fields" :class="className">
		<div class="input-field select-input select-visiblity">
			<el-select v-model="store[device.id].visibility" size="large">
				<el-option
					v-for="(label, key) in device.visibility"
					:label="label"
					:value="key"
				/>
			</el-select>
			<span class="label">
				<span v-html="renderIcon('eye')"> </span>
				Visibility
			</span>
		</div>
		<div
			v-for="(posVal, posKey) in device.location"
			class="input-field standard-input"
			:class="isFieldDisabled(posKey) ? 'is-disabled' : ''"
		>
			<el-input
				v-model.trim="store[device.id].location[posKey]"
				size="large"
				clearable
				minlength="0"
				maxlength="4"
				:input="isFieldDisabled(posKey)"
				:disabled="
					store[device.id].visibility === 'hidden'
						? true
						: isFieldDisabled(posKey)
				"
			/>
			<span class="label" v-html="renderIcon(posKey)"> </span>
		</div>
		<div
			class="input-field select-input select-unit"
			:class="
				store[device.id].visibility === 'hidden' ? 'is-disabled' : ''
			"
		>
			<el-select
				v-model="store[device.id].unit"
				size="large"
				:disabled="store[device.id].visibility === 'hidden'"
			>
				<el-option
					v-for="(label, key) in device.units"
					:label="label"
					:value="key"
				/>
			</el-select>
			<span class="label"> Unit </span>
		</div>
	</div>
	<Debugger
		mode="console"
		:activeDevice="props.activeDevice"
		:store="store"
	/>
</template>
