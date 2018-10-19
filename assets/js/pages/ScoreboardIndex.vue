<script>
    import axios from 'axios';
    import moment from 'moment';
    import api from '@app/api';

    export default {
        data() {
            return {
                scores: [],
            };
        },

        methods: {
            getTopScores() {
                axios.get(api.getTopScores)
                    .then(response => {
                        console.log(response);
                        this.scores = response.data.scores;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },

            formatDate(date) {
                return moment(date).format('MMM Do, YYYY');
            },
        },

        created() {
            this.getTopScores();
        },
    }
</script>

<style lang="scss" scoped>
    @import 'variables';

    .scoreboard {
        width: 100%;
        max-width: 1100px;
        padding: 0 50px;
        margin: 50px auto;

        &__row {
            margin-bottom: 50px;
        }

        &__heading {
            font-size: $font-size-normal;
            margin-bottom: 15px;
        }

        &__table {
            width: 100%;
            border-collapse: collapse;
            font-size: 18px;
        }

        &__table-row {
            background-color: $green-dark;

            &:nth-child(even) {
                background-color: $green-darker;
            }

            &--heading {
                background-color: transparent;
            }
        }

        &__table-cell {
            padding: 8px;
            text-align: right;

            &:first-child {
                text-align: left;
                width: 30%;
            }

            &--heading {
                font-weight: 500;
            }
        }

        &__message-points {
            font-weight: 700;
            color: $yellow-light;
        }
    }
</style>

<template>
    <div class="scoreboard">

        <c-header />

        <h2 class="scoreboard__heading">Scoreboard</h2>

        <table class="scoreboard__table">

            <thead>
                <tr class="scoreboard__table-row scoreboard__table-row--heading">
                    <th class="scoreboard__table-cell scoreboard__table-cell--heading">Name</th>
                    <th class="scoreboard__table-cell scoreboard__table-cell--heading">Score</th>
                    <th class="scoreboard__table-cell scoreboard__table-cell--heading">Draws</th>
                    <th class="scoreboard__table-cell scoreboard__table-cell--heading">Average draw time</th>
                    <th class="scoreboard__table-cell scoreboard__table-cell--heading">Total time</th>
                    <th class="scoreboard__table-cell scoreboard__table-cell--heading">Played</th>
                </tr>
            </thead>

            <tbody v-if="scores.length > 0">
                <tr class="scoreboard__table-row" v-for="score in scores" :key="score.id">
                    <td class="scoreboard__table-cell">
                        {{ score.name }}
                    </td>
                    <td class="scoreboard__table-cell">
                        <span class="scoreboard__message-points">{{ score.score }}</span>
                    </td>
                    <td class="scoreboard__table-cell">
                        {{ score.draws }}
                    </td>
                    <td class="scoreboard__table-cell">
                        {{ score.averageDrawTime }} seconds
                    </td>
                    <td class="scoreboard__table-cell">
                        {{ score.totalTime }}
                    </td>
                    <td class="scoreboard__table-cell">
                        {{ formatDate(score.playedDate) }}
                    </td>
                </tr>
            </tbody>

            <tbody v-if="scores.length == 0">
                <tr class="scoreboard__table-row">
                    <td class="scoreboard__table-cell" colspan="6">
                        Nothing here yet!
                    </td>
                </tr>
            </tbody>

        </table>

    </div>
</template>
