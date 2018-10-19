<script>
    export default {}
</script>

<style lang="scss" scoped>
    .header {
        text-align: center;
        margin-bottom: 50px;

        &__logo {
            height: 200px;
        }

        &__nav {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        &__nav-link {
            display: inline-block;
            padding: 8px 16px;
            font-size: 16px;
        }
    }
</style>

<template>
    <header class="header">
            <div>
                <img class="header__logo" src="/images/logo.svg" alt="Logotype" />
            </div>
            <nav class="header__nav">
                <router-link class="header__nav-link" to="/">Menu</router-link>
                <router-link class="header__nav-link" to="/board">Game</router-link>
                <router-link class="header__nav-link" to="/scoreboard">Score</router-link>
            </nav>
        </header>
</template>
