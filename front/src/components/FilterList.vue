<script setup>
import { ref } from 'vue';

    const props = defineProps({
        displayTitle: {type: String, required: true},
        titleId: {type: String, required: true},
        options: {default: ref([])},
    });

    const fullId = `filter-${props.titleId}`

    function toggleFilterVisibility(id) {
        const filterCategory = document.querySelector(`#${id} > .category-title`);
        if (filterCategory.classList.contains("hidden")) {
            filterCategory.classList.remove("hidden");
        }
        else {
            filterCategory.classList.add("hidden");
        }
    }

    function isOptionAvailable(option)
    {
        // options with no availability field are considered available by default, otherwise the flag decides
        return option.availability !== undefined && !option.availability
    }

</script>

<template>
    <li v-bind:id="fullId" class="filter-category">
        <div class="category-title">
            <h3>{{props.displayTitle}}</h3>
            <button @click="toggleFilterVisibility(fullId)">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="icon p-tree-toggler-icon" style="" width="1em" height="1em" viewBox="0 0 32 32" data-v-c3ad5561=""><path fill="currentColor" d="m24 12l-8 10l-8-10z"></path></svg>
            </button>
        </div>
        <ul class="filter-options">
            <li v-for="option in props.options.value" class="filter-option" :class="{disabled: isOptionAvailable(option) }"><input v-bind:disabled="isOptionAvailable(option)" type="checkbox"/>{{ (option.description) ? option.description : option }}</li>
        </ul>
    </li>
</template>

<style scoped>
    ul {
        width: 100%;
        list-style: none;
        text-align: left;
        padding: 0;
    }

    .category-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .category-title > button {
        border: none;
        background: none;
    }

    .category-title > button:hover {
        cursor:pointer;
    }

    .category-title.hidden > button > svg {
        transform: rotate(-90deg);
    }

    .category-title.hidden+ul {
        visibility: hidden;
        position: absolute;
    }

    .filter-option.disabled {
        color: var(--font-secondary);
    }
    .filter-option {
        padding-inline: 1rem;
    }
</style>