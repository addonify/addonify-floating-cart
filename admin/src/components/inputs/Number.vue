<script setup>
import { computed } from "vue";
import { ElInput, ElInputNumber } from "element-plus";
const props = defineProps({
    modelValue: [String, Number], // loose strict checking.
    type: String,
    min: Number,
    max: Number,
    step: Number,
    controlPosition: String,
});

// Ref: https://vuejs.org/guide/components/events.html#usage-with-v-model
const emit = defineEmits(["update:modelValue"]);
const value = computed({
    get() {
        return parseInt(props.modelValue);
    },
    set(newValue) {
        emit("update:modelValue", newValue);
    },
});
</script>
<template>
    <el-input-number
        v-if="props.type == 'toggle'"
        v-model="value"
        size="large"
        :min="props.min"
        :max="props.max"
        :step="props.step"
        :controlsPosition="props.controlPosition"
    />
    <el-input
        v-else
        v-model="value"
        type="number"
        size="large"
        :min="props.min"
        :max="props.max"
    />
</template>
<style lang="scss">
.adfy-options {
    .el-input-number--large {
        width: 140px;
    }
}
</style>
