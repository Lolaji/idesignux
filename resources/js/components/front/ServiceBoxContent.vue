<template>
    <div class="content">
        <h4 class="title wow">
            <a :href="url">
                <slot name="title">{{ title }}</slot>
            </a>
        </h4>
        <p class="wow">
            <slot />
        </p>
        <slot name="button">
            <a class="axil-button" :data-hover="moreTitle" :href="url">
                {{moreTitle}}
            </a>
        </slot>
    </div>
</template>
<script>
    export default {
        props: {
            title: {
                type: String
            },
            url: {
                type: String,
                default: () => '#'
            },
            moreTitle: {
                type: String,
                default: () => 'Learn More'
            }
        }
    }
</script>