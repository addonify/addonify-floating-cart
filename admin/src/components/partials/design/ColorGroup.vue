<script setup>
import { ref } from "vue";
import { ElTag } from "element-plus";
import InputControl from "../InputControl.vue";
import Accordion from "../Accordion.vue";
const props = defineProps({
	section: Object,
	reactiveState: Object,
});
</script>
<template>
	<Accordion :section="props.section">
		<div class="adfy-options" v-for="(field, key) in props.section.fields">
			<div class="adfy-option-columns option-box">
				<div class="adfy-col left">
					<div class="label">
						<p v-if="field.label" class="option-label">
							{{ field.label }}
							<el-tag
								v-if="field.hasOwnProperty('badge')"
								:type="field.badgeType ? field.badgeType : ''"
							>
								{{ field.badge }}
							</el-tag>
						</p>
						<p v-if="field.description" class="option-description">
							{{ field.description }}
						</p>
					</div>
				</div>
				<div class="adfy-col right">
					<div class="input">
						<InputControl
							:field="field"
							:fieldKey="key"
							:reactiveState="props.reactiveState"
						/>
					</div>
				</div>
			</div>
		</div>
		<!-- // adfy-options -->
	</Accordion>
</template>
