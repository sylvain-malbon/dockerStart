# Livre d'or

Projet PHP/MySQL avec Docker pour gérer des utilisateurs, l’authentification et les commentaires d’un livre d’or.

## Prérequis

- Docker Desktop installé et démarré.
- Docker Compose disponible.

## Lancement

Depuis la racine du projet, lance la stack avec :

```bash
docker compose up -d
```

## Accès

- Application web : http://localhost:8080
- phpMyAdmin : http://localhost:8081

## Arrêt

Pour arrêter les conteneurs :

```bash
docker compose down
```

## Réinitialisation de la base

Pour supprimer les conteneurs et le volume MySQL, puis repartir de zéro avec `db/init.sql` :

```bash
docker compose down -v
docker compose up -d
```

## Variables d'environnement

Le fichier `.env` contient les variables utilisées par MySQL et par l'application PHP, notamment :

- `MYSQL_ROOT_PASSWORD`
- `MYSQL_DATABASE`
- `MYSQL_USER`
- `MYSQL_PASSWORD`
- `DB_HOST`
- `DB_NAME`
- `DB_USER`
- `DB_PASSWORD`

## Notes techniques

- L’application PHP utilise PDO avec MySQL.
- Le service `app` est construit avec le `Dockerfile` de la racine.
- Le script `db/init.sql` crée la base `livreor` et ses tables au premier démarrage.
