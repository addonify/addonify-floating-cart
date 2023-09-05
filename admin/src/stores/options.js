import { defineStore } from 'pinia'
import { ElMessage } from 'element-plus'

/**
* @var {string} BASE_API_URL.
*/
const BASE_API_URL = ADDONIFY_WOOFC_LOCOLIZER.rest_namespace;

/**
* @var {object} oldOptions. 
*/
let oldOptions = {};

/**
* Destructuring wp.
*
* @import apiFetch.
* @import __.
*/
const { apiFetch } = wp;
const { __ } = wp.i18n;

/**
* Destructuring lodash.
*
* @import isEqual.
* @import cloneDeep.
*/
const { isEqual, cloneDeep } = lodash;

export const useOptionsStore = defineStore({

    id: 'Options',

    state: () => ({
        data: {},   // Holds all datas like options, section, tab & fields.
        options: {}, // Holds the old options to compare with the new ones.
        message: "", // Holds the message to be displayed to the user.
        isLoading: true,
        isSaving: false,
        needSave: false,
        errors: "",
    }),
    getters: {
        /**
         * Check if we need to save the options.
         *
         * @param {object} state.
         * @return {boolean} true/false.
         * @since 1.0.0
         */
        needSaving: (state) => {

            return !isEqual(state.options, oldOptions) ? true : false;
        },

        /**
         * Check if the options are available in the memory.
         *
         * @param {object} state.
         * @return {boolean} true/false.
         * @since 1.0.0
         */
        haveStateInMemory: (state) => {

            if (typeof state.options === 'array') {

                return state.options.length === 0 ? false : true;
            }

            if (typeof state.options === 'object') {

                return Object.keys(state.options).length === 0 ? false : true;
            }
        },
    },
    actions: {
        /**
         * Render the options from the api.
         *
         * @param {null} null.
         * @return {void} void.
         * @since 1.0.0
         */
        async renderOptions() {
            try {
                this.isLoading = true;

                const { settings_values, tabs } = await apiFetch({
                    path: BASE_API_URL + '/get_options',
                    method: 'GET',
                    cache: 'no-cache',
                });

                const settingsValues = settings_values;
                this.data = tabs;
                this.options = settingsValues;
                oldOptions = cloneDeep(settingsValues);
                this.isLoading = false;

            } catch (err) {

                console.log(err);
                this.isLoading = false;
                return ElMessage.error(({
                    message: __("Something went wrong while fetching settings.", "addonify-floating-cart"),
                    offset: 50,
                    duration: 10000,
                }));
            }
        },

        /**
         * Identify the option that were changed.
         * Prepare the payload for api call.
         *
         * @param {null} null. 
         * @return {void} void.
         * @since 1.0.0
         */
        handleUpdateOptions() {

            const payload = new Object();

            Object.keys(this.options).map(key => {

                if (!isEqual(this.options[key], oldOptions[key])) {

                    payload[key] = this.options[key];
                }
            });

            // Pass the payload to update the options.
            this.updateOptions(payload);
        },

        /**
         * Push the option changes to api.
         *
         * @param {null} null.
         * @return {void} void.
         * @since 1.0.0
         */
        async updateOptions(payload) {
            try {
                this.isSaving = true;
                const res = await apiFetch({
                    path: BASE_API_URL + '/update_options',
                    method: 'POST',
                    data: {
                        settings_values: payload
                    },
                    cache: 'no-cache',
                });

                if (!res.success) {
                    return ElMessage.error(({
                        message: __("Error saving changes! Please try again.", "addonify-floating-cart"),
                        offset: 50,
                        duration: 15000,
                    }));
                }

                let tempOptionsState = cloneDeep(this.options);
                this.options = {};
                this.options = cloneDeep(tempOptionsState);
                oldOptions = cloneDeep(this.options);
                this.isSaving = false;

                return ElMessage.success(({
                    message: res.message,
                    offset: 50,
                    duration: 3000,
                }));

            } catch (err) {

                console.log(err);
                this.isSaving = false;

                return ElMessage.error(({
                    message: __("Error saving changes! Please try again.", "addonify-floating-cart"),
                    offset: 50,
                    duration: 15000,
                }));
            }
        },
    },
});
