<script setup>
  import axios from 'axios';
  import { ref } from 'vue';

  import NavBar from '../components/NavBar.vue';
  import Filters from '../components/Filters.vue';
  import Offers from '../components/Offers.vue';
  import Breadcrumbs from '../components/Breadcrumbs.vue';

  let filtersRef = ref(null);
  let definitions = {};
  let auctions = ref([]);

  // Retrieve list of categories, quality tags and auctions from the api
  setTimeout(async () => {
    await axios.get('retrieve_auctions_definitions')
    .then((response) => {
      definitions = response.data;
      filtersRef.value.definitionsObtained(definitions);
    })
    .catch((e) => {
      // Failed request handling
      return;
    });

    // Second request to get all auctions
    await axios.get('retrieve_auctions')
    .then((response) => {
      auctions.value = auctionsDataPostProcessing(response.data);
    })
    .catch((e) => {
      return;
    });
  });

  // Some processing done on auctions data before making them available to other components
  function auctionsDataPostProcessing(rawAuctionsData) 
  {
    for (let auction of rawAuctionsData)
    {
      auction["auction_end"] = new Date(Date.parse(auction["auction_end"]));
      auction.quality = definitions.qualities[auction["quality_id"]];
    }

    return rawAuctionsData
  }
</script>

<template>
  <header id="header">
    <nav>
      <NavBar/>
    </nav>
  </header>
  <main id="main">
    <nav id="breadcrumbs">
      <Breadcrumbs/>
    </nav>
    <article id="marketplace-description">
      <h1>Lot revendeur : acheter des lots déstockage en toute confiance</h1>
      <p>Découvrez des lots revendeur, palettes solderie & grossiste déstockage, invendus et faillites en direct des plus grandes marques et retailers.</p>
    </article>
    <section id="marketplace">
      <Filters ref="filtersRef"/>
      <Offers v-bind:auctions="ref(auctions)"/>
    </section>
  </main>
</template>

<style scoped>
  #header {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1001;
  }

  #header > nav {
    width: 100vw;
    height: var(--nav-height);
    background-color: var(--bg-secondary);
  }

  #main {
    position: relative;
    margin-inline: auto;
    padding-inline: 1.25rem;
    max-width: 80rem;
    top: var(--nav-height);
    left: 0;
  }

  #marketplace-description {
    text-align: left;
    line-height: 0.25rem;
    margin-bottom: 3rem;
  }

  #marketplace-description > p {
    font-size: var(--font-sz-sm);
    color: var(--font-secondary);
  }

  #marketplace {
    display: flex;
  }
</style>