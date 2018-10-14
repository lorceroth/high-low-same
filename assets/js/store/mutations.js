import { calculatePoints } from '../score';

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

        state.timeSinceLastDrawIntervalId = setInterval(() => {
            state.timeSinceLastDraw += 1;
        }, 1000);
    },

    /**
     * Stops the game.
     *
     * @param {object} state
     */
    stop(state) {
        state.running = false;

        clearInterval(state.totalTimeIntervalId);
        clearInterval(state.timeSinceLastDrawIntervalId);
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
        state.totalTimeIntervalId = 0;
        state.timeSinceLastDraw = 0;
        state.timeSinceLastDrawIntervalId = 0;
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
        let points = calculatePoints(state.timeSinceLastDraw);

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
     * Resets the seconds from the last draw.
     *
     * @param {object} state
     */
    resetTimeSinceLastDraw(state) {
        state.timeSinceLastDraw = 0;
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
        clearInterval(state.timeSinceLastDrawIntervalId);
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
        clearInterval(state.timeSinceLastDrawIntervalId);
    },
};
