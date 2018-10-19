<script>
    export default {}
</script>

<style lang="scss" scoped>
    @import 'variables';
    @import 'mixins';

    .welcome {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100vh;

        &__container {
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        &__logo {
            display: block;
            width: 600px;
            margin: 0 auto 15px;
        }

        &__list-item {
            margin-bottom: 15px;
        }
    }
</style>

<template>
    <div class="welcome">
        <div class="welcome__container">
            <img class="welcome__logo" src="/images/logo.svg" alt="Logotype" />

            <c-button-group direction="column" :gutter="15" :center-buttons="true">
                <c-button to="/board" width="50%">
                    Play
                </c-button>
                <c-button to="/scoreboard" width="50%">
                    Scoreboard
                </c-button>
            </c-button-group>
        </div>
    </div>
</template>
