<script setup>
import { ref, reactive } from "vue";
import {
	ElInput,
	ElSelect,
	ElOption,
	ElRadioButton,
	ElRadioGroup,
} from "element-plus";

/**
 *
 * Define props.
 *
 * @since 1.0.0
 */
const props = defineProps({
	modelValue: {
		type: String,
		required: false,
	},
	choices: {
		type: [Array, Object],
		required: false,
		default: {
			desktop: {
				id: "desktop",
				label: "Desktop",
				icon: "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24px' height='24px'><path d='M4 5V16H20V5H4ZM2 4.00748C2 3.45107 2.45531 3 2.9918 3H21.0082C21.556 3 22 3.44892 22 4.00748V18H2V4.00748ZM1 19H23V21H1V19Z'></path></svg>",
				location: {
					top: "Top",
					right: "Right",
					bottom: "Bottom",
					left: "Left",
				},
				units: {
					percent: "%",
					px: "px",
					em: "em",
					rem: "rem",
				},
				visibility: {
					visible: "Visible",
					hidden: "Hidden",
				},
			},
			tablet: {
				id: "tablet",
				label: "Tablet",
				icon: "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24px' height='24px'><path d='M6 4V20H18V4H6ZM5 2H19C19.5523 2 20 2.44772 20 3V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V3C4 2.44772 4.44772 2 5 2ZM12 17C12.5523 17 13 17.4477 13 18C13 18.5523 12.5523 19 12 19C11.4477 19 11 18.5523 11 18C11 17.4477 11.4477 17 12 17Z'></path></svg>",
				location: {
					top: "Top",
					right: "Right",
					bottom: "Bottom",
					left: "Left",
				},
				units: {
					percent: "%",
					px: "px",
					em: "em",
					rem: "rem",
				},
				visibility: {
					visible: "Visible",
					hidden: "Hidden",
				},
			},
			mobile: {
				id: "mobile",
				label: "Mobile",
				icon: "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24px' height='24px'><path d='M7 4V20H17V4H7ZM6 2H18C18.5523 2 19 2.44772 19 3V21C19 21.5523 18.5523 22 18 22H6C5.44772 22 5 21.5523 5 21V3C5 2.44772 5.44772 2 6 2ZM12 17C12.5523 17 13 17.4477 13 18C13 18.5523 12.5523 19 12 19C11.4477 19 11 18.5523 11 18C11 17.4477 11.4477 17 12 17Z'></path></svg>",
				location: {
					top: "Top",
					right: "Right",
					bottom: "Bottom",
					left: "Left",
				},
				units: {
					percent: "%",
					px: "px",
					em: "em",
					rem: "rem",
				},
				visibility: {
					visible: "Visible",
					hidden: "Hidden",
				},
			},
		},
	},
});

/**
 *
 * Define emits.
 * Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
 *
 * @since 1.1.9
 */
//const emit = defineEmits(["update:modelValue"]);
//const value = computed({
//	get() {
//		return props.modelValue.toString();
//	},
//	set(newValue) {
//		emit("update:modelValue", newValue);
//	},
//});

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
 * Store active device.
 *
 * @since 1.1.9
 */
const activeDevice = ref("desktop");

/**
 *
 * Render icons for direction inputs.
 *
 * @param {string} input. top, right, bottom, left
 * @return {string} icon
 * @since 1.1.9
 */
const renderIcon = (direction) => {
	const icon = {
		top: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13 12V20H11V12H4L12 4L20 12H13Z"></path></svg>',
		right: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 13H4V11H12V4L20 12L12 20V13Z"></path></svg>',
		bottom: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13 12H20L12 20L4 12H11V4H13V12Z"></path></svg>',
		left: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 13V20L4 12L12 4V11H20V13H12Z"></path></svg>',
	};
	return icon[direction];
};

/**
 *
 * Render active device class name by adding prefix `con-` to device id.
 *
 * @param {string} device
 * @return {string} device class name. Example: con-desktop, con-tablet, con-mobile
 * @since 1.1.9
 */
const renderActiveDeviceClass = (device) => `con-${device}`;

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
			return store[activeDevice.value].location.bottom === ""
				? false
				: true;

		case "right":
			return store[activeDevice.value].location.left === ""
				? false
				: true;

		case "bottom":
			return store[activeDevice.value].location.top === "" ? false : true;

		case "left":
			return store[activeDevice.value].location.right === ""
				? false
				: true;
		default:
			return true;
	}
};
</script>
<template>
	<div class="responsive-control">
		<div class="res-toolbar">
			<el-radio-group v-model="activeDevice" size="large">
				<template v-for="device in props.choices">
					<el-radio-button :label="device.id">
						<span v-html="device.icon"></span>
					</el-radio-button>
				</template>
			</el-radio-group>
		</div>
		<div class="res-content">
			<template v-for="device in props.choices">
				<div
					v-show="activeDevice === device.id"
					class="res-position-control"
					:class="renderActiveDeviceClass(device.id)"
				>
					<div class="input-fields">
						<div class="input-field select-input select-visiblity">
							<el-select
								v-model="store[device.id].visibility"
								size="large"
							>
								<el-option
									v-for="(label, key) in device.visibility"
									:label="label"
									:value="key"
								/>
							</el-select>
							<span class="label">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 24 24"
								>
									<g>
										<path
											d="M23.821,11.181v0C22.943,9.261,19.5,3,12,3S1.057,9.261.179,11.181a1.969,1.969,0,0,0,0,1.64C1.057,14.739,4.5,21,12,21s10.943-6.261,11.821-8.181A1.968,1.968,0,0,0,23.821,11.181ZM12,19c-6.307,0-9.25-5.366-10-6.989C2.75,10.366,5.693,5,12,5c6.292,0,9.236,5.343,10,7C21.236,13.657,18.292,19,12,19Z"
										/>
										<path
											d="M12,7a5,5,0,1,0,5,5A5.006,5.006,0,0,0,12,7Zm0,8a3,3,0,1,1,3-3A3,3,0,0,1,12,15Z"
										/>
									</g>
								</svg>
								Visibility
							</span>
						</div>
						<div
							v-for="(posVal, posKey) in device.location"
							class="input-field standard-input"
							:class="
								isFieldDisabled(posKey) ? 'is-disabled' : ''
							"
						>
							<el-input
								v-model.trim="store[device.id].location[posKey]"
								size="large"
								clearable
								minlength="0"
								maxlength="4"
								:change="isFieldDisabled(posKey)"
								:disabled="
									store[device.id].visibility === 'hidden'
										? true
										: isFieldDisabled(posKey)
								"
							/>
							<span class="label" v-html="renderIcon(posKey)">
							</span>
						</div>
						<div
							class="input-field select-input select-unit"
							:class="
								store[device.id].visibility === 'hidden'
									? 'is-disabled'
									: ''
							"
						>
							<el-select
								v-model="store[device.id].unit"
								size="large"
								:disabled="
									store[device.id].visibility === 'hidden'
								"
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
					<!-- // input-fields -->
				</div>
			</template>
			<div class="debug">
				<p>Active device is: {{ activeDevice }}</p>
				<p>// ===================================</p>
				<p>Here's reactive state that actually changes.</p>
				<pre>{{ store }}</pre>
			</div>
		</div>
	</div>
</template>
<style>
.debug {
	margin-top: 50px;
}
</style>
