import { toTimeString } from '../utils';

export default {
    formattedTime: state => {
        return toTimeString(state.totalTime);
    },
};
