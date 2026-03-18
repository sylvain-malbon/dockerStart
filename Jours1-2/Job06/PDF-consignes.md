# Job 06 - Dockerfile Python

## API Flask avec Docker

### Formation DWWM - La Plateforme

## Objectif

Tu vas créer un Dockerfile pour une API Python avec Flask. Python est très utilisé en backend et data science.

## Ce que tu vas apprendre

· Utiliser l'image Python officielle
· Gérer les dépendances avec requirements.txt
· Créer une API Flask
· Bonnes pratiques Python + Docker

## Structure du projet

```text
flask-api/
│
├── app/
│   ├── __init__.py
│   └── routes.py
│
├── requirements.txt
├── run.py
└── Dockerfile
```

## Fichier requirements.txt

```text
flask==3.0.0
flask-cors==4.0.0
python-dotenv==1.0.0
```

Note : requirements.txt liste les dépendances Python. Comme package.json pour Node.js.

## Fichier run.py

```python
from app import create_app

app = create_app()

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
```

## Fichier app/**init**.py

```python
from flask import Flask
from flask_cors import CORS

def create_app():
    app = Flask(__name__)
    CORS(app)

    from app.routes import main
    app.register_blueprint(main)

    return app
```

## Fichier app/routes.py

```python
from flask import Blueprint, jsonify
from datetime import datetime

main = Blueprint("main", __name__)

@main.route("/")
def index():
    return jsonify({
        "message": "Hello Docker + Flask!",
        "timestamp": datetime.now().isoformat()
    })

@main.route("/health")
def health():
    return jsonify({"status": "ok"})

@main.route("/api/users")
def users():
    return jsonify([
        {"id": 1, "name": "Alice"},
        {"id": 2, "name": "Bob"}
    ])
```

## Dockerfile (développement)

```dockerfile
# Image Python officielle
FROM python:3.11-slim

# Métadonnées
LABEL maintainer="ton.email@example.com"

# Variables d'environnement Python
ENV PYTHONDONTWRITEBYTECODE=1
ENV PYTHONUNBUFFERED=1

# Dossier de travail
WORKDIR /app

# Copier et installer les dépendances
COPY requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

# Copier le code source
COPY . .

# Port
EXPOSE 5000

# Commande de démarrage
CMD ["python", "run.py"]
```

## Explications

· python:3.11-slim : image légère (pas alpine car certains packages posent problème)
· PYTHONDONTWRITEBYTECODE : pas de fichiers .pyc
· PYTHONUNBUFFERED : logs en temps réel
· --no-cache-dir : pas de cache pip (image plus légère)

## Builder et lancer

```bash
# Builder
docker build -t flask-api:1.0 .

# Lancer
docker run -d -p 5000:5000 --name flask flask-api:1.0

# Tester
curl http://localhost:5000
curl http://localhost:5000/api/users
```

## Version production (Gunicorn)

Flask dev server n'est pas fait pour la production. On utilise Gunicorn :

### requirements.txt (ajouter)

```text
gunicorn==21.2.0
```

### Dockerfile production

```dockerfile
FROM python:3.11-slim

ENV PYTHONDONTWRITEBYTECODE=1
ENV PYTHONUNBUFFERED=1

WORKDIR /app

COPY requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

COPY . .

# Utilisateur non-root
RUN useradd -m appuser && chown -R appuser /app
USER appuser

EXPOSE 5000

# Gunicorn avec 4 workers
CMD ["gunicorn", "--bind", "0.0.0.0:5000", "--workers", "4", "run:app"]
```

## Exercices

· 1. Créer l'API Flask avec les 3 routes
· 2. Builder et tester l'image
· 3. Ajouter une route POST /api/users
· 4. Créer la version production avec Gunicorn
· 5. Comparer les tailles python:3.11 vs python:3.11-slim

## Rendu

· Code source complet (app/, run.py, requirements.txt)
· Dockerfile commenté
· Capture : API qui répond
· Push sur GitHub
