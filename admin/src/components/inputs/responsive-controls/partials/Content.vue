<script setup>
import Fields from "./Fields";
/**
 *
 * Define props.
 *
 * @since 1.0.0
 */
const props = defineProps({
	activeDevice: {
		type: String,
		required: true,
	},
	choices: {
		type: [Object, Array],
		required: true,
	},
	className: {
		type: String,
		required: false,
	},
});

/**
 *
 * Render active device class name by adding prefix `con-` to device id.
 *
 * @param {string} device
 * @return {string} device class name. Example: con-desktop, con-tablet, con-mobile
 * @since 1.1.9
 */
const renderActiveDeviceClass = (device) => `con-${device}`;
</script>
<template>
	<div class="res-content" :class="props.className">
		<template v-for="device in props.choices">
			<div
				v-show="props.activeDevice === device.id"
				class="res-position-control"
				:class="renderActiveDeviceClass(device.id)"
			>
				<Fields :device="device" :activeDevice="props.activeDevice" />
			</div>
		</template>
	</div>
</template>
