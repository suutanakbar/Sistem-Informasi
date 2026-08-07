import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

window.FullCalendar = { Calendar };

function escapeHtml(text) {
    if (text == null) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function sanitizeImageUrl(url) {
    if (!url) return null;
    if (typeof url !== 'string') return null;
    if (url.startsWith('http://') || url.startsWith('https://')) {
        return url;
    }
    return null;
}

function initCalendar(elementId, eventsUrl) {
    const calendarEl = document.getElementById(elementId);

    if (!calendarEl) {
        return;
    }

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        locale: 'id',
        eventSources: [
            {
                url: eventsUrl,
                headers: {
                    'Accept': 'application/json'
                }
            }
        ],
        height: 'auto',
        eventContent: function(arg) {
            const event = arg.event;
            const foto = event.extendedProps.foto;
            const container = document.createElement('div');

            container.className = 'fc-event-custom';

            if (foto) {
                const image = document.createElement('img');

                const safeFoto = sanitizeImageUrl(foto);
                if (safeFoto) {
                    image.src = safeFoto;
                    image.style.cssText = 'width: 100%; height: 40px; object-fit: cover; border-radius: 3px; margin-bottom: 2px;';
                    container.style.padding = '2px';
                    container.appendChild(image);
                }
            }

            const title = document.createElement('div');

            title.textContent = event.title;

            if (foto) {
                title.style.cssText = 'font-size: 11px; font-weight: 600; line-height: 1.2; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;';
            }

            container.appendChild(title);

            // Add extended props safely
            const kategori = document.createElement('div');
            kategori.textContent = 'Kategori: ' + (event.extendedProps.kategori || '');
            kategori.style.cssText = 'font-size: 10px; color: #666; margin-top: 2px;';
            container.appendChild(kategori);

            return { domNodes: [container] };
        },
        eventClick: function (info) {
            const props = info.event.extendedProps;
            const start = info.event.start.toLocaleString('id-ID', {
                dateStyle: 'full',
                timeStyle: 'short',
            });
            const end = info.event.end
                ? info.event.end.toLocaleString('id-ID', {
                      dateStyle: 'full',
                      timeStyle: 'short',
                  })
                : null;

            const safeTitle = escapeHtml(info.event.title);
            const safeKategori = escapeHtml(props.kategori);
            const safeTempat = escapeHtml(props.tempat);
            const safeDeskripsi = escapeHtml(props.deskripsi);
            
            let detail = `${safeTitle}\n\n`;
            
            if (props.type === 'deadline') {
                detail += `Tipe: Deadline Pendaftaran Volunteer\n`;
                detail += `Deadline: ${start}\n`;
            } else {
                detail += `Kategori: ${safeKategori}\n`;
                detail += `Tempat: ${safeTempat}\n`;
                detail += `Waktu: ${start}`;
                if (end) {
                    detail += ` - ${end}`;
                }
                detail += `\n\nDeskripsi: ${safeDeskripsi}`;
            }

            alert(detail);
        },
    });

    calendar.render();
}

window.initPublicCalendarFromGlobal = function() {
    const calendarEl = document.getElementById('calendar-public');
    if (!calendarEl) return;
    if (!window.FullCalendar) {
        console.error('FullCalendar not loaded');
        return;
    }

    const events = window.publicCalendarEvents || [];

    const calendar = new window.FullCalendar.Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        locale: 'id',
        height: 'auto',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,listMonth'
        },
        events: events,
        eventClick: function(info) {
            const props = info.event.extendedProps;
            const start = info.event.start.toLocaleString('id-ID', {
                dateStyle: 'full',
                timeStyle: 'short',
            });
            const end = info.event.end
                ? info.event.end.toLocaleString('id-ID', {
                      dateStyle: 'full',
                      timeStyle: 'short',
                  })
                : null;

            const safeTitle = escapeHtml(info.event.title);
            const safeKategori = escapeHtml(props.kategori);
            const safeTempat = escapeHtml(props.tempat);
            const safeDeskripsi = escapeHtml(props.deskripsi);
            
            let detail = `${safeTitle}\n\n`;
            detail += `Kategori: ${safeKategori}\n`;
            detail += `Tempat: ${safeTempat}\n`;
            detail += `Waktu: ${start}`;
            if (end) {
                detail += ` - ${end}`;
            }
            detail += `\n\nDeskripsi: ${safeDeskripsi}`;

            if (props.detail_url) {
                window.location.href = props.detail_url;
            } else {
                alert(detail);
            }
        },
        eventDisplay: 'block',
        displayEventTime: true,
        eventTimeFormat: {
            hour: 'numeric',
            minute: '2-digit',
            meridiem: false
        }
    });

    calendar.render();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
        initCalendar('calendar', '/api/agenda/calendar');
        window.initPublicCalendarFromGlobal();
    });
} else {
    initCalendar('calendar', '/api/agenda/calendar');
    window.initPublicCalendarFromGlobal();
}
