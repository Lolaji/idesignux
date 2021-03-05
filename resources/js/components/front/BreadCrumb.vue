<template>
    <ul class="axil-breadcrumb liststyle d-flex">
        <slot name="links">
            <li class="axil-breadcrumb-item"><a href="/">Home</a></li>
            <li 
                v-for="(item, index) in items" 
                :key="index"
                class="axil-breadcrumb-item" :class="{active: item.active}"
                aria-current="page">
                    <a v-if="!item.active" :href="item.url">{{ item.name }}</a>
                    <span v-else>{{ item.name }}</span>
                </li>
        </slot>
    </ul>
</template>

<script>
import StringFilters from '@/plugin/util/filters';

export default {
    props: {
        items: {
            type: [Array, Object],
            default: () => []
        }
    },
    filters: StringFilters,
}
</script>