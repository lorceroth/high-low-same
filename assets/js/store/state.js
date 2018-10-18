import { Deck } from '@app/models/deck';

export default {
    /**
     * Indicate that the game is started. The player can still browse the
     * scoreboard, read the instructions and change language without
     * affecting the current game.
     *
     * @type {boolean}
     */
    running: false,

    /**
     * The score of the current game.
     *
     * @type {number}
     */
    score: 0,

    /**
     * The number of cards that the player has drawn from the deck.
     *
     * @type {number}
     */
    draws: 0,

    /**
     * Collections of seconds for each draw used to calculate the
     * average draw time.
     *
     * @type {number}
     */
    drawTimes: [],

    /**
     * The start time of the current draw.
     *
     * @type {Date}
     */
    drawTimeStart: null,

    /**
     * The total draw time in seconds, used by the score system.
     *
     * @type {number}
     */
    drawTimeSeconds: 0,

    /**
     * The current deck.
     *
     * @type {object}
     */
    deck: new Deck(),

    /**
     * The time of the current game in seconds.
     *
     * @type {number}
     */
    totalTime: 0,

    /**
     * ID for the interval that updates the time property.
     *
     * @type {number}
     */
    totalTimeIntervalId: 0,

    /**
     * Last number of points given to the player the last draw.
     *
     * @type {number}
     */
    lastNumberOfPoints: 0,

    /**
     * Gets set to true if the player completes the game.
     *
     * @type {boolean}
     */
    win: false,

    /**
     * Gets set to true if the player makes the wrong guess.
     *
     * @type {boolean}
     */
    gameOver: false,
};
