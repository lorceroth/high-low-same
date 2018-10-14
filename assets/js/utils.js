/**
 * Adds an additional zero to numbers below 10.
 *
 * @param {number} number
 */
export const zeropad = (number) => {
    return number < 10 ? '0' + number : number;
};

/**
 * Formats seconds to a formatted time string that
 * displays minutes and seconds.
 *
 * @param {numer} time
 */
export const toTimeString = (time) => {
    let minutes = Math.floor(time / 60);
    let seconds = time - minutes * 60;

    return zeropad(minutes) + ':' + zeropad(seconds);
};
