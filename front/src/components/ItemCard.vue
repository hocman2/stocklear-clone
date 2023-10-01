<script setup>
    import { ref } from 'vue';
    import { numberLeadingZeros, getDateDelta } from '../auctionDisplay.js';

    const props = defineProps({
        title: {type: String, required: true},
        auctionId: {type: Number, required: true},
        tag: {type: String},
        lastBid: {type: Number, required: true},
        numBids: {type: Number},
        endDate: {type: Date, required: true},
        publicPrice: {type: Number, required: true},
        units: {type: Number, required: true},
        unitCost: {type: Number, required: true},
    });

    const hasSpecialOffer = false;
    let displayDate = ref("");

    let dateDelta = getDateDelta(props.endDate);
    const urgentDate = dateDelta.days == 0;

    if (urgentDate) 
    {
        repeatDateUpdate();
    }
    else 
    {
        displayDate.value = `Dans ${dateDelta.days} jours`;
    }

    function repeatDateUpdate() {
        setTimeout(() => {
            let dateDelta = getDateDelta(props.endDate)
            displayDate.value = `${numberLeadingZeros(dateDelta.hours, 2)}h ${numberLeadingZeros(dateDelta.mins, 2)}min ${numberLeadingZeros(dateDelta.secs, 2)}s`;
            repeatDateUpdate();
        }, 1000);
    }
</script>

<template>
    <div class="card">
        <router-link to="/test">
            <div class="card-header">
                <div class="corporation">
                    <span>Amazon</span>
                </div>
                <div class="card-img">
                    <img src="https://api.stocklear.com/storage/305237/conversions/copiedecouv-499243-normal.jpg"/>
                    <div v-if="hasSpecialOffer" class="img-banner">
                        <div>
                            <span>SANS PRIX DE RESERVE</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="offer-description">
                    <h5>{{props.title}}</h5>
                    <div class="auction">
                        <span>Enchère#{{ numberLeadingZeros(props.auctionId, 4) }}</span>
                    </div>
                    <span v-if="props.tag" class="offer-tag">{{props.tag}}</span>
                    <div class="description-rows">
                        <div class="description-rows-row">
                            <span class="offer-label">Dernière enchère</span>
                            <span class="offer-value">{{props.lastBid}}€</span>
                        </div>
                        <div v-if="props.numBids" class="description-rows-row">
                            <span class="offer-label">Nbr Enchères</span>
                            <span class="offer-value">{{ props.numBids }}</span>
                        </div>
                        <div class="description-rows-row">
                            <span class="offer-label">Fin de l'enchère</span>
                            <span class="offer-value"><span :class="{'countdown-important': urgentDate }">{{ displayDate }}</span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="footer-prices">
                    <div>
                        <span>{{props.publicPrice}}€</span>
                        <span class="offer-label">Prix public</span>
                    </div>
                    <div>
                        <span>{{ props.units }}</span>
                        <span class="offer-label">Unités</span>
                    </div>
                    <div>
                        <span>{{ props.unitCost.toFixed(2) }} €</span>
                        <span class="offer-label">Coût/unité</span>
                    </div>
                </div>
                <div class="offer-button"><button class="button-style">Consulter le lot</button></div>
            </div>
        </router-link>
    </div>
</template>

<style scoped>
.card {
    padding: 0;
    overflow: hidden;
    display: grid;
    height:fit-content;

    background-color: var(--bg-secondary);
    border-radius: 0.5rem;
    border: solid 1px var(--border);

    transition: all ease 0.2s;
}

.card:hover {
    border: solid 1px var(--primary);
}

.card-header {
    border-bottom: solid 1px var(--border);
    display: grid;
}

.card-header .corporation {
    height: 3.125rem;
    padding-block: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: solid 1px var(--border);
}

.card-header .corporation > span {
    display: block;
}

.card-header .card-img {
    height: 11.25rem;
    position: relative;
}

.card-header .card-img > img {
    max-width: 100%;
    max-height: 100%;
    mix-blend-mode: multiply;
    width: auto;
}

.card-header .card-img .img-banner {
    bottom: 0;
    opacity: .9;
    position: absolute;
    inset-inline: 0;
}

.card-header .card-img .img-banner > div {
    background:radial-gradient(circle farthest-corner at 10% 20%, rgba(255,209,67,1) 0%, rgba(255,145,83,1) 90%);
    color:#563114;
    font-weight: var(--font-we-md);
}

.card-body {
    border-bottom: solid 1px var(--border);
    padding: 1rem 1.25rem;
    text-align: left;
}

.card-body .offer-description {
    font-size: var(--font-sz-sm);
    color: var(--font-secondary);
    font-weight: var(--font-we-light);
}

.card-body .offer-description > h5 {
    font-weight: var(--font-we-bold);
    font-size: var(--font-sz-md);
    height: 2.5rem;
    margin-bottom: 0.25rem;
    margin-top: 0;
    color: var(--font-primary);
}

.card-body .offer-description > .auction {
    line-height: 0.5rem;
}

.offer-tag {
    margin-block: 1rem;
    border-radius: 10rem;
    color: var(--bg-secondary);
    padding: 0.125rem 0.5rem;
    align-items: center;
    display: inline-flex;
    justify-content: center;
    background: var(--primary);
    font-weight: var(--font-we-md);
}

.card-body .offer-description > .description-rows {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}
.card-body .offer-description > .description-rows > .description-rows-row {
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
}

.card-body .offer-description > .description-rows > .description-rows-row > .offer-value {
    color: var(--font-primary);
    font-size: var(--font-sz-md);
    font-weight: var(--font-we-md);
}

.countdown-important {
    color: var(--important);
}

.card-footer {
    display: flex;
    justify-content: center;
    align-items: center;

    height: 4.375rem;
    padding: 1rem 1.25rem;
}

.card-footer .footer-prices {
    font-size: var(--font-sz-md);
    display: flex;
    width: 100%;
    justify-content: space-between;
}

.card-footer .footer-prices > div {
    display: flex;
    text-align: left;
    flex-direction: column;
}

.card-footer .footer-prices > div > span:last-child {
    color: var(--font-secondary);
}

.card-footer {
    position: relative;
}
.card-footer .offer-button {
    width: 100%;
    height: 100%;
}


.card:hover .card-footer .offer-button {
    visibility: visible;
    position: relative;
}
.card:hover .card-footer .footer-prices {
    visibility: hidden;
    position: absolute;
}
.card:not(hover) .card-footer .offer-button {
    visibility: hidden;
    position: absolute;
}
.card:not(hover) .card-footer .footer-prices {
    visibility: visible;
    position: relative;
}

</style>