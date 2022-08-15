<script setup>
import { ref } from "vue";
import { ElCollapse, ElCollapseItem } from "element-plus";
import InputControl from "../InputControl.vue";
const props = defineProps({
	section: Object,
	sectionKey: String,
	reactiveState: Object,
});
</script>
<template>
	<el-collapse>
		<el-collapse-item :title="props.section.title">
			<div
				class="adfy-options"
				v-for="(field, key) in props.section.fields"
			>
				<div class="adfy-option-columns option-box">
					<div class="adfy-col left">
						<div class="label">
							<p v-if="field.label" class="option-label">
								{{ field.label }}
							</p>
							<p
								v-if="field.description"
								class="option-description"
							>
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
		</el-collapse-item>
	</el-collapse>
</template>
