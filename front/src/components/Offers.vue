<script setup>
  import ItemCard from '../components/ItemCard.vue';

  const props = defineProps({
    auctions: {required: true}
  });

</script>

<template>
  <div id="offers-grid">
      <div class="display-options">
        <select class="sort-select" placeholder="Trier par">
          <option disabled selected>Trier par</option>
          <option>Date d'ajout</option>
          <option>Fin d'enchère</option>
          <option>Unités</option>
        </select>
      </div>
      <ItemCard v-for="auction in props.auctions.value"
      v-bind:title="auction.title"
      v-bind:auction-id="auction.id"
      v-bind:units="auction.units"
      v-bind:last-bid="auction['last_bid']"
      v-bind:num-bids="auction['num_bids']"
      v-bind:public-price="auction['public_price']"
      v-bind:unit-cost="auction['last_bid']/auction.units"
      v-bind:tag="auction.quality"
      v-bind:end-date="auction['auction_end']"
      />
    </div>
</template>

<style scoped>
  #offers-grid {
    width: 100%;
    height: fit-content;
    height: fit-content;
    display: inline-grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    max-width: 60rem;
    gap: 1.5rem;
  }

  .display-options {
    display: flex;
    grid-column: 1/-1;
    height: fit-content;
  }

  .sort-select {
    height: 3rem;
    border-width: 1px;
    border-style: solid;
    border-radius: 5px;
    border-color: var(--font-secondary);
    background-color: var(--bg-secondary);
    font-size: var(--font-sz-md);
    color: var(--font-secondary);
    padding: 1rem;
  }
  .sort-select:hover {
    border-color: var(--primary);
  }
</style>