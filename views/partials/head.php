<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&amp;family=Manrope:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js" defer></script>
    <title><?= $title ?? 'Neon Play' ?></title>
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                    "primary": "#8FF5FF",
                    "dark-primary": "#005d63",
                    "secondary": "#ff59e3",
                    "black": "#0e0e0e",
                    "secondary-black": "#201f1f",
                    "tertiary-black": "#131313",
                    "white": "#ffffff",
                    "secondary-white": "#d0d0d0ff",
                    "tertiary-white": "#ADAAAA",
                    "gray": "#64748b",
                    "light-gray": "#efefefff",
                    "error-text": "#af2e30ff",
                    "error-container": "#ff716c",
                    "success-text": "#006a71",
                    "success-container": "#00deec",
                    "transparent": "transparent",

              },
              "fontFamily": {
                    "headline": ["Space Grotesk"],
                    "display": ["Space Grotesk"],
                    "body": ["Manrope"],
                    "label": ["Space Grotesk"]
              }
            },
          },
        }
    </script>
</head>