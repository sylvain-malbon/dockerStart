# Récapitulatif visuel Docker Tic Tac Toe

Ce document présente uniquement les captures d'écran (01 à 13) et leur commentaire associé, dans l'ordre chronologique du déroulé Docker.

---

## 01. Build de l'image

![build](images/01_build.png)
Commande :

```bash
docker build -t tictactoe .
```

---

## 02. Présentation du Dockerfile

![dockerfile](images/02_images.png)
Commande :

```bash
docker images
```

---

## 03. Création du volume Docker

![volume](images/03_create-volume.png)
Commande :

```bash
docker volume create game-results
```

---

## 04. Vérifier les volumes existants

![ls-volume](images/04_verifier-volume.png)
Commande :

```bash
docker volume ls
```

---

## 05. Inspecter le volume

![inspect-volume](images/05_inspecter-volume.png)
Commande :

```bash
docker volume inspect game-results
```

---

## 06. Lancement du conteneur

![run](images/06_docker-run.png)
Commande :

```bash
docker run -d -p 8080:80 -v game-results:/var/www/html --name ttt tictactoe
```

---

## 07. Vérifier que le conteneur tourne

![ps](images/07_verifier-conteneur-tourne.png)
Commande :

```bash
docker ps
```

---

## 08. Voir le contenu du conteneur

![contenu-conteneur](images/08_verifier-contenu-conteneur.png)
Commande :

```bash
docker exec ttt ls /var/www/html
```

---

## 09. Shell interactif dans le conteneur

![shell-conteneur](images/09_shell-interactif.png)
Commande :

```bash
docker exec -it ttt bash
```

---

## 10. Quitter le shell interactif

![exit-shell](images/10_exit-shell.png)
Commande :

```bash
exit
```

---

## 11. Lire le contenu de results.json

![results-json-vide](images/11_lire-results.json.png)
Commande :

```bash
docker exec ttt cat /var/www/html/results.json
```

---

## 12. Voir le contenu du volume (méthode 1)

![contenu-volume-autre](images/12_voir-contenu-volume.png)
Commande :

```bash
docker exec ttt ls /var/www/html
```

---

## 13. Voir le contenu du volume (méthode 2)

![contenu-volume-terminal](images/13_autre-méthode_voir-contenu-volume.png)
Commande :

```bash
docker run --rm -v game-results:/data alpine ls /data
```

---
