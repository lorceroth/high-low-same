/**
 * The number of points the player recieves by default.
 *
 * @type {number}
 */
const points = 10;

/**
 * The number of bonus points the player gets when making a choice
 * within the intervals.
 *
 * @type {object}
 */
const bonusPoints = [
    {
        minSeconds: 0,
        maxSeconds: 3,
        points: 15,
    },
    {
        minSeconds: 3,
        maxSeconds: 6,
        points: 10,
    },
    {
        minSeconds: 6,
        maxSeconds: 10,
        points: 5,
    }
]

/**
 * Calculate the number of points to give the player based on
 * the timing between the draws.
 *
 * @param {number} time
 */
export const calculatePoints = (time) => {
    let bonus = 0;

    for (let i = 0; i < bonusPoints.length; i++) {
        if (time > bonusPoints[i].minSeconds && time <= bonusPoints[i].maxSeconds) {
            bonus += bonusPoints[i].points;
            break;
        }
    }

    console.log('time', time);
    console.log('calculatePoints', points, bonus);

    return points + bonus;
};
