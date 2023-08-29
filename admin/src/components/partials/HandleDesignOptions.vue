<script setup>
import OptionBox from "./OptionBox.vue";
import JumboBox from "./design/JumboBox.vue";
import SectionTitle from "./SectionTitle.vue";

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
	sectionKey: {
		type: String,
		required: true,
	},
	reactiveState: {
		type: Object,
		required: true,
	},
	currentPage: {
		type: String,
		required: true,
	},
});
</script>
<template>
	<template v-if="section.type === 'render-jumbo-box'">
		<JumboBox
			:section="props.section"
			:reactiveState="props.reactiveState"
		/>
	</template>
	<template v-else>
		<OptionBox
			:section="props.section"
			:sectionKey="props.sectionKey"
			:reactiveState="props.reactiveState"
			:currentPage="props.currentPage"
		>
			<SectionTitle :section="props.section" />
		</OptionBox>
	</template>
</template>
