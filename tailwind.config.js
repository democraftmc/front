/** @type {import('tailwindcss').Config} */
export default {
  content: ["./views/**/*.{astro,html,js,jsx,md,mdx,svelte,ts,tsx,vue,php,blade.php}"],
  theme: {
    fontFamily: {
      sans: ["Satoshi", "Poppins", "sans-serif"],
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
          ...require("daisyui/src/theming/themes")["dark"],
          primary: "#f55",
          "--rounded-btn": "0.5rem", 
        },
      },
    ],
  },
  plugins: [
    require("daisyui"),
    require('@tailwindcss/typography'),
  ],
};

