/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        azulClaro: "#00BBC9",
        azulEscuro: '#00747C',
        cinzaClaro: '#F2F2F2',
        cinzaClaroEscuro: '#ECECEC',
        cinzaEscuro: '#878787',
        cinzaCinza: '#414142',
        cinzaPretoClaro: '#343436',
        cinzaPreto: '#202022',
        vermelho: '#F75A68'
      },
    },
  },
  plugins: [],
}