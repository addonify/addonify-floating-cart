<script setup>
/**
 *
 * Define props.
 *
 * @since 1.0.0
 */
const props = defineProps({
	activeDevice: {
		type: String,
		required: false,
	},
	store: {
		type: Object,
		required: false,
	},
});
</script>

<template>
	<div class="debug-responsive-control">
		<p>
			The active device is:
			<span class="active-device">{{ props.activeDevice }}</span>
		</p>
		<pre>{{ props.store }}</pre>
	</div>
</template>
<style lang="scss" scoped>
.debug-responsive-control {
	.active-device {
		font-weight: bold;
	}
}
</style>
