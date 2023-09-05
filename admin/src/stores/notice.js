import { defineStore } from 'pinia';

/**
 * @var {string} noticeURL.
 */
const noticeURL = "https://raw.githubusercontent.com/addonify/addonify-floating-cart/stable/notice.json";

export const useNoticeStore = defineStore({

    id: 'Notice',

    state: () => ({
        alerts: {},
        status: {
            isFetching: true,
        }
    }),

    getters: {
        /**
        * Return if we have alerts in memo.
        *
        * @param {Object} state
        * @return {Boolean} true/false
        * @since 1.2.9
        */
        hasNoticeStateInMemory: (state) => {

            if (typeof state.alerts === 'object') {

                return Object.keys(state.alerts).length > 0 ? true : false;
            }

            if (typeof state.alerts === 'array') {

                return state.alerts.length > 0 ? true : false;
            }

            return false;
        },
    },

    actions: {
        /**
        * Check for notices. 
        *
        * @param {null} null.
        * @return {void} void.
        * @since 1.2.9
        */
        async checkNotices() {
            try {
                const res = await fetch(noticeURL);

                const data = await res.json();

                if (res.status === 200) {

                    this.alerts = data;
                    this.status.isFetching = false;
                }
            } catch (err) {
                return;
            }
        },
    },
});