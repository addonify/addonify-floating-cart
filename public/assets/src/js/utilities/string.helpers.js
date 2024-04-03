/**
 * Removes all spaces from a string.
 * Add a dot to the beginning of the string if it doesn't start with a dot.
 *
 * @param {string} selector
 * @returns {string} string
 * @since 1.2.7
 */
export const convertClassNamesToSelector = (selectors) => {
	const arr = selectors.split(", ");

	const classArr = arr.map((item) => {
		const list = item.replace(" ", "").trim();
		return list.startsWith(".") ? list : `.${list}`;
	});

	// Convert array to string.
	return classArr.join(", ");
}
