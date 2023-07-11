<script setup>
import { onMounted, ref, reactive, watchEffect, watch, computed } from "vue";
import {
	ElInput,
	ElIcon,
	ElSelect,
	ElOption,
	ElRadioButton,
	ElRadioGroup,
} from "element-plus";
import { Top, Right, Bottom, Back, View } from "@element-plus/icons-vue";

/**
 *
 * Define props.
 *
 * @since 1.0.0
 */

const props = defineProps({});

const device = ref("D");

/**
 *
 * Responsive control. Desktop, tablet, mobile
 * Has distance offset option: top, right, bottom, left. If empty, it will be auto.
 * Has unit option: %, px, em & rem.
 *
 * @since 1.0.0
 */

const position = reactive({
	desktop: {
		visibility: "Visible",
		values: {
			left: "",
			right: "",
			top: "",
			bottom: "",
		},
		unit: "px",
	},
	tablet: {
		visibility: "Hidden",
		values: {
			left: "",
			right: "",
			top: "",
			bottom: "",
		},
		unit: "px",
	},
	mobile: {
		visibility: "Visible",
		values: {
			left: "",
			right: "",
			top: "",
			bottom: "",
		},
		unit: "px",
	},
});

const units = ["%", "px", "em", "rem"];
const visibilityOptions = ["Visible", "Hidden"];

