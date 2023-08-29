<script setup>
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
});
</script>
<template>
	<div v-if="props.section.title" class="section-title-holder">
		<h3 class="section-title">
			{{ props.section.title }}
		</h3>
	</div>
</template>
