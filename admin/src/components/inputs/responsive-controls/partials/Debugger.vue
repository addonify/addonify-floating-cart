<script setup>
import { onMounted, watch } from "vue";

/**
 *
 * Define props.
 *
 * @since 1.0.0
 */
const props = defineProps({
	mode: {
		type: String,
		required: false,
		default: "console",
	},
	activeDevice: {
		type: String,
		required: false,
	},
	store: {
		type: Object,
		required: false,
	},
});

onMounted(() => {
	/**
	 * For debugging purposes.
	 *
	 * @since 1.1.9
	 */

	let count = 1;

	if (props.mode === "console") {
		watch(
			props.store,
			(newV, oldVal) => {
				console.log(
					count++ +
						") =============================================== ↓"
				);

				console.log("🛎️ The active device is: " + props.activeDevice);
				console.log(newV[props.activeDevice]);

				console.log(
					"↑ =============================================== ⛔"
				);
				console.log("\n");
			},
			{ deep: true }
		);
	}
});
</script>

<template>
	<template v-if="props.mode === 'verbose'">
		<div class="debug-responsive-control">
			<p>
				The active device is:
				<span class="active-device">{{ props.activeDevice }}</span>
			</p>
			<pre>{{ props.store }}</pre>
		</div>
	</template>
</template>
<style lang="scss" scoped>
.debug-responsive-control {
	display: block;
	margin: 30px 0;
	.active-device {
		font-weight: bold;
	}
}
</style>
