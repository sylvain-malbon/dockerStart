from flask import Blueprint, jsonify, request
from datetime import datetime

main = Blueprint("main", __name__)

_users = [
    {"id": 1, "name": "Alice"},
    {"id": 2, "name": "Bob"}
]

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
    return jsonify(_users)

@main.route("/api/users", methods=["POST"])
def create_user():
    data = request.get_json(silent=True) or {}
    name = data.get("name") or "Unnamed"

    # Simuler la création d'un utilisateur en mémoire
    new_user = {"id": max(u["id"] for u in _users) + 1, "name": name}
    _users.append(new_user)

    return jsonify({"ok": True, "user": new_user}), 201
