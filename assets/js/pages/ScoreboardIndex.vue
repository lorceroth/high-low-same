<script>
    export default {}
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
                width: 40%;
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

    .header {
        text-align: center;

        &__logo {
            height: 200px;
        }
    }
</style>

<template>
    <div class="scoreboard">

        <header class="header board__row">
            <img class="header__logo" src="/images/logo.svg" alt="Logotype" />
        </header>

        <h2 class="scoreboard__heading">Scoreboard</h2>

        <table class="scoreboard__table">
            <thead>
                <tr class="scoreboard__table-row scoreboard__table-row--heading">
                    <th class="scoreboard__table-cell scoreboard__table-cell--heading">Name</th>
                    <th class="scoreboard__table-cell scoreboard__table-cell--heading">Score</th>
                    <th class="scoreboard__table-cell scoreboard__table-cell--heading">Average draw time</th>
                    <th class="scoreboard__table-cell scoreboard__table-cell--heading">Total time</th>
                    <th class="scoreboard__table-cell scoreboard__table-cell--heading">Played</th>
                </tr>
            </thead>
            <tbody>
                <tr class="scoreboard__table-row">
                    <td class="scoreboard__table-cell">
                        Name
                    </td>
                    <td class="scoreboard__table-cell">
                        <span class="scoreboard__message-points">75</span>
                    </td>
                    <td class="scoreboard__table-cell">
                        2.25 seconds
                    </td>
                    <td class="scoreboard__table-cell">
                        01:25
                    </td>
                    <td class="scoreboard__table-cell">
                        Oct 19th, 2018
                    </td>
                </tr>
                <tr class="scoreboard__table-row">
                    <td class="scoreboard__table-cell">
                        Name Namesson
                    </td>
                    <td class="scoreboard__table-cell">
                        <span class="scoreboard__message-points">75</span>
                    </td>
                    <td class="scoreboard__table-cell">
                        2.25 seconds
                    </td>
                    <td class="scoreboard__table-cell">
                        01:25
                    </td>
                    <td class="scoreboard__table-cell">
                        Oct 19th, 2018
                    </td>
                </tr>
                <tr class="scoreboard__table-row">
                    <td class="scoreboard__table-cell">
                        Name Johnsson
                    </td>
                    <td class="scoreboard__table-cell">
                        <span class="scoreboard__message-points">75</span>
                    </td>
                    <td class="scoreboard__table-cell">
                        2.25 seconds
                    </td>
                    <td class="scoreboard__table-cell">
                        01:25
                    </td>
                    <td class="scoreboard__table-cell">
                        Oct 19th, 2018
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>
