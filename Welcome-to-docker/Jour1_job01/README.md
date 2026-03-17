Vérifier la version d'installation de docker avec la commande
- docker --version
![alt text](image/01-version.png)

Tester les commandes de base dans le terminal :
- docker info
![alt text](image/02-info.png)

- docker ps
![alt text](image/03-ps.png)

- docker images
![alt text](image/04-images1.png)

- docker run
![alt text](image/05-run.png)

- docker stop
![alt text](image/06-stop.png)

- docker pull
![alt text](image/07-pull.png)

- docker images
![alt text](image/08-images2.png)




Arrêter votre container :
- docker stop <Container_ID>

Supprimer votre container :
- docker rm <Container_ID>

Supprimer l’image Docker :
- docker image rm <nom_image>

Supprimer le container "ABC" :
- docker rm ABC

Supprimer plusieurs conteneurs :
- docker rm $(docker ps -a -q)