onMounted(() => {
	watchEffect(() => {
		console.log(position);
	});

	watch(
		position,
		(newVal, oldVal) => {
			console.log(newVal);
		},
		{ deep: true }
	);
});
</script>
<template>
	<div class="responsive-control">
		<div class="res-toolbar">
			<el-radio-group v-model="device" size="large">
				<el-radio-button label="D">
					<svg
						xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 24 24"
						width="24px"
						height="24px"
					>
						<path
							d="M4 5V16H20V5H4ZM2 4.00748C2 3.45107 2.45531 3 2.9918 3H21.0082C21.556 3 22 3.44892 22 4.00748V18H2V4.00748ZM1 19H23V21H1V19Z"
						></path>
					</svg>
				</el-radio-button>
				<el-radio-button label="T">
					<svg
						xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 24 24"
						width="24px"
						height="24px"
					>
						<path
							d="M6 4V20H18V4H6ZM5 2H19C19.5523 2 20 2.44772 20 3V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V3C4 2.44772 4.44772 2 5 2ZM12 17C12.5523 17 13 17.4477 13 18C13 18.5523 12.5523 19 12 19C11.4477 19 11 18.5523 11 18C11 17.4477 11.4477 17 12 17Z"
						></path>
					</svg>
				</el-radio-button>
				<el-radio-button label="M">
					<svg
						xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 24 24"
						width="24px"
						height="24px"
					>
						<path
							d="M7 4V20H17V4H7ZM6 2H18C18.5523 2 19 2.44772 19 3V21C19 21.5523 18.5523 22 18 22H6C5.44772 22 5 21.5523 5 21V3C5 2.44772 5.44772 2 6 2ZM12 17C12.5523 17 13 17.4477 13 18C13 18.5523 12.5523 19 12 19C11.4477 19 11 18.5523 11 18C11 17.4477 11.4477 17 12 17Z"
						></path>
					</svg>
				</el-radio-button>
			</el-radio-group>
		</div>
		<div class="res-content">
			<div
				v-show="device === 'D'"
				class="res-position-control con-desktop"
			>
				<div class="input-fields">
					<div class="input-field select-input select-visiblity">
						<el-select
							v-model="position.desktop.visibility"
							size="large"
						>
							<el-option
								v-for="(label, key) in visibilityOptions"
								:label="label"
								:value="key"
							/>
						</el-select>
						<span class="label">
							<el-icon><View /></el-icon>
							Visibility
						</span>
					</div>
					<div class="input-field standard-input">
						<el-input
							v-model="position.desktop.values.top"
							size="large"
							pattern="^(auto|[0-9])$"
							minlength="0"
							maxlength="4"
							clearable
						/>
						<span class="label">
							<el-icon><Top /></el-icon>
						</span>
					</div>
					<div class="input-field standard-input">
						<el-input
							v-model="position.desktop.values.right"
							size="large"
							pattern="^(auto|[0-9])$"
							minlength="0"
							maxlength="4"
							clearable
						/>
						<span class="label">
							<el-icon><Right /></el-icon>
						</span>
					</div>
					<div class="input-field standard-input">
						<el-input
							v-model="position.desktop.values.bottom"
							size="large"
							pattern="^(auto|[0-9])$"
							minlength="0"
							maxlength="4"
							clearable
						/>
						<span class="label">
							<el-icon><Bottom /></el-icon>
						</span>
					</div>
					<div class="input-field standard-input">
						<el-input
							v-model="position.desktop.values.left"
							size="large"
							pattern="^(auto|[0-9])$"
							minlength="0"
							maxlength="4"
							clearable
						/>
						<span class="label">
							<el-icon><Back /></el-icon>
						</span>
					</div>
					<div class="input-field select-input select-unit">
						<el-select v-model="position.desktop.unit" size="large">
							<el-option
								v-for="(label, key) in units"
								:label="label"
								:value="key"
							/>
						</el-select>
						<span class="label"> Unit </span>
					</div>
				</div>
			</div>
			<div
				v-show="device === 'T'"
				class="res-position-control con-tablet"
			>
				<div class="input-fields">
					<div class="input-field select-input select-visiblity">
						<el-select
							v-model="position.tablet.visibility"
							size="large"
						>
							<el-option
								v-for="(label, key) in visibilityOptions"
								:label="label"
								:value="key"
							/>
						</el-select>
						<span class="label">
							<el-icon><View /></el-icon>
							Visibility
						</span>
					</div>
					<div class="input-field standard-input">
						<el-input
							v-model="position.tablet.values.top"
							size="large"
							pattern="^(auto|[0-9])$"
							minlength="0"
							maxlength="4"
							clearable
						/>
						<span class="label">
							<el-icon><Top /></el-icon>
						</span>
					</div>
					<div class="input-field standard-input">
						<el-input
							v-model="position.tablet.values.right"
							size="large"
							pattern="^(auto|[0-9])$"
							minlength="0"
							maxlength="4"
							clearable
						/>
						<span class="label">
							<el-icon><Right /></el-icon>
						</span>
					</div>
					<div class="input-field standard-input">
						<el-input
							v-model="position.tablet.values.bottom"
							size="large"
							pattern="^(auto|[0-9])$"
							minlength="0"
							maxlength="4"
							clearable
						/>
						<span class="label">
							<el-icon><Bottom /></el-icon>
						</span>
					</div>
					<div class="input-field standard-input">
						<el-input
							v-model="position.tablet.values.left"
							size="large"
							pattern="^(auto|[0-9])$"
							minlength="0"
							maxlength="4"
							clearable
						/>
						<span class="label">
							<el-icon><Back /></el-icon>
						</span>
					</div>
					<div class="input-field select-input select-unit">
						<el-select v-model="position.tablet.unit" size="large">
							<el-option
								v-for="(label, key) in units"
								:label="label"
								:value="key"
							/>
						</el-select>
						<span class="label"> Unit </span>
					</div>
				</div>
			</div>
			<div
				v-show="device === 'M'"
				class="res-position-control con-mobile"
			>
				<div class="input-fields">
					<div class="input-field select-input select-visiblity">
						<el-select
							v-model="position.mobile.visibility"
							size="large"
						>
							<el-option
								v-for="(label, key) in visibilityOptions"
								:label="label"
								:value="key"
							/>
						</el-select>
						<span class="label">
							<el-icon><View /></el-icon>
							Visibility
						</span>
					</div>
					<div class="input-field standard-input">
						<el-input
							v-model="position.mobile.values.top"
							size="large"
							pattern="^(auto|[0-9])$"
							minlength="0"
							maxlength="4"
							clearable
						/>
						<span class="label">
							<el-icon><Top /></el-icon>
						</span>
					</div>
					<div class="input-field standard-input">
						<el-input
							v-model="position.mobile.values.right"
							size="large"
							pattern="^(auto|[0-9])$"
							minlength="0"
							maxlength="4"
							clearable
						/>
						<span class="label">
							<el-icon><Right /></el-icon>
						</span>
					</div>
					<div class="input-field standard-input">
						<el-input
							v-model="position.mobile.values.bottom"
							size="large"
							pattern="^(auto|[0-9])$"
							minlength="0"
							maxlength="4"
							clearable
						/>
						<span class="label">
							<el-icon><Bottom /></el-icon>
						</span>
					</div>
					<div class="input-field standard-input">
						<el-input
							v-model="position.mobile.values.left"
							size="large"
							pattern="^(auto|[0-9])$"
							minlength="0"
							maxlength="4"
							clearable
						/>
						<span class="label">
							<el-icon><Back /></el-icon>
						</span>
					</div>
					<div class="input-field select-input select-unit">
						<el-select v-model="position.mobile.unit" size="large">
							<el-option
								v-for="(label, key) in units"
								:label="label"
								:value="key"
							/>
						</el-select>
						<span class="label"> Unit </span>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
