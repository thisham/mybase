import React from "react";
import { createRoot } from "react-dom/client";
import "@resources/css/app.css";

export default function App() {
  return <h1>How To Install React in Laravel 9 with Vite</h1>;
}

const root = document.getElementById("root");

if (root) {
  createRoot(root).render(<App />);
}
