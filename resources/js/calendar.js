import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

window.FullCalendar = { Calendar };

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
        eventContent: function(arg) {
            const event = arg.event;
            const foto = event.extendedProps.foto;
            
            if (foto) {
                return {
                    html: `<div class="fc-event-custom" style="padding: 2px;">
                        <img src="${foto}" style="width: 100%; height: 40px; object-fit: cover; border-radius: 3px; margin-bottom: 2px;">
                        <div style="font-size: 11px; font-weight: 600; line-height: 1.2; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">${event.title}</div>
                    </div>`
                };
            }
            
            return {
                html: `<div class="fc-event-custom">${event.title}</div>`
            };
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
                
                if (props.foto) {
                    detail += `<br><img src="${props.foto}" style="max-width: 200px; max-height: 150px; margin-top: 8px; border-radius: 4px;">`;
                }
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

            let detail = `<strong>${info.event.title}</strong><br><br>`;
            detail += `<strong>Kategori:</strong> ${props.kategori}<br>`;
            detail += `<strong>Tempat:</strong> ${props.tempat}<br>`;
            detail += `<strong>Waktu:</strong> ${start}`;
            if (end) {
                detail += ` - ${end}`;
            }
            detail += `<br><br><em>${props.deskripsi}</em>`;

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
