import '../css/coreui-custom.scss';
import { Sidebar } from '@coreui/coreui/dist/js/coreui.esm.js';
import { initTitikRawanMap, initPickerMap } from './map.js';

window.initTitikRawanMap = initTitikRawanMap;
window.initPickerMap = initPickerMap;

window.addEventListener('DOMContentLoaded', () => {
    const sidebarEl = document.getElementById('sidebar');

    if (sidebarEl) {
        window.appSidebar = Sidebar.getOrCreateInstance(sidebarEl);
    }
});

window.toggleSidebar = function () {
    window.appSidebar?.toggle();
};
