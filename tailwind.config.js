/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./**/*.php",
    "./templates/**/*.php",
    "./inc/**/*.php",
    "./assets/js/**/*.js"
  ],
  prefix: 'dsn-', // dsn- infront of all classes for DesignStudio Network
  theme: {
    extend: {
      screens: {
        max: '1800px', // Define a custom screen size for 1800px
      },
      container: {
        center: true, // Center the container by default
        padding: '1rem', // Add some padding for smaller screens
        screens: {
          sm: '100%',
          md: '100%',
          lg: '1200px',
          xl: '1400px',
          max: '1800px', // Apply 1800px max-width for the custom screen
        },
      },
    },
  },
  plugins: [],
}