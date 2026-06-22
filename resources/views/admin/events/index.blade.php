<x-admin-layout>
    <style>
    .dark .fc {
        --fc-page-bg-color: transparent;
        --fc-border-color: #374151;
        --fc-today-bg-color: rgba(59, 130, 246, 0.15);
        --fc-neutral-bg-color: #1f2937;
        --fc-list-event-hover-bg-color: #374151;
        color: #e5e7eb;
    }

    .dark .fc .fc-toolbar-title {
        color: #fff;
    }

    .dark .fc .fc-button {
        background-color: #374151;
        border: none;
        color: #fff;
    }

    .dark .fc .fc-button:hover {
        background-color: #4b5563;
    }

    .dark .fc .fc-daygrid-day-number {
        color: #d1d5db;
    }
    </style>
    <x-slot name="title">
        Calendario de eventos
    </x-slot>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-6">

            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                    Calendario de eventos
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Gestiona reuniones y eventos
                </p>
            </div>

            <button
                type="button"
                id="newEventBtn"
                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm transition">
                + Nuevo evento
            </button>

        </div>

        <!-- CALENDAR -->
        <div id="calendar"></div>

        <!-- MODAL BACKDROP -->
        <div id="eventModal"
            class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50
                    opacity-0 transition-all duration-200">

            <!-- MODAL PANEL -->
            <div id="eventPanel"
                class="bg-white dark:bg-gray-800 w-full max-w-lg rounded-xl shadow-lg overflow-hidden
                        scale-95 transition-all duration-200">

                <!-- HEADER -->
                <div class="p-4 border-b dark:border-gray-700 flex justify-between items-center">

                    <h2 id="modalTitle"
                        class="text-lg font-semibold text-gray-800 dark:text-white">
                        Nuevo evento
                    </h2>

                    <button id="closeModalBtn"
                            class="text-gray-400 hover:text-red-500 text-xl transition">
                        ✕
                    </button>

                </div>

                <!-- FORM -->
                <form id="eventForm" method="POST" class="p-6 space-y-4">

                    @csrf

                    <input type="hidden" name="id" id="event_id">

                    <!-- TITLE -->
                    <div>
                        <label class="text-sm text-gray-600 dark:text-gray-300">Título</label>
                        <input type="text"
                            name="title"
                            id="title"
                            class="w-full mt-1 rounded-lg border-gray-300
                                    dark:border-gray-700 dark:bg-gray-900 dark:text-white
                                    focus:ring focus:ring-blue-500/30">
                    </div>

                    <!-- DATE -->
                    <div>
                        <label class="text-sm text-gray-600 dark:text-gray-300">Fecha</label>
                        <input type="datetime-local"
                            name="start_date"
                            id="start"
                            class="w-full mt-1 rounded-lg border-gray-300
                                    dark:border-gray-700 dark:bg-gray-900 dark:text-white
                                    focus:ring focus:ring-blue-500/30">
                    </div>

                    <!-- DESCRIPTION -->
                    <div>
                        <label class="text-sm text-gray-600 dark:text-gray-300">Descripción</label>
                        <textarea name="description"
                                id="description"
                                rows="3"
                                class="w-full mt-1 rounded-lg border-gray-300
                                        dark:border-gray-700 dark:bg-gray-900 dark:text-white
                                        focus:ring focus:ring-blue-500/30"></textarea>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600 dark:text-gray-300">
                            Tipo
                        </label>

                        <select
                            name="type"
                            id="type"
                            class="w-full mt-1 rounded-lg border-gray-300
                                        dark:border-gray-700 dark:bg-gray-900 dark:text-white
                                        focus:ring focus:ring-blue-500/30">

                            <option value="meeting">Reunión</option>
                            <option value="course">Curso</option>
                            <option value="event">Evento</option>
                            <option value="task">Tarea</option>
                            <option value="appointment">Cita</option>
                            <option value="travel">Viaje</option>
                            <option value="important">Importante</option>
                            <option value="other">Otro</option>

                        </select>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600 dark:text-gray-300">
                            Visibilidad
                        </label>

                        <select
                            name="visibility"
                            id="visibility"
                            class="w-full mt-1 rounded-lg border-gray-300
                                    dark:border-gray-700 dark:bg-gray-900 dark:text-white
                                    focus:ring focus:ring-blue-500/30">

                            <option value="personal">Solo yo</option>
                            <option value="public">Público</option>

                        </select>
                    </div>

                    <!-- ACTIONS -->
                    <div class="flex justify-between pt-4 border-t dark:border-gray-700">

                        <button type="button"
                                id="deleteBtn"
                                class="hidden px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                            Eliminar evento
                        </button>

                        <div class="flex gap-2 ml-auto">

                            <button type="button"
                                    id="cancelBtn"
                                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700
                                        text-gray-800 dark:text-gray-100
                                        rounded-lg transition">
                                Cancelar
                            </button>

                            <button type="submit"
                                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                                Guardar
                            </button>

                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>

    <!-- FULLCALENDAR CDN -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const calendarEl = document.getElementById('calendar');

    const modal = document.getElementById('eventModal');
    const form = document.getElementById('eventForm');

    const cancelBtn = document.getElementById('cancelBtn');
    const panel = document.getElementById('eventPanel');
    const closeBtn = document.getElementById('closeModalBtn');
    const deleteBtn = document.getElementById('deleteBtn');

    const newEventBtn = document.getElementById('newEventBtn');

    // =========================
    // CALENDAR
    // =========================
    const calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',
        locale: 'es',
        timeZone: 'local',

        height: 'auto',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        events: '{{ route("admin.events.fetch") }}',
        // eventColor: '#3b82f6',

        eventDidMount: function(info) {
            if (info.event.extendedProps.color) {
                info.el.style.backgroundColor = info.event.extendedProps.color;
                info.el.style.borderColor = info.event.extendedProps.color;
            }
        },

        dateClick: function(info) {

            let date = info.date;

            // FORMATEAR A datetime-local
            const pad = (n) => String(n).padStart(2, '0');

            const formatted =
                date.getFullYear() + '-' +
                pad(date.getMonth() + 1) + '-' +
                pad(date.getDate()) + 'T' +
                pad(date.getHours()) + ':' +
                pad(date.getMinutes());

            openCreateModal(formatted);
        },

        eventClick: function(info) {
            openEditModal({
                id: info.event.id,
                title: info.event.title,
                start: info.event.startStr,
                description: info.event.extendedProps.description,
                type: info.event.extendedProps.type,
                visibility: info.event.extendedProps.visibility
            });
        }

    });

    calendar.render();

    // =========================
    // SUBMIT AJAX (NUEVO)
    // =========================
    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const eventId = document.getElementById('event_id').value;

        const formData = {
            title: document.getElementById('title').value,
            start_date: document.getElementById('start').value,
            description: document.getElementById('description').value,
            type: document.getElementById('type').value,
            visibility: document.getElementById('visibility').value,
            _method: eventId ? 'PUT' : 'POST'
        };

        const url = eventId
            ? `/admin/events/${eventId}`
            : '/admin/events';
        console.log('URL:', url);
        console.log('METHOD (Laravel spoof):', formData._method);

        try {
            const response = await fetch(url, {
                method: 'POST', // 👈 SIEMPRE POST
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(formData)
            });

            console.log('STATUS:', response.status);
            console.log('RESPONSE:', await response.text());
            console.log('TYPE VALUE REAL:', document.getElementById('type').value);

            closeModal();
            calendar.refetchEvents();

        } catch (error) {
            console.error(error);
        }
    });

    // =========================
    // MODAL FUNCTIONS
    // =========================

    function openCreateModal(date = null) {

        document.getElementById('modalTitle').innerText = 'Nuevo evento';

        form.action = '/admin/events';

        document.getElementById('event_id').value = '';
        document.getElementById('title').value = '';
        document.getElementById('description').value = '';

        document.getElementById('type').value = 'meeting';

        const visibilityEl = document.getElementById('visibility');
        if (visibilityEl) {
            visibilityEl.value = 'personal';
        }

        document.getElementById('start').value = date ?? '';

        deleteBtn.classList.add('hidden');

        showModal();
    }

    function formatDateTimeLocal(date) {
        if (!date) return '';

        const d = new Date(date);

        const pad = (n) => String(n).padStart(2, '0');

        return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
    }

    function openEditModal(event) {

        document.getElementById('modalTitle').innerText = 'Editar evento';

        form.action = `/admin/events/${event.id}`;

        document.getElementById('event_id').value = event.id;
        document.getElementById('title').value = event.title;

        document.getElementById('type').value = event.type ?? 'meeting';

        const visibilityEl = document.getElementById('visibility');
        if (visibilityEl) {
            visibilityEl.value = event.visibility ?? 'personal';
        }

        document.getElementById('start').value =
            event.start ? formatDateTimeLocal(event.start) : '';

        document.getElementById('description').value = event.description ?? '';

        deleteBtn.classList.remove('hidden');

        showModal();
    }

    function showModal() {
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        requestAnimationFrame(() => {
            modal.classList.remove('opacity-0');
            panel.classList.remove('scale-95');

            modal.classList.add('opacity-100');
            panel.classList.add('scale-100');
        });
    }

    function closeModal() {
        modal.classList.add('opacity-0');
        panel.classList.add('scale-95');

        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 180);
    }

    function deleteEvent() {

        if (!confirm('¿Eliminar evento?')) return;

        fetch(`/admin/events/${document.getElementById('event_id').value}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(() => {
            closeModal();
            calendar.refetchEvents(); // 🔥 mejor que reload
        });
    }

    // =========================
    // EVENTS (LISTENERS)
    // =========================

    closeBtn?.addEventListener('click', closeModal);
    deleteBtn?.addEventListener('click', deleteEvent);
    cancelBtn?.addEventListener('click', closeModal);
    newEventBtn?.addEventListener('click', () => {
        openCreateModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    window.openCreateModal = openCreateModal;
    window.openEditModal = openEditModal;

});

</script>

</x-admin-layout>