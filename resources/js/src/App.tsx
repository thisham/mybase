import React from "react";
import { createRoot } from "react-dom/client";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import "@resources/css/app.css";
import Home from "./app/Home";
import Target from "./app/Target";

export default function App() {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/targets" element={<Target />} />
    </Routes>
  );
}

const root = document.getElementById("root");

if (root) {
  createRoot(root).render(
    <BrowserRouter>
      <App />
    </BrowserRouter>
  );
}
