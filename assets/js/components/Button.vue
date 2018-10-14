<script>
    export default {
        props: {
            to: {
                type: String,
            },
            action: {
                type: Function,
            },
            width: {
                type: String,
            },
            disabled: {
                type: Boolean,
                default: false,
            },
        },

        methods: {
            getClasses() {
                return {
                    'button': true,
                    'button--disabled': this.disabled,
                };
            },

            getStyles() {
                return {
                    width: this.width,
                };
            },

            onClick() {
                if (!this.disabled) {
                    if (undefined !== this.action) {
                        this.action();
                    }
                    else if (undefined !== this.to) {
                        this.$router.push({
                            path: this.to,
                        });
                    }
                }
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import 'variables';
    @import 'mixins';

    $border-width: 4px;
    $border-radius: 2 * $border-width;
    $padding-x: 25px;
    $padding-y: 15px;

    .button {
        @include transition(background-color .15s);

        display: inline-block;
        font-family: inherit;
        font-size: inherit;
        font-weight: 500;
        text-transform: uppercase;
        color: #fff;
        background-color: $green-darker;
        cursor: pointer;
        outline: none;
        border: none;
        border-bottom: $border-width solid $green-dark;
        border-radius: $border-radius;
        padding: $padding-y $padding-x ($padding-y - $border-width);

        &:hover {
            background-color: $green-dark;
        }

        &--disabled {
            color: #ccc;
            background-color: $green-dark;
            opacity: .5;
            cursor: default;

            &:hover {
                background-color: $green-dark;
            }
        }
    }
</style>

<template>
    <button :class="getClasses()" :style="getStyles()" @click="onClick">
        <slot />
    </button>
</template>
