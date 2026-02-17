# Ресурсы внутренней части (app)

Статика для раздела после входа. Источник: **`resources/src/app/src/Dashboard.Default.html`**.

## Пути из шаблона → public/app

Все ссылки в Blade используют `asset('app/...')`, т.е. файлы должны лежать здесь в той же структуре.

### Шрифты и иконки
| В шаблоне | В public/app |
|-----------|--------------|
| font/iconsmind-s/css/iconsminds.css | font/iconsmind-s/css/iconsminds.css |
| font/simple-line-icons/css/simple-line-icons.css | font/simple-line-icons/css/simple-line-icons.css |

### CSS (порядок подключения как в Dashboard.Default)
- css/vendor/bootstrap.min.css
- css/vendor/bootstrap.rtl.only.min.css
- css/vendor/fullcalendar.min.css
- css/vendor/dataTables.bootstrap4.min.css
- css/vendor/datatables.responsive.bootstrap4.min.css
- css/vendor/select2.min.css
- css/vendor/perfect-scrollbar.css
- css/vendor/glide.core.min.css
- css/vendor/bootstrap-stars.css
- css/vendor/nouislider.min.css
- css/vendor/bootstrap-datepicker3.min.css
- css/vendor/component-custom-switch.min.css
- css/main.css
- css/dore.light.greysteel.min.css (тема)
- css/app.css (доп. стили приложения)

### JS (порядок как в Dashboard.Default)
- js/vendor/jquery-3.3.1.min.js
- js/vendor/bootstrap.bundle.min.js
- js/vendor/Chart.bundle.min.js
- js/vendor/chartjs-plugin-datalabels.js
- js/vendor/moment.min.js
- js/vendor/fullcalendar.min.js
- js/vendor/datatables.min.js
- js/vendor/perfect-scrollbar.min.js
- js/vendor/progressbar.min.js
- js/vendor/jquery.barrating.min.js
- js/vendor/select2.full.js
- js/vendor/nouislider.min.js
- js/vendor/bootstrap-datepicker.js
- js/vendor/Sortable.js
- js/vendor/mousetrap.min.js
- js/vendor/glide.min.js
- js/dore.script.js
- js/scripts.js

### Изображения (по необходимости)
- img/profiles/ — аватар пользователя в navbar
- img/notifications/ — иконки уведомлений

Если папок или файлов нет, соответствующие места в интерфейсе будут без картинок (или с иконкой).
