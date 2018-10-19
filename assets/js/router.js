import Vue from 'vue';
import VueRouter from 'vue-router';
import Welcome from './pages/Welcome.vue';
import Board from './pages/Board.vue';
import ScoreboardIndex from './pages/ScoreboardIndex.vue';
import ScoreboardForm from './pages/ScoreboardForm.vue';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'hash',
    routes: [
        {
            path: '/',
            component: Welcome,
        },
        {
            path: '/board',
            component: Board,
        },
        {
            path: '/scoreboard',
            component: ScoreboardIndex,
        },
        {
            path: '/scoreboard/save',
            component: ScoreboardForm,
        },
    ],
});
