import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

import { Modal } from 'flowbite';

Alpine.plugin(collapse);

window.Alpine = Alpine;

Alpine.start();
