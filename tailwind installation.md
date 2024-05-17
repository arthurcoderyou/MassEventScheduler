# Install tailwindcss and its peer dependencies via npm, and then run the init command to generate both tailwind.config.js and postcss.config.js.
 npm install -D tailwindcss postcss autoprefixer
  npx tailwindcss init -p

# Add the paths to all of your template files in your tailwind.config.js file.
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

# Add the Tailwind directives to your CSS
# Add the @tailwind directives for each of Tailwind’s layers to your ./resources/css/app.css file.

@tailwind base;
@tailwind components;
@tailwind utilities;


# Start your build process
# Run your build process with npm run dev.

npm run dev

# Start using Tailwind in your project
# Make sure your compiled CSS is included in the <head> then start using Tailwind’s utility classes to style your content.

@vite('resources/css/app.css')