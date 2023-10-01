<script setup>
    import { onMounted } from 'vue';

    let menuActive = false;
    const screenWidthMq = window.matchMedia("(max-width: 1000px)");

    // Checks if mq matches and applies the correct styles to elements
    function checkMediaQueryMatch(mq, btn) {
        if (mq.matches) {
                btn.className = "active";
                hideMenu();
            }
            else {
                btn.className = "inactive";
                showMenu();
            }
    }

    function toggleMenu() {
        const menu = document.querySelector(".menu");

        if (menuActive) {
            menu.classList.add("inactive");
            menu.classList.remove("active");
            menuActive = false;
        }
        else {
            menu.classList.add("active");
            menu.classList.remove("inactive");
            menuActive = true;
        }
    }

    function gatherElements() {
        const menuMain = document.querySelector(".menu");
        const actionButtons = document.querySelector(".action-buttons");
        const menuEnd = document.querySelector(".menu-end");

        return {menuMain: menuMain, actionButtons: actionButtons, menuEnd: menuEnd};
    }

    function hideMenu() {
        const elements = gatherElements();
        const menuMain = elements.menuMain;
        const actionButtons = elements.actionButtons;

        menuMain.appendChild(actionButtons);

        menuMain.classList.add("stacked", "inactive");
        menuActive = false;
    }

    function showMenu() {
        const elements = gatherElements();
        const menuMain = elements.menuMain;
        const actionButtons = elements.actionButtons;
        const menuEnd = elements.menuEnd;

        menuEnd.appendChild(actionButtons);

        menuMain.classList.remove("stacked", "inactive", "active");
    }

    onMounted(() => {
        const hamburgerButton = document.querySelector("#mobile-menu-toggle");
        checkMediaQueryMatch(screenWidthMq, hamburgerButton);
        screenWidthMq.onchange = (e) => { checkMediaQueryMatch(e, hamburgerButton) }
    });
</script>

<template>
    <div class="navbar">
        <div class="logo">
            <router-link to="/">
                <img height="32" src="../assets/logo.svg"/>
            </router-link>
        </div>
        <ul class="menu">
            <li>Acheteurs</li>
            <li>Vendeurs</li>
            <li>A propos</li>
            <li>Assistance</li>
        </ul>
        <div class="menu-end">
            <img src="../assets/fr.svg"/>
            <button id="mobile-menu-toggle" @click="toggleMenu" class="inactive">
                <img src="../assets/menu-icon.svg"/>
            </button>
            <div class="action-buttons">
                <button id="register-button" class="button-style">S'inscrire</button>
                <button id="login-button" class="button-style">Déjà client ?</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .navbar {
        padding-block: 0;
        padding-inline: 1.25rem;
        height: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1001;
    }

    .logo {
        display: inline-block;
    }

    .menu {
        margin: 0;
        padding: 0;
        display: flex;
        flex-grow: 1;
        list-style: none;
        justify-content: center;

        column-gap: 4rem;
        font-weight: var(--font-we-md);
    }

    .menu.stacked {
        flex-direction: column;
        justify-content: start;
        column-gap: 2rem;
        z-index: 1000;
        position: absolute;
        left: 0;
        top: 100%;

        text-align: left;

        background-color: var(--bg-primary);
        height: 100vh;
        width: 100%;
    }

    .menu.stacked > * {
        padding: 0.5rem 1rem;
    }

    .menu.stacked > .action-buttons {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 1rem;
        justify-content: space-between;
    }

    .menu.stacked.inactive {
        visibility: hidden;
    }

    .menu.stacked.active {
        visibility: visible;
    }

    .menu-end {
        display: flex;
        align-items: center;
        column-gap: 2rem;
        font-size: var(--font-sz-md);
        font-weight: var(--font-we-md);
        padding-inline: 0.5rem;
    }

    .menu-end > .action-buttons {
        display: inherit;
        align-items: inherit;
        column-gap: inherit;
    }

    #register-button {
        font-size: inherit;
        font-weight: inherit;
        padding: 0.5rem 1rem;
    }

    #login-button {
        background-color: #475569;
        font-size: inherit;
        font-weight: inherit;
        padding: 0.5rem 1rem;
        text-wrap: nowrap;
    }

    #mobile-menu-toggle {
        border: none;
        box-shadow: none;
        background: none;
        outline: none;
        background-color: transparent;
    }

    #mobile-menu-toggle>img {
        height: 1rem;
    }

    #mobile-menu-toggle.inactive {
        visibility: hidden;
        position: absolute;
    }

    #mobile-menu-toggle.active {
        visibility: visible;
        position: relative;
    }
</style>