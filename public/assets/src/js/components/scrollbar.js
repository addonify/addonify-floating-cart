/**
 * Scrollbar observer.
 *
 * @return {void} void.
 * @since 1.0.0
 */
export const initCustomScrollbar = () => {

    const targetEle = document.getElementById("adfy__floating-cart");

    const config = { attributes: false, childList: true, subtree: true };

    const callback = (mutationList) => {

        if (mutationList.length > 0) {

            // Initialize the scrollbar.
            scrollbar();
        }
    };

    // Create an observer instance linked to the callback function
    const observer = new MutationObserver(callback);

    // Start observing the target node for configured mutations
    observer.observe(targetEle, config);
}

/**
 * Initialize scrollbar.
 *
 * @return {void} void.
 * @since 1.0.0
 */
const scrollbar = () => {

    const scrollableEle = document.getElementById("adfy__woofc-scrollbar");
    const psInitiliazed = scrollableEle.classList.contains("ps");

    if (scrollableEle && !psInitiliazed) {

        new PerfectScrollbar(scrollableEle, {
            wheelSpeed: 1,
            wheelPropagation: true,
            minScrollbarLength: 20
        });
    }
};
