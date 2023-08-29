<script setup>
/**
 * Define props.
 *
 * @since 1.0.0
 */
const props = defineProps({
	divId: String,
	className: String,
});
</script>
<template>
	<form
		:id="props.divId"
		class="adfy-form"
		:class="props.className"
		@submit.prevent
	>
		<slot></slot>
	</form>
</template>
