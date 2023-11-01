<script setup>
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
