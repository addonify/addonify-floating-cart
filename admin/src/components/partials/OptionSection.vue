<script setup>
	const props = defineProps({
		className: String,
	});
</script>
<template>
	<section class="adfy-options-section" :class="props.className">
		<slot></slot>
	</section>
</template>
