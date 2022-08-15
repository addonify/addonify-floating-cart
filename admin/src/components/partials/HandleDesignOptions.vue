<script setup>
import { useOptionsStore } from "../../stores/options";
import OptionBox from "./OptionBox.vue";
import SectionTitle from "./SectionTitle.vue";
import Accordion from "./design/Accordion.vue";
const props = defineProps({
	section: Object,
	//sectionKey: String,
	reactiveState: Object,
	currentPage: String,
});

const store = useOptionsStore();

const checkSection = (key) => {
	return key.includes("general") || key.includes("custom_css");
};

const enablePluginStyles = () => {
	return store.options.load_styles_from_plugin;
};

//console.log(props.section);
</script>
<template>
	<div
		v-for="(section, sectionKey) in props.section.sections"
		class="adfy-ui-options"
	>
		<OptionBox
			v-if="checkSection(sectionKey)"
			:section="section"
			:sectionKey="sectionKey"
			:reactiveState="props.reactiveState"
			:currentPage="props.currentPage"
		>
		</OptionBox>
		<Accordion
			v-else
			v-show="enablePluginStyles()"
			:section="section"
			:sectionKey="sectionKey"
			:reactiveState="props.reactiveState"
		/>
	</div>
</template>
