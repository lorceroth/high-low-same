<script>
    export default {
        props: {
            loading: {
                type: Boolean,
                default: false,
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import 'mixins';

    @include keyframes(spinner) {
        from {
            transform: rotate(0);
        }

        to {
            transform: rotate(359deg);
        }
    }

    $size: 50px;
    $border-color: #fff;
    $animation-length: 1.5s;

    .loader {
        display: flex;
        align-items: center;
        flex-direction: column;
        text-align: center;

        &__spinner {
            @include animation(spinner $animation-length linear infinite);

            width: $size;
            height: $size;
            border: 4px solid $border-color;
            border-top-color: transparent;
            border-radius: $size / 2;
        }

        &__label {
            font-size: 18px;
            margin-top: 15px;
        }
    }
</style>

<template>
    <div class="loader" v-if="loading">
        <div class="loader__spinner"></div>
        <span class="loader__label">Loading</span>
    </div>
</template>
