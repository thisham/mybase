import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import reactRefresh from "@vitejs/plugin-react-refresh";

export default defineConfig(({ command }) => ({
    base: command == "serve" ? "" : "build",
    publicDir: "",
    build: {
        manifest: true,
        outDir: "public/build",
        rollupOptions: {
            input: "resources/js/app.js",
        },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        reactRefresh(),
    ],
    resolve: {
        alias: {
            "@resources": "/resources",
            "@src": "/resources/js/src",
        },
    },
}));
