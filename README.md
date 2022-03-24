<img width="946" alt="capture" src="https://user-images.githubusercontent.com/82716367/159891552-d3f42ece-cfbc-4e78-bd13-916fbed84226.png">
<img width="298" alt="capture2" src="https://user-images.githubusercontent.com/82716367/159891566-931cd33f-77fa-4117-ae15-fc8606399a84.png">
# tp3-televersement_image
ce tp a pour but de réaliser un televersement d'images en parcourant une arborescence de fichier et de les stocker dans une base de données ,c'est une suite du tp 2.
le fichier LireRecursiDir permet de parcourir cette arborescence,l'integralité du fichier est commenté pour mieux comprendre.

Ensuite les images se trouvant dans cette arborescence sont stockées dans la baase de données du TP 2,et sont affichées dans une grille de 6*2 dans un navigateur web
cette page contient une pagination qui permet d'afficher uniquement 6 images par page.

Comme on a toujours la meme interface que le tp 2,on peut donc toujours ajouter des images via le navigateur,ces images seront stockées dans la base de données ainsi que 
leurs nom,taille,chemin et extension, elle seont stockées dans le dossier uploads qui se trouve dans le  dossier docs,elle seront affichées dans la page web avec
les autres images se trouvant dans le dossier docs.

sur la page index on trouve également un lien qui permet de parcourir l'arborescence du dossier Docs.

L'ensemble de ce tp est réalisé avec mysql,php et bootstrap pour la mise en page.


