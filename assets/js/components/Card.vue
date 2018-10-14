<script>
    export default {
        props: {
            image: {
                type: String,
            },
        },

        methods: {
            getClasses() {
                return {
                    'card': true,
                };
            },

            onImageLoad(event) {
                event.target.classList.remove('card__image--unloaded');
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import 'mixins';

    .card {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 226px;
        height: 314px;
        border: 6px solid #ffffff55;
        border-radius: 16px;
        overflow: hidden;

        &__label {
            font-weight: 500;
            text-transform: uppercase;
            color: #ffffff55;
        }

        &__image {
            @include transition(opacity .15s);

            &--unloaded {
                opacity: 0;
            }
        }
    }
</style>

<template>
    <div :class="getClasses()">
        <img
            v-if="image"
            class="card__image card__image--unloaded"
            width="226"
            height="314"
            :src="image"
            @load="onImageLoad" />
        <span v-if="!image" class="card__label">
            Empty
        </span>
    </div>
</template>
