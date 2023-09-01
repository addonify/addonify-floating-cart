<script setup>
import { onMounted } from "vue";
import Icon from "../icons/Icons.vue";
import { useNoticeStore } from "../../stores/notice";

const store = useNoticeStore();

/**
 * Hook: onMounted.
 *
 * @since 1.2.9
 */
onMounted(() => {
	/**
	 * Check notices state in the memory before fetching notices.
	 *
	 * @since: 1.2.9
	 */
	if (!store.hasNoticeStateInMemory) {
		store.checkNotices();
	}
});
</script>
<template>
	<template v-if="!store.status.isFetching">
		<template v-for="(notice, key) in store.alerts.alerts">
			<aside
				v-if="notice.live"
				class="addonify-notice"
				:class="notice.type"
				:data_size="notice.size"
			>
				<div class="content">
					<span class="icon">
						<Icon icon="signal-tower" />
					</span>
					<span class="message" v-html="notice.data.content"> </span>
				</div>
			</aside>
		</template>
	</template>
</template>
