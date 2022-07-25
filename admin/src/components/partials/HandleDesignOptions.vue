<script setup>
	import { useOptionsStore } from "../../stores/options";
	import OptionBox from "./OptionBox.vue";
	import ColorGroup from "./design/ColorGroup.vue";
	import SectionTitle from "./SectionTitle.vue";
	const props = defineProps({
		section: Object,
		sectionKey: String,
		reactiveState: Object,
	});
	const store = useOptionsStore();
</script>
<template>
	<div
		class="adfy-ui-option"
		v-for="(section, sectionKey) in props.section"
		v-show="
			sectionKey == 'general'
				? true
				: store.options.load_styles_from_plugin
		"
	>
		<ColorGroup
			v-if="section.type == 'color-options-group'"
			:section="section"
			:reactiveState="props.reactiveState"
		/>
		<OptionBox
			v-else
			:section="section"
			:reactiveState="props.reactiveState"
			currentPage="design"
		>
			<SectionTitle :section="section" :sectionKey="sectionKey" />
		</OptionBox>
	</div>
</template>
