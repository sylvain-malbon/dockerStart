# **Job 05 – Multi-stage Build**  
Optimiser ses images pour la production  
Formation DWWM – La Plateforme_

---

# **Objectif**

Tu vas apprendre à créer des images Docker ultra‑légères grâce au multi‑stage build.  
Cette technique est utilisée en production pour réduire la taille des images de **90%** !

---

# **Ce que tu vas apprendre**

- Comprendre le problème des images trop lourdes  
- Utiliser plusieurs `FROM` dans un Dockerfile  
- Séparer le build de l'exécution  
- Créer une image de production optimisée  

---

# **Le problème**

Une image Node.js classique avec les devDependencies peut faire **1 Go+**.  
En production, on n’a pas besoin de tout ça !

---

# **Image classique (lourde)**

```
FROM node:18
WORKDIR /app
COPY . .

RUN npm install        # Installe TOUT
RUN npm run build      # Build l'app

CMD ["npm", "start"]
```

Cette image contient :  
node_modules de dev, code source, outils de build… **inutiles en prod !**

---

# **La solution : Multi‑stage**

On utilise plusieurs `FROM` pour séparer les étapes.

---

## **Étape 1 : Builder (image temporaire)**

```
# Étape 1 : Build
FROM node:18 AS builder
WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build
```

---

## **Étape 2 : Production (image finale)**

```
# Étape 2 : Production
FROM node:18-alpine AS production
WORKDIR /app

COPY --from=builder /app/dist ./dist
COPY --from=builder /app/package*.json ./

RUN npm install --production

CMD ["node", "dist/index.js"]
```

**Note :** `COPY --from=builder` copie depuis l’étape précédente.  
L’image finale ne contient **QUE le nécessaire**.

---

# **Exemple complet : API Express**

## Structure du projet

```
api-optimized/
 ├─ src/
 │   └─ index.ts
 ├─ package.json
 ├─ tsconfig.json
 └─ Dockerfile
```

---

# **Dockerfile multi‑stage**

```
#
# ÉTAPE 1 : Build
#
FROM node:18-alpine AS builder

WORKDIR /app

# Copier les fichiers de dépendances
COPY package*.json ./
COPY tsconfig.json ./

# Installer TOUTES les dépendances (y compris dev)
RUN npm install

# Copier le code source
COPY src ./src

# Compiler TypeScript
RUN npm run build
```

---

```
#
# ÉTAPE 2 : Production
#
FROM node:18-alpine AS production

WORKDIR /app

# Copier UNIQUEMENT le build et les deps de prod
COPY --from=builder /app/dist ./dist
COPY --from=builder /app/package*.json ./

# Installer seulement les dépendances de production
RUN npm install --production

# Utilisateur non-root (sécurité)
USER node

EXPOSE 3000
CMD ["node", "dist/index.js"]
```

---

# **Comparaison des tailles**

```
Image classique : mon-api:dev      1.2 GB
Image multi-stage : mon-api:prod   150 MB
```

Réduction : **87%**

---

# **Exemple React (build statique)**

```
# Build React
FROM node:18-alpine AS builder
WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build
```

```
# Servir avec Nginx
FROM nginx:alpine

COPY --from=builder /app/build /usr/share/nginx/html

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
```

Image finale : environ **25 MB**.

---

# **Exercices**

1. Créer une API TypeScript simple (Hello World)  
2. Créer un Dockerfile multi‑stage  
3. Comparer la taille : image normale vs multi‑stage  
4. Créer un build React avec Nginx  
5. Tester que l’image de production fonctionne  

---

# **Commandes utiles**

```
# Voir la taille des images
docker images

# Builder une étape spécifique
docker build --target builder -t mon-app:builder .

# Builder l'image finale
docker build -t mon-app:prod .
```

---

# **Rendu attendu**

- Dockerfile multi‑stage commenté  
- Capture : comparaison des tailles (`docker images`)  
- Capture : application qui fonctionne  
- Code source sur GitHub  

---

Si tu veux, je peux aussi :  
- te générer une **version TXT téléchargeable**,  
- te faire une **version Markdown propre**,  
- ou t’aider à **faire ton Dockerfile multi‑stage** pour ton projet actuel.