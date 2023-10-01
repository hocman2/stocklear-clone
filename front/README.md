Ce projet est un clone partiel de la plateforme d'enchères https://lots.stocklear.fr/
Réalisé avec Laravel 10 et VueJS 3

Ce projet a été réalisé au cours d'un week-end.
Le temps imparti étant assez limité, certains aspects sont un peu bruts aussi bien visuellement que fonctionnellement, parfois par choix. 

#### Front-end:

##### Affichage des enchères
Les données des enchères sont récupérées depuis le serveur, elles sont utilisés pour mettre en place les "cards" qui présentent chaque enchère. Sur chaque carte d'enchère, il y a un compte à rebours dynamique ou fixe qui indique le temps restant de l'enchère.
Le compte à rebours dynamique s'affiche pour les enchères qui expirent dans moins d'1 jours.

##### Filtres
Pour l'affichage des filtres, les données "descriptive" des enchères sont récupérées. Ces données contiennent la liste des catégories, des tags de qualités et des localisations disponibles.

Ces données contiennent également la liste des filtres dits "disponibles", c'est à dire les filtres qui correspondent à au moins une enchère. En effet, il est possible qu'à un instant T aucune enchère n'entre dans la catégorie "Bricolage" par exemple, auquel cas cette catégorie sera indisponible.

##### Axes d'améliorations:
Outre la mise en page qui manque par endroit d'attention, l'interface du site n'est pas responsive, en dehors de la barre de navigation qui devient un menu caché sur tablette & mobile.

Selectionner un filtre ne rafraîchit pas la liste des enchères ou les autres filtres qui pourraient devenir indisponibles.

Les cartes d'enchères n'affichent pas le logo du vendeur (choix volontaire) ou l'image de l'enchère (par oubli, non-intégré à la BDD)

#### Back-end

##### Base de données
La base de données ne contient que les tables et colonnes nécessaires au cadre de ce projet. Il n'y a pas de table utilisateur, toutes les fonctionnalités d'authentification ont été mises de côté. Ce qui se rapproche le plus d'un utilisateur est un "vendor".
L'implémentation des localisations a été simplifiée et n'est pas adaptée pour un projet à plus grande envergure.

##### Requêtes
Les données ne pouvant être insérées que manuellement avec des requêtes SQL, le back-end sert uniquement à récupérer des données. Deux controllers permettent de récupérer respectivement les enchères et les descriptions d'enchère.
