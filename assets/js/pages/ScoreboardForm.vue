<script>
    import axios from 'axios';
    import moment from 'moment';
    import api from '@app/api';
    import { GameSession } from '@app/gameSession';

    export default {
        data() {
            return {
                session: new GameSession(),
                name: '',
            }
        },

        computed: {
            score() {
                return this.$store.state.score;
            },

            draws() {
                return this.$store.state.draws;
            },

            drawTimes() {
                return this.$store.state.drawTimes;
            },

            formattedTime() {
                return this.$store.getters.formattedTime;
            },
        },

        methods: {
            save() {
                let score = {
                    name: this.name,
                    score: this.score,
                    draws: this.draws,
                    averageDrawTime: this.getAverageDrawTime(),
                    totalTime: this.formattedTime,
                };

                this.session.saveLastGame();

                axios.post(api.saveScore, score)
                    .then(response => {
                        console.log(response);

                        this.$router.push({
                            path: '/scoreboard',
                        });
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },

            getAverageDrawTime() {
                let drawTimesSum = 0;
                let drawTimesCount = this.drawTimes.length;

                this.drawTimes.map(drawTime => {
                    drawTimesSum += drawTime;
                });

                return (drawTimesSum / drawTimesCount).toFixed(3);
            }
        },
    }
</script>

<style lang="scss" scoped>
    @import 'variables';

    .scoreboard-form {
        width: 100%;
        max-width: 600px;
        padding: 0 50px;
        margin: 50px auto;
        text-align: center;

        &__heading {
            font-size: $font-size-normal;
            margin-bottom: 15px;
        }

        &__input {
            display: block;
            width: 100%;
            font: inherit;
            color: #fff;
            background-color: $green-darker;
            outline: none;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            margin-bottom: 15px;
            text-align: center;

            &::placeholder {
                color: #ffffff88;
            }

            &:focus {
                background-color: $green-dark;
            }
        }
    }
</style>

<template>
    <div class="scoreboard-form">

        <c-header />

        <div v-if="session.canSaveGame()">
            <h2 class="scoreboard-form__heading">Save to scoreboard</h2>

            <input class="scoreboard-form__input" type="text" placeholder="What's your name?" v-model="name" />
            <c-button :action="save" width="100%">Save</c-button>
        </div>

        <div v-if="!session.canSaveGame()">
            <h2 class="scoreboard-form__heading">Your game is already saved!</h2>

            <p style="margin-bottom: 30px">
                It looks like you've already saved your last game. Want to see if you can beat your last score?
            </p>

            <c-button-group direction="column" :gutter="15">
                <c-button to="/board">Play again!</c-button>
                <c-button to="/scoreboard">Scoreboard</c-button>
            </c-button-group>
        </div>

    </div>
</template>
