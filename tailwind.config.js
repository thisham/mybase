/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

module.exports = {
    content: [
        "./resources/js/src/**/*.{html,js,jsx,ts,tsx}",
        "./resources/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["K2D", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                black: colors.black,
                white: colors.white,
                brand: colors.blue,
                transparent: colors.transparent,
                ground: colors.slate,
                item: colors.gray,
                danger: colors.red,
                warning: colors.yellow,
                success: colors.green,
            },
        },
    },
    plugins: [],
};
