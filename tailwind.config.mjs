/** @type {import('tailwindcss').Config} */
export default {
  content: ["./src/**/*.{astro,html,js,jsx,md,mdx,svelte,ts,tsx,vue}"],
  theme: {
    fontFamily: {
      sans: ["Poppins", "sans-serif"],
    },
    extend: {},
  },
  darkMode: ["class", '[data-theme="dark"]'],
  daisyui: {
    themes: [
      {
        light: {
          ...require("daisyui/src/theming/themes")["cupcake"],
          primary: "#f55",
          "--rounded-btn": "0.5rem", 
        },
        dark: {
          ...require("daisyui/src/theming/themes")["coffee"],
          primary: "#f55",
        },
      },
    ],
  },
  plugins: [
    require("daisyui"),
    require('@tailwindcss/typography'),
  ],
};
