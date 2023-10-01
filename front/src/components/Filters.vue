<script setup>
    import { ref } from 'vue';
    import FilterList from './FilterList.vue';

    defineExpose({
        definitionsObtained,
    })

    let filterOptions = {
        qualities: ref([]),
        categories: ref([]),
        countries: ref([]),
        regions: ref([]),
    }

    function definitionsObtained(definitions)
    {
        filterOptions.categories.value = prepareFilterIdValueFormat(definitions["available_categories"], definitions.categories);
        filterOptions.qualities.value = prepareFilterIdValueFormat(definitions["available_qualities"], definitions.qualities);
        filterOptions.countries.value = definitions.locations.countries;
        filterOptions.regions.value = definitions.locations.regions;
    }

    // Turns the raw json data in more descriptive objects with a flag if that filter is available for objects in "id: value" format
    function prepareFilterIdValueFormat(availableObjects, objects)
    {
        let preparedObjects = [];
        const keyList = Object.keys(objects);
        const valueList = Object.values(objects);
        for (let i = 0; i < keyList.length; ++i)
        {
            const id = Number.parseInt(keyList[i]);
            const description = valueList[i];
            const availability = availableObjects[id] !== undefined;
            preparedObjects.push({id: id, description: description, availability: availability});
        }

        return preparedObjects;
    }

</script>

<template>
    <ul class="filters">
        <FilterList display-title="Qualités" title-id="qualities" v-bind:options="filterOptions.qualities"/>
        <FilterList display-title="Catégories" title-id="categories" v-bind:options="filterOptions.categories"/>
        <FilterList display-title="Localisations" title-id="locations" v-bind:options="filterOptions.countries"/>
        <FilterList display-title="Lieux" title-id="places" v-bind:options="filterOptions.regions"/>
        <FilterList display-title="Prix publics" title-id="prices" v-bind:options="[]"/>
    </ul>
</template>

<style scoped>
    ul {
        list-style: none;
        text-align: left;
        padding: 0;
    }
</style>