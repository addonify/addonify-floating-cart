import { defineStore } from 'pinia'
import { ElMessage } from 'element-plus'

let oldOptions = {};
const { isEqual, cloneDeep } = lodash;
const { apiFetch } = wp;
const BASE_API_URL = ADDONIFY_WOOFC_LOCOLIZER.rest_namespace;

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

        // ⚡️ Check if we need to save the options.
        checkNeedSave: (state) => {

            return !isEqual(state.options, oldOptions) ? true : false;
        },

        // ⚡️ Check if we have state in memory.
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

        // ⚡️ Action to get options from the server.
        fetchOptions() {

            apiFetch({
                path: BASE_API_URL + '/get_options',
                method: 'GET',
            }).then((res) => {
                //console.log(res);
                const settingsValues = res.settings_values;
                this.data = res.tabs;
                this.options = settingsValues;
                oldOptions = cloneDeep(settingsValues);
                this.isLoading = false;
                //console.log(res.tabs);
            });
        },

        // ⚡️ Handle update options & map the values to the options object.
        handleUpdateOptions() {

            const payload = {};
            const changedOptions = this.options;

            Object.keys(changedOptions).map(key => {

                if (!isEqual(changedOptions[key], oldOptions[key])) {
                    payload[key] = changedOptions[key];
                }
            });

            this.updateOptions(payload);
            //console.log(payload);
        },

        // ⚡️ Action to update options.
        // @param payload: object
        updateOptions(payload) {

            this.isSaving = true; // Set saving to true.

            apiFetch({
                path: BASE_API_URL + '/update_options',
                method: 'POST',
                data: {
                    settings_values: payload
                }
            })
                .then((res) => {

                    this.isSaving = false; // Saving is compconsted here.
                    this.message = res.message; // Set the message to be displayed to the user.
                    //console.log(res);

                    if (res.success === true) {
                        ElMessage.success(({
                            message: this.message,
                            offset: 50,
                            duration: 3000,
                        }));

                    } else {
                        ElMessage.error(({
                            message: this.message,
                            offset: 50,
                            duration: 5000,
                        }));
                    }

                    let tempOptionsState = cloneDeep(this.options);
                    this.options = {};
                    this.options = cloneDeep(tempOptionsState);
                    oldOptions = cloneDeep(this.options);
                })
                .catch((err) => {

                    console.log(err);

                    ElMessage.error(({
                        message: __("Something went wrong while fetching settings.", "addonify-floating-cart"),
                        offset: 50,
                        duration: 10000,
                    }));
                })
        },
    },
});
