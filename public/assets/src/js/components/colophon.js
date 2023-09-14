/**
 * Handle sections of cart footer.
 *
 * @param {boolean} colophonVisibility. - (true/hide)
 * @param {object} blocks. [discountBlock, subTotalBlock]
 * @return {void} void.
 * @since 1.2.2
 */
export function setCartColophonBlocksVisibility(colophonVisibility = "hide", blocks = null) {

    if (typeof colophonVisibility !== "string") {

        throw new Error("Colophon visibility must be a string value.");
    }

    const colophonEle = document.querySelector(".adfy__woofc-colophon");
    const discountEle = document.querySelector(".adfy__woofc-cart-summary ul li.discount");
    const subTotalEle = document.querySelector(".adfy__woofc-cart-summary ul li.sub-total");

    const classToHide = "adfy__woofc-hidden";

    if (colophonEle) {

        colophonVisibility === "show" ? colophonEle.classList.remove(classToHide) : colophonEle.classList.add(classToHide);
    }

    // Proceed to set visibility of blocks.
    if (colophonEle && colophonVisibility === "show") {

        const { discountVisibility, subTotalVisibility } = blocks;

        if (discountEle && discountVisibility) {

            discountVisibility === "show" ? discountEle.classList.remove(classToHide) : discountEle.classList.add(classToHide);
        }

        if (subTotalEle) {

            subTotalVisibility === "show" ? subTotalEle.classList.remove(classToHide) : subTotalEle.classList.add(classToHide);
        }
    }
}