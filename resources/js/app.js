import '../css/coreui-custom.scss';
import { Sidebar } from '@coreui/coreui/dist/js/coreui.esm.js';
import { initTitikRawanMap, initPickerMap } from './map.js';

window.initTitikRawanMap = initTitikRawanMap;
window.initPickerMap = initPickerMap;

window.toggleSidebar = () => {
    Sidebar.getOrCreateInstance(document.getElementById('sidebar')).toggle();
};

document.addEventListener('show.coreui.modal', (event) => {
    if (event.target.id !== 'modal-hapus') return;

    const button = event.relatedTarget;
    document.getElementById('modal-hapus-form').action = button.dataset.deleteUrl;
    document.getElementById('modal-hapus-label').textContent = button.dataset.deleteLabel ?? 'data ini';
});
