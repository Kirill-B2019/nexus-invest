import './bootstrap';

import Alpine from 'alpinejs';
import './audiences'; // регистрирует Alpine-компонент 'audiences' через alpine:init
window.Alpine = Alpine;

Alpine.start();
