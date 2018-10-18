import { Deck } from '@app/models/deck';
import { calculatePoints } from '@app/score';

export default {
    /**
     * Starts the game.
     *
     * @param {object} state
     */
    start(state) {
        state.running = true;

        state.totalTimeIntervalId = setInterval(() => {
            state.totalTime += 1;
        }, 1000);

        state.drawTimeStart = Date.now();
    },

    /**
     * Stops the game.
     *
     * @param {object} state
     */
    stop(state) {
        state.running = false;

        clearInterval(state.totalTimeIntervalId);
    },

    /**
     * Resets the stats from the previous game.
     *
     * @param {object} state
     */
    reset(state) {
        state.score = 0;
        state.draws = 0;

        state.totalTime = 0;
        clearInterval(state.totalTimeIntervalId);
        state.totalTimeIntervalId = 0;

        state.drawTimes = [];
        state.drawTimeStart = Date.now();

        state.lastNumberOfPoints = 0;
        state.win = false;
        state.gameOver = false;
    },

    /**
     * Adds points to the score.
     *
     * @param {object} state
     */
    incrementScore(state) {
        state.drawTimeSeconds = (Date.now() - state.drawTimeStart) / 1000;

        let points = calculatePoints(
            Math.round(state.drawTimeSeconds)
        );

        state.lastNumberOfPoints = points;
        state.score += points;
    },

    /**
     * Adds one to the number of draws from the deck.
     *
     * @param {object} state
     */
    incrementDraws(state) {
        state.draws += 1;
    },

    /**
     * Update the deck.
     *
     * @param {object} state
     * @param {object} deck
     */
    updateDeck(state, deck) {
        state.deck = Deck.createFromObject(deck);
    },

    /**
     * Resets the seconds from the last draw.
     *
     * @param {object} state
     */
    resetTimeSinceLastDraw(state) {
        state.drawTimes.push(state.drawTimeSeconds);

        state.drawTimeStart = Date.now();
    },

    /**
     * Toggle that the user wins the game.
     *
     * @param {object} state
     */
    triggerWin(state) {
        state.running = false;
        state.win = true;

        clearInterval(state.totalTimeIntervalId);
    },

    /**
     * Toggle that the user looses the game.
     *
     * @param {object} state
     */
    triggerGameOver(state) {
        state.running = false;
        state.gameOver = true;

        clearInterval(state.totalTimeIntervalId);
    },
};
