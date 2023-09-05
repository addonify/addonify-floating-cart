<script setup>
import { onMounted } from "vue";

import { useOptionsStore } from "../stores/options";
import Form from "../components/partials/Form.vue";
import Loading from "../components/layouts/Loading.vue";
import Navigation from "../components/layouts/Navigation.vue";
import HandleDesignOptions from "../components/partials/HandleDesignOptions.vue";
import OptionSection from "../components/partials/OptionSection.vue";
import Notice from "../components/layouts/Notice.vue";

const store = useOptionsStore();

onMounted(() => {
	/**
	 *
	 * Check if we have state in the memory before fetching options from API.
	 *
	 * @since: 1.2.0
	 */
	if (!store.haveStateInMemory) {
		store.renderOptions();
	}
});
</script>

<template>
	<section class="adfy-container" id="addonify-layout">
		<Notice />
		<main class="adfy-columns main-content">
			<aside class="adfy-col start site-secondary">
				<Navigation />
			</aside>
			<section class="adfy-col end site-primary">
				<template v-if="store.isLoading">
					<Loading />
				</template>
				<template v-else>
					<Form divId="adfy-style-options-form">
						<OptionSection
							v-for="(section, sectionKey) in store.data.styles
								.sections"
							:sectionKey="sectionKey"
							currentPage="design"
						>
							<HandleDesignOptions
								:section="section"
								:sectionKey="sectionKey"
								:reactiveState="store.options"
								currentPage="design"
							/>
						</OptionSection>
					</Form>
				</template>
			</section>
		</main>
	</section>
</template>
