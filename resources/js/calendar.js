import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

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
        events: eventsUrl,
        height: 'auto',
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

            let detail = `<strong>${info.event.title}</strong><br><br>`;
            
            if (props.type === 'deadline') {
                detail += `<strong>Tipe:</strong> <span style="color:#ef4444">Deadline Pendaftaran Volunteer</span><br>`;
                detail += `<strong>Deadline:</strong> ${start}<br>`;
            } else {
                detail += `<strong>Kategori:</strong> ${props.kategori}<br>`;
                detail += `<strong>Tempat:</strong> ${props.tempat}<br>`;
                detail += `<strong>Waktu:</strong> ${start}`;
                if (end) {
                    detail += ` - ${end}`;
                }
                detail += `<br><br><em>${props.deskripsi}</em>`;
            }

            alert(detail);
        },
    });

    calendar.render();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
        initCalendar('calendar', '/api/agenda/calendar');
        initCalendar('calendar-public', '/publik/agenda/calendar');
    });
} else {
    initCalendar('calendar', '/api/agenda/calendar');
    initCalendar('calendar-public', '/publik/agenda/calendar');
}
