<script setup>
import { ref } from "vue";
import Toolbar from "./responsive-controls/partials/Toolbar";
import Content from "./responsive-controls/partials/Content";

/**
 *
 * Define props.
 *
 * @since 1.0.0
 */
const props = defineProps({
	choices: {
		type: [Array, Object],
		required: false,
		default: {
			desktop: {
				id: "desktop",
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
	className: {
		type: String,
		required: false,
	},
});

/**
 *
 * Ref: Store active device.
 *
 * @since 1.1.9
 */
const activeDevice = ref("desktop");
</script>
<template>
	<div class="responsive-control" :class="props.className">
		<Toolbar v-model="activeDevice" :choices="props.choices" />
		<Content :choices="props.choices" :activeDevice="activeDevice" />
	</div>
</template>
