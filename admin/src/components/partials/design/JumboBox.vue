<script setup>
import InputControl from "../InputControl.vue";
import Icon from "../../../components/icons/Icons.vue";

/**
 * Define props.
 *
 * @since 1.2.0
 */
const props = defineProps({
	section: {
		type: Object,
		required: true,
	},
	reactiveState: {
		type: Object,
		required: true,
	},
});
</script>
<template>
	<section class="jumbo-section jumbo-box">
		<div class="jumbo-header">
			<p class="sec-title" v-if="props.section.title">
				{{ props.section.title }}
			</p>
			<p class="sec-excerpt" v-if="props.section.description">
				<span class="icon">
					<Icon icon="bulb-solid" />
				</span>
				<span class="text">
					{{ props.section.description }}
				</span>
			</p>
		</div>
		<div class="jumbo-content adfy-options">
			<template v-for="(field, key) in props.section.fields">
				<div class="ui-option">
					<div class="col-left option-label">
						<span class="label">{{ field.label }}</span>
					</div>
					<div class="col-right input">
						<InputControl
							:field="field"
							:fieldKey="key"
							:reactiveState="props.reactiveState"
						/>
					</div>
				</div>
			</template>
		</div>
	</section>
</template>
