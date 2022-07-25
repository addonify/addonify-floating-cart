<script setup>
const { __ } = wp.i18n;
</script>
<template>
    <div class="error-404">
        <h3>{{ __("404", "addonify-floating-cart") }}</h3>
        <p>{{ __("Oops, page not found!", "addonify-floating-cart") }}</p>
        <router-link to="/" class="adfy-button">
            {{ __("Go Back", "addonify-floating-cart") }}
        </router-link>
    </div>
</template>
