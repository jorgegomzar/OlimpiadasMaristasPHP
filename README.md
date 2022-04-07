# OlimpiadasMaristasPHP

Esta es una app que desarrollé en PHP y MySQL simplemente para poder ir guardando los resultados de los partidos y que pudieran ser visualizados por los alumnos del centro.
Tiene una estructura muy simple:
- index.php
Landing page de la web app. Muestra las tablas por deportes y la clasificación final.

- login.php
Un formulario de login por POST. Una vez creada la sesión con éxito redirige a update.php.

- update.php
Una versión de index.php con valores editables. Todo ello es un formulario, y está pensado para que cuando se hagan modificaciones y se pulse el botón de Submit se actualice la nueva información en la base de datos de MySQL. Si no se ha iniciado sesión, esta página siempre redirige a index.php para evitar que cualquiera pueda modificar los resultados.