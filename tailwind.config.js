/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
    extend: {},
  },
  plugins: [],
}
module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
      extend: {
          backgroundImage: {
              'luxury-gradient': 'radial-gradient( rgba(14, 31, 47, 1) 30%, rgba(0, 0, 0, 1) 90%)',
          },
      },
  },
  plugins: [],
};
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      fontFamily: {
        mulish: ['Mulish', 'serif'],
        merriweather: ['Merriweather', 'serif'],
        playfair: ['Playfair Display', 'serif'],
        cinzel: ['Cinzel', 'serif'],  // Adding Cinzel as a custom font family
      },
    },
  },
  plugins: [],
};
module.exports = {
  content: ['./src/**/*.{html,php,js}'], // Adjust paths as needed
  theme: {
    extend: {
      backgroundImage: {
        'custom-texture': "url('../icons/Texture.png')",
      },
    },
  },
  plugins: [],
};
