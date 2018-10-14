<script>
    export default {
        props: {
            direction: {
                type: String,
                default: 'row',
            },
            gutter: {
                type: Number,
            }
        },

        data() {
            return {
                gutterOffsetPixels: (this.gutter / 2) + 'px',
                negativeGutterOffsetPixels: -(this.gutter / 2) + 'px',
            };
        },

        methods: {
            getClasses() {
                return {
                    'button-group': true,
                };
            },

            getStyles() {
                return {
                    flexDirection: this.direction,
                    margin: undefined !== this.gutter ? this.negativeGutterOffsetPixels : null,
                };
            },
        },

        mounted() {
            if (undefined !== this.gutter) {
                this.$children.map($child => {
                    $child.$el.style.margin = this.gutterOffsetPixels;
                    $child.$el.style.flex = 1;
                });
            }
        },
    }
</script>

<style lang="scss" scoped>
    .button-group {
        display: flex;
    }
</style>

<template>
    <div :class="getClasses()" :style="getStyles()">
        <slot />
    </div>
</template>
