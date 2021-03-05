<template>
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">
                <slot name="title">Put A Page Title Here</slot>
            </h1>
            
            <slot name="breadcrumb" />
        </div>
        <div class="ml-auto pageheader-btn">
            <slot  />
        </div>
    </div>
    <!-- PAGE-HEADER END -->
</template>