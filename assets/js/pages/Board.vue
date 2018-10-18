<script>
    import axios from 'axios';
    import moment from 'moment';
    import api from '@app/api';

    export default {
        data() {
            return {
                loading: false,
            };
        },

        computed: {
            running() {
                return this.$store.state.running;
            },

            score() {
                return this.$store.state.score;
            },

            draws() {
                return this.$store.state.draws;
            },

            formattedTime() {
                return this.$store.getters.formattedTime;
            },

            lastNumberOfPoints() {
                return this.$store.state.lastNumberOfPoints;
            },

            win() {
                return this.$store.state.win;
            },

            gameOver() {
                return this.$store.state.gameOver;
            },
        },

        methods: {
            onStartClick() {
                this.loading = true;

                setTimeout(() => {
                    this.loading = false;
                    this.$store.commit('reset');
                    this.$store.commit('start');
                    this.$store.commit('incrementDraws');
                }, 500);
            },

            onChoiceClick(choice) {
                this.loading = true;

                setTimeout(() => {
                    this.loading = false;

                    switch (choice) {
                        case 0:
                            this.$store.commit('incrementScore');
                            this.$store.commit('incrementDraws');
                            this.$store.commit('resetTimeSinceLastDraw');
                            break;
                        default:
                            this.$store.commit('triggerGameOver');
                    }
                }, 500);
            },

            onSaveClick() {
                console.log('Save to scoreboard');
            },

            onPlayAgainClick() {
                this.loading = true;

                setTimeout(() => {
                    this.loading = false;
                    this.$store.commit('reset');
                    this.$store.commit('start');
                    this.$store.commit('incrementDraws');
                }, 500);
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import 'variables';

    .board {
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

        &__decks {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        &__message {
            flex: 1;
            padding: 0 25px;
            text-align: center;
        }

        &__message-title {
            font-size: 56px;
            text-shadow: 0 6px 0 $green-dark;

            &--success {
                color: $yellow-light;
            }

            &--failure {
                color: $orange;
            }
        }

        &__message-points {
            font-weight: 700;
            color: $yellow-light;
        }

        &__stats {
            display: flex;
            // align-items: center;
            justify-content: space-between;
        }

        &__stats-item {
            width: 230px;
            font-size: 18px;
            background-color: $green-darker;
            border-radius: 8px;
            padding: 8px 16px;

            &:not(:last-child) {
                margin-bottom: 8px;
            }
        }
    }

    .header {
        text-align: center;

        &__logo {
            height: 200px;
        }
    }
</style>

<template>
    <div class="board">

        <header class="header board__row">
            <img class="header__logo" src="/images/logo.svg" alt="Logotype" />
        </header>

        <div class="board__decks board__row">
            <c-card image="/images/deck.png"></c-card>

            <div class="board__message">
                <c-loader :loading="loading" />

                <div v-if="!loading && draws === 0">
                    <h2 class="board__message-title">Welcome!</h2>
                    <p style="margin-bottom: 15px">
                        Let's see how far you can get. Draw the first card when you're feeling ready.
                    </p>
                    <c-button :action="onStartClick">Start</c-button>
                </div>

                <div v-if="!loading && running && draws === 1">
                    <h2 class="board__message-title board__message-title--success">Nice job!</h2>
                    <p style="margin-bottom: 15px">
                        You got a "CARD_HERE"! Now you have to guess if the next card is going
                        to be lower, same or higher than this one.
                    </p>
                </div>

                <div v-if="!loading && running && draws > 1">
                    <h2 class="board__message-title board__message-title--success">Excellent!</h2>
                    <p style="margin-bottom: 15px">
                        You made the right guess and earn <strong class="board__message-points">{{ lastNumberOfPoints }}</strong> points. Keep it up!
                    </p>
                </div>

                <div v-if="!loading && gameOver">
                    <h2 class="board__message-title board__message-title--failure">Game Over!</h2>
                    <p style="margin-bottom: 15px">
                        You made the wrong choice, but you reached <strong class="board__message-points">{{ score }}</strong> points. Good job!
                    </p>
                    <c-button-group direction="column" :gutter="15">
                        <c-button :action="onSaveClick">Save to scoreboard</c-button>
                        <c-button :action="onPlayAgainClick">Play again</c-button>
                    </c-button-group>
                </div>
            </div>

            <c-card></c-card>
        </div>

        <div class="board__actions board__row">
            <h2 class="board__heading">What's next?</h2>
            <c-button-group :gutter="15">
                <c-button :action="onChoiceClick.bind(this, 0)" :disabled="loading || !running">Lower</c-button>
                <c-button :action="onChoiceClick.bind(this, 1)" :disabled="loading || !running">Same</c-button>
                <c-button :action="onChoiceClick.bind(this, 2)" :disabled="loading || !running">Higher</c-button>
            </c-button-group>
        </div>

        <div class="board__row">
            <h2 class="board__heading">Gameplay & Score</h2>
            <div class="board__stats">

                <ul class="list">
                    <li class="list__item board__stats-item">
                        <strong>Remaining:</strong>
                        <span>52</span>
                    </li>
                    <li class="list__item board__stats-item">
                        <strong>Last choice:</strong>
                        <span>Higher</span>
                    </li>
                </ul>

                <ul class="list" style="text-align: right">
                    <li class="list__item board__stats-item">
                        <strong>Score:</strong>
                        <span>{{ score }}</span>
                    </li>
                    <li class="list__item board__stats-item">
                        <strong>Draws:</strong>
                        <span>{{ draws }}</span>
                    </li>
                    <li class="list__item board__stats-item">
                        <strong>Time:</strong>
                        <span>{{ formattedTime }}</span>
                    </li>
                </ul>

            </div>
        </div>

    </div>
</template>
