/**
* Display/Hide Cart trigger button.
* 
* @param {string} action. [show|hide]
* @return {void} void.
* @since 1.1.10
*/
export function triggerButtonVisibilityHandler(action) {

    if (!action) {

        throw new Error("Function requires action!");
    }

    const buttonEle = document.getElementById("adfy__woofc-trigger");

    if (buttonEle && buttonEle.hasAttribute('data_display')) {

        switch (action) {

            case "hide":
                buttonEle.setAttribute('data_display', 'hidden');
                break;
            case "show":
                buttonEle.setAttribute('data_display', 'visible');
                break;
            default:
                console.warn("Invalid action provided! Valid actions are: [show|hide]");
                break;
        }
    }
};