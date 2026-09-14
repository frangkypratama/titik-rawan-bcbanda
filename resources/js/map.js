import L from 'leaflet';
import markerIcon from 'leaflet/dist/images/marker-icon.png';
import markerIcon2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
    iconRetinaUrl: markerIcon2x,
    iconUrl: markerIcon,
    shadowUrl: markerShadow,
});

const DEFAULT_CENTER = [-6.2, 106.816666];
const DEFAULT_ZOOM = 12;

function addTileLayer(map) {
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 20,
    }).addTo(map);
}

function googleMapsDirectionUrl(lat, lng) {
    return `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text ?? '';
    return div.innerHTML;
}

function buildPopupContent(point) {
    const nama = escapeHtml(point.nama);
    const foto = point.foto_url
        ? `<img src="${escapeHtml(point.foto_url)}" alt="${nama}" class="img-fluid rounded mb-2" style="max-height:150px;object-fit:cover;width:100%">`
        : '';

    const subtitleParts = [point.kota_kabupaten, point.jenis_kapal, point.akses]
        .filter(Boolean)
        .map(escapeHtml);
    const subtitle = subtitleParts.length
        ? `<div class="small text-body-secondary mb-2">${subtitleParts.join(' &middot; ')}</div>`
        : '';

    const deskripsi = point.deskripsi
        ? `<p class="mb-2 small">${escapeHtml(point.deskripsi)}</p>`
        : '';

    return `
        <div style="min-width:220px">
            <h6 class="mb-1">${nama}</h6>
            ${subtitle}
            ${foto}
            ${deskripsi}
            <a href="${googleMapsDirectionUrl(point.latitude, point.longitude)}" target="_blank" rel="noopener" class="btn btn-sm btn-primary w-100">
                Buka Rute di Google Maps
            </a>
        </div>
    `;
}

export function initTitikRawanMap(elementId, points) {
    const el = document.getElementById(elementId);
    if (!el) return;

    const map = L.map(elementId).setView(DEFAULT_CENTER, DEFAULT_ZOOM);
    addTileLayer(map);

    const markers = [];

    points.forEach((point) => {
        const marker = L.marker([point.latitude, point.longitude])
            .addTo(map)
            .bindPopup(buildPopupContent(point));
        markers.push(marker);
    });

    if (markers.length > 0) {
        const group = L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.2));
    }

    return map;
}

export function initPickerMap(elementId, latInputId, lngInputId, initialLat, initialLng) {
    const el = document.getElementById(elementId);
    const latInput = document.getElementById(latInputId);
    const lngInput = document.getElementById(lngInputId);
    if (!el || !latInput || !lngInput) return;

    const hasInitial = initialLat !== null && initialLng !== null;
    const center = hasInitial ? [initialLat, initialLng] : DEFAULT_CENTER;

    const map = L.map(elementId).setView(center, hasInitial ? 15 : DEFAULT_ZOOM);
    addTileLayer(map);

    let marker = hasInitial ? L.marker(center, { draggable: true }).addTo(map) : null;

    function setPosition(lat, lng) {
        latInput.value = lat.toFixed(7);
        lngInput.value = lng.toFixed(7);

        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng], { draggable: true }).addTo(map);
            marker.on('dragend', () => {
                const pos = marker.getLatLng();
                setPosition(pos.lat, pos.lng);
            });
        }
    }

    if (marker) {
        marker.on('dragend', () => {
            const pos = marker.getLatLng();
            setPosition(pos.lat, pos.lng);
        });
    }

    map.on('click', (e) => {
        setPosition(e.latlng.lat, e.latlng.lng);
    });

    return map;
}
