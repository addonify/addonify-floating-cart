<script setup>
	import { onMounted } from "vue";
	import { useOptionsStore } from "../stores/options";
	import Loading from "../components/layouts/Loading.vue";
	import Navigation from "../components/layouts/Navigation.vue";
	import Form from "../components/partials/Form.vue";
	import SectionTitle from "../components/partials/SectionTitle.vue";
	import HandleDesignOptions from "../components/partials/HandleDesignOptions.vue";
	import OptionSection from "../components/partials/OptionSection.vue";
	const store = useOptionsStore();

	onMounted(() => {
		store.fetchOptions();
	});
</script>

<template>
	<section class="adfy-container">
		<main class="adfy-columns main-content">
			<aside class="adfy-col start site-secondary">
				<Navigation />
			</aside>
			<section class="adfy-col end site-primary">
				<Loading v-if="store.isLoading" />
				<Form v-else divId="adfy-style-options-form">
					<OptionSection
						v-for="(section, sectionKey) in store.data.styles"
					>
						<HandleDesignOptions
							:section="section"
							:sectionKey="sectionKey"
							:reactiveState="store.options"
						>
							<SectionTitle
								:section="section"
								:sectionkey="sectionKey"
							/>
						</HandleDesignOptions>
					</OptionSection>
				</Form>
			</section>
		</main>
	</section>
</template>
