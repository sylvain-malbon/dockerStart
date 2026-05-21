import { useEffect, useState } from "react";

function App() {
  const [message, setMessage] = useState("Chargement...");

  useEffect(() => {
    fetch("http://localhost:3000/")
      .then((res) => res.json())
      .then((data) => setMessage(data.message))
      .catch(() => setMessage("Erreur de connexion au backend"));
  }, []);

  return (
    <div>
      <h1>Frontend React + Vite</h1>
      <p>Message du backend : {message}</p>
    </div>
  );
}

export default App;
