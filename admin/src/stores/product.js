import { defineStore } from 'pinia'
import { ElMessage } from 'element-plus'

/**
* Destructuring wp.
*
* @import apiFetch.
* @import __.
*/
const { apiFetch } = wp;
const { __ } = wp.i18n;

/**
* @var {string} recommendedList.
*/
const recommendedList = "https://raw.githubusercontent.com/addonify/recommended-products/main/products.json";

export const useProductStore = defineStore({

    id: 'Product',

    state: () => ({
        allAddons: {}, // Storing all addons slugs.
        allProductSlugStatus: {}, // Storing all addons slug & status.
        hotAddons: {},
        generalAddons: {},
        installedAddons: [],

        isFetching: true, // Fetching recommended plugins list from github.
        isFetchingAllInstalledAddons: true, // Fetched all installed plugins.
        isSettingAddonStatus: true, // Checking plugin status on backend.

    }),

    getters: {
        /**
        * Return the state of addons in memory.
        *
        * @param {object} state.
        * @return {boolean} true/false.
        * @since 1.2.9
        */
        hasAddonsStateInMemory: (state) => {

            if (typeof state.allAddons === 'object') {

                return Object.keys(state.allAddons).length > 0 ? true : false;
            }

            if (typeof state.allAddons === 'array') {

                return state.allAddons.length > 0 ? true : false;
            }

            return false;
        },
    },

    actions: {
        /**
         * Fetch github repo data to get the list of recommended plugins.
         *
         * @param {null} null.
         * @return {object} response.
         * @since 1.2.9
         */
        async getRecommdedProductsList() {
            try {
                this.isFetching = true;

                const res = await fetch(recommendedList);
                const data = await res.json();

                if (res.status !== 200) {
                    console.log(data);
                    return;
                }

                this.processRecommendedPluginsList(data);
                this.isFetching = false;
                return res;

            } catch (err) {
                console.error(err);
                this.isFetching = false;
                return err;
            }
        },

        /**
        * Process the recommended plugins list once it's retrived from github.
        * Create three arrays [hot, general & all]
        *
        * @param {object} list.
        * @return {void} void.
        * @since 1.2.9
        */
        processRecommendedPluginsList(list) {

            console.log("[Info] Processing the list that was retrived....");

            this.hotAddons = list.data.hot;
            this.generalAddons = list.data.general;
            this.allAddons = { ...this.hotAddons, ...this.generalAddons };

            if (typeof this.allAddons === 'object') {

                Object.keys(this.allAddons).forEach((key) => {

                    // Let's add the slug to object with status null for now.
                    // i.e: { 'addonify-floating-cart': 'status' }
                    this.allProductSlugStatus[key] = 'null';
                });

            } else {

                return console.log("[Error] Couldn't process the list plugins list!");
            }
        },

        /**
         * Check plugin status.
         * Checks if the plugin is installed or not.
         *
         * @param {null} null.
         * @return {void} void.
         * @since 1.2.9    
         */
        async fetchInstalledAddons() {

            console.log("[Info] Getting the list of all plugins installed on the site....");

            try {
                const res = await apiFetch({
                    path: `/wp/v2/plugins`,
                    method: "GET",
                    cache: "no-cache",
                });

                console.log("[Info] Received the list of all installed plugins....");

                this.installedAddons = res;
                this.setAddonStatusFlag(Object.keys(this.allProductSlugStatus)); // Just send the slug array.
                this.isFetchingAllInstalledAddons = false;

            } catch (err) {
                console.log(err);
                this.isFetchingAllInstalledAddons = false;
                return;
            }
        },

        /**
        * Get plugin installed/active status via slug.
        * Returns 'active' or 'inactive' or 'not-installed'.
        * 
        * @param {object} slugs.
        * @return {void} void.
        * @since 1.2.9
        */
        setAddonStatusFlag(slugs) {

            if (typeof this.installedAddons === 'object' && this.installedAddons.length > 0) {

                console.log("=> Setting the status of the addon.");

                slugs.forEach((slug) => {

                    const tryFind = this.installedAddons.find((plugin) => plugin.textdomain === slug);

                    if (tryFind) {

                        this.allProductSlugStatus[slug] = tryFind.status;

                    } else {

                        this.allProductSlugStatus[slug] = 'not-installed';
                    }
                });

            } else {

                console.log("[Warning] Bailing!!! The installed addons list is empty.");
            }

            console.log("[Info] Done setting the status of the addon.");
            this.isSettingAddonStatus = false;
        },

        /**
        * Handle plugin installation.
        *
        * @param {string} slug.
        * @return {object} response/error.
        * @since 1.2.9
        */
        async handleAddonInstallation(slug) {
            try {
                console.log(`[Info] Trying to install plugin ${slug}...`);

                const res = await apiFetch({
                    method: "POST",
                    path: "/wp/v2/plugins",
                    data: {
                        slug: slug,
                        status: "active",
                    },
                    cache: "no-cache"
                });

                if (res.status === 'active') {

                    console.log(`[Info] Plugin ${slug} installed successfully.`);

                    ElMessage.success(({
                        message: __('Plugin installed successfully.', 'addonify-floating-cart'),
                        offset: 50,
                        duration: 5000,
                    }));

                    // Update the status of the plugin.
                    this.allProductSlugStatus[slug] = 'active';

                    // Return the response.
                    return await res;
                }

            } catch (err) {
                console.error(err);
                ElMessage.error(({
                    message: __('Error: couldn\'t install plugin.', 'addonify-floating-cart'),
                    offset: 50,
                    duration: 20000,
                }));

                this.isWaitingForInstallation = false;
                return await err;
            }
        },

        /**
         * Update plugin status. (active/inactive)
         *
         * @param {string} slug.
         * @return {object} response/error.
         * @since 1.2.9
         */
        async updateAddonStatus(slug) {
            try {
                console.log(`[Info] Trying to set the status of plugin ${slug}...`);

                const res = await apiFetch({
                    method: "POST",
                    path: `/wp/v2/plugins/${slug}`,
                    data: {
                        status: "active",
                        plugin: `${slug}/${slug}`,
                    },
                    cache: "no-cache"
                });

                if (res.status == 'active') {
                    console.log(`[Info] Plugin ${slug} activated successfully.`);

                    ElMessage.success(({
                        message: __('Plugin activated successfully.', 'addonify-floating-cart'),
                        offset: 50,
                        duration: 5000,
                    }));

                    // Update the status of the plugin.
                    this.allProductSlugStatus[slug] = 'active';
                    return await res;
                }

            } catch (err) {
                console.log(err);
                ElMessage.error(({
                    message: __('Error: Couldn\'t activate the plugin.', 'addonify-floating-cart'),
                    offset: 50,
                    duration: 20000,
                }));

                return await err;
            }
        }
    }
});