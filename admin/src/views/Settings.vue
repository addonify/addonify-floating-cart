<script setup>
import { onMounted } from "vue";
import Loading from "../components/layouts/Loading.vue";
import Navigation from "../components/layouts/Navigation.vue";
import Form from "../components/partials/Form.vue";
import SectionTitle from "../components/partials/SectionTitle.vue";
import OptionBox from "../components/partials/OptionBox.vue";
import OptionSection from "../components/partials/OptionSection.vue";
import Notice from "../components/layouts/Notice.vue";

import { useOptionsStore } from "../stores/options";

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
					<Form divId="adfy-settings-form">
						<OptionSection
							v-for="(section, sectionKey) in store.data.settings
								.sections"
							:sectionKey="sectionKey"
							currentPage="settings"
						>
							<OptionBox
								:section="section"
								:sectionKey="sectionKey"
								:reactiveState="store.options"
								currentPage="settings"
							>
								<SectionTitle :section="section" />
							</OptionBox>
						</OptionSection>
					</Form>
				</template>
			</section>
		</main>
	</section>
</template>
