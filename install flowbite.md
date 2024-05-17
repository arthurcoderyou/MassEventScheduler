#### install

npm install -D flowbite

#### Add the view paths and require Flowbite as a plugin inside `tailwind.config.js`:

```javascript
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js"
    ],
    theme: {
      extend: {},
    },
    plugins: [
        require('flowbite/plugin')
    ],
  }
```

#### Import the Flowbite JavaScript package inside the `./resources/js/app.js` file to enable the interactive components such as modals, dropdowns, navbars, and more.

```javascript
import 'flowbite';
```


#### Make sure your compiled CSS and JS is included in the `<head>` then start using Tailwind’s utility classes to style your content.

```javascript
@vite(['resources/css/app.css','resources/js/app.js'])
```
