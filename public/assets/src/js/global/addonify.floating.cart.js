/**
* Addonify Floating Cart Object.
*
* @since 1.0.0
*/
export let addonifyFloatingCart = new Object();

addonifyFloatingCart = {

    /**
    * jQuery Object.
    *
    */
    $: jQuery,

    /**
    * Action object.
    * Collection of methods that can be used to perform actions.
    */
    action: { toast: null, cart: null },

    /**
    * API object.
    * Collection of event dispatchers.
    */
    api: { event: null },
}

window.addonifyFloatingCart = addonifyFloatingCart;
