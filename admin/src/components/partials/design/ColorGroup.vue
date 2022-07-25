<script setup>
	import InputControl from "../InputControl.vue";
	const props = defineProps({
		section: Object,
		reactiveState: Object,
	});
</script>
<template>
	<div class="adfy-options">
		<div class="adfy-option-columns option-box fullwidth">
			<div class="adfy-col left">
				<div class="label">
					<p class="option-label" v-if="props.section.title !== ''">
						{{ props.section.title }}
					</p>
					<p
						class="option-description"
						v-if="props.section.description !== ''"
					>
						{{ props.section.description }}
					</p>
				</div>
			</div>
			<div class="adfy-col right">
				<div class="input-group">
					<div
						v-for="(field, key) in props.section.fields"
						class="input"
					>
						<InputControl
							:field="field"
							:fieldKey="key"
							:label="field.label"
							:reactiveState="props.reactiveState"
						/>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- // adfy-options -->
</template>
