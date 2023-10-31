/**
* Display/Hide Cart trigger button.
* 
* @param {string} action. [show|hide]
* @return {void} void.
* @since 1.1.10
*/
export function setTriggerButtonVisibility(action) {

    if (!action) {

        throw new Error("Function [setTriggerButtonVisibility] requires action!");
    }

    const buttonEle = document.getElementById("adfy__woofc-trigger");

    if (buttonEle && buttonEle.hasAttribute('data_display')) {

        if (action === "hide") {

            buttonEle.setAttribute('data_display', 'hidden');

        } else {

            buttonEle.setAttribute('data_display', 'visible');
        }
    }
};