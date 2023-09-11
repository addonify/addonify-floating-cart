/**
 * Set spinner visibility.
 *
 * @param {string} action - show/hide.
 * @return {void} void.
 * @since 1.2.1
 */
export function setSpinnerVisibility(action) {

    if (!action) {

        throw new Error('Spinner action state is required!');
    }

    const spinnerEle = document.getElementById("adfy__woofc-spinner-container");

    if (spinnerEle) {

        if (action === 'show') {

            spinnerEle.classList.add('visible');
            spinnerEle.classList.remove('hidden');

        } else {

            spinnerEle.classList.add('hidden');
            spinnerEle.classList.remove('visible');
        }
    }
}