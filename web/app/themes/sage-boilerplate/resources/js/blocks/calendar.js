document.addEventListener('DOMContentLoaded', () => {
    const block = document.getElementById('event-calendar-block');
    if (!block) return;

    const events = JSON.parse(block.dataset.events);
    let currentMonth = parseInt(block.dataset.initialMonth, 10);
    let currentYear = parseInt(block.dataset.initialYear, 10);

    const calendarControls = block.querySelector('#calendar-controls');
    const calendarGrid = block.querySelector('#calendar-grid');

    // Helper: Wochentage und Monate auf Deutsch
    const weekdays = ['Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So'];
    const months = [
        'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
        'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
    ];

    // Helper: Event findet an einem bestimmten Tag statt?
    function eventOnDay(event, date) {
        const start = event.start;
        const end = event.end || start;
        return start <= date && end >= date;
    }

    function pad(n) { return n < 10 ? '0' + n : n; }

    function renderControls() {
        const years = [];
        const thisYear = new Date().getFullYear();
        for (let y = thisYear; y <= thisYear + 2; y++) years.push(y);

        let html = `
        <div class="mb-4">
            <button id="calendar-prev" class="px-2 py-1 rounded  hover:bg-gray-light" title="Vorheriger Monat"><i class="fa-regular fa-chevron-left"></i></button>
            <button id="calendar-today" class="px-2 py-1 rounded  hover:bg-gray-light text-base">Heute</button>
            <button id="calendar-next" class="px-2 py-1 rounded  hover:bg-gray-light" title="Nächster Monat"><i class="fa-regular fa-chevron-right"></i></button>
            <select id="calendar-month" class="border rounded px-1 py-0.5 text-base w-32">
        `;
        months.forEach((name, i) => {
            html += `<option value="${i + 1}" ${i + 1 === currentMonth ? 'selected' : ''}>${name}</option>`;
        });
        html += `</select>
            <select id="calendar-year" class="border rounded px-1 py-0.5 text-base w-20">`;
        years.forEach(y => {
            html += `<option value="${y}" ${y === currentYear ? 'selected' : ''}>${y}</option>`;
        });
        html += `</select>
            </div>
        `;
        calendarControls.innerHTML = html;
    }

function renderGrid(month, year) {
    // Heutiges Datum als String (YYYY-MM-DD)
    const today = new Date();
    const todayStr = `${today.getFullYear()}-${pad(today.getMonth() + 1)}-${pad(today.getDate())}`;

    const firstDay = new Date(year, month - 1, 1);
    const lastDay = new Date(year, month, 0);
    const daysInMonth = lastDay.getDate();
    const startDayOfWeek = (firstDay.getDay() + 6) % 7; // Mo=0, So=6

    let html = `<div class="grid grid-cols-7 min-w-[500px] border-gray-light border-t border-l">`;

    weekdays.forEach(wtag => {
        html += `<div class="border-b border-r border-gray-light text-center py-2 font-medium text-base">${wtag}</div>`;
    });

    for (let i = 0; i < startDayOfWeek; i++) {
        html += `<div class="border-b border-r border-gray-light bg-white"></div>`;
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const dayStr = `${year}-${pad(month)}-${pad(day)}`;
        const eventsToday = events.filter(event => eventOnDay(event, dayStr));
        let cellClass = "border-b border-r border-gray-light min-h-[9rem] align-top p-2 ";

        if (eventsToday.length > 0) {
            // Heute hervorheben
            cellClass += "bg-offwhite";
        } else if (dayStr === todayStr) {
            // Event-Tag einfärben
            cellClass += "bg-gray-100";
        } else if (
            dayStr < todayStr &&
            (year < today.getFullYear() ||
                (year === today.getFullYear() &&
                    (month < (today.getMonth() + 1) ||
                        (month === (today.getMonth() + 1) && day < today.getDate()))))
        ) {
            // Vergangenheit ausgrauen
            cellClass += "text-gray-light";
        } else {
            // Standard-Tag
            cellClass += "bg-white";
        }

        html += `<div class="${cellClass}">
            <div class="font-medium text-base mb-1">${day}</div>`;
        // Events für diesen Tag
        eventsToday.forEach(event => {
            html += `
                <div class="mb-2">
                    <a href="${event.link}" class="text-secondary font-bold text-sm hover:text-primary" target="_blank" rel="noopener">
                        ${event.title}
                    </a>
                </div>
            `;
        });
        html += `</div>`;
    }
    html += `</div>`;
    calendarGrid.innerHTML = html;
}

    function updateCalendar(newMonth, newYear) {
        currentMonth = newMonth;
        currentYear = newYear;
        renderControls();
        renderGrid(currentMonth, currentYear);
        attachListeners();
    }

    function attachListeners() {
        calendarControls.querySelector('#calendar-month').addEventListener('change', function () {
            updateCalendar(parseInt(this.value, 10), currentYear);
        });
        calendarControls.querySelector('#calendar-year').addEventListener('change', function () {
            updateCalendar(currentMonth, parseInt(this.value, 10));
        });
        calendarControls.querySelector('#calendar-today').addEventListener('click', function (e) {
            e.preventDefault();
            const today = new Date();
            updateCalendar(today.getMonth() + 1, today.getFullYear());
        });
        calendarControls.querySelector('#calendar-prev').addEventListener('click', function (e) {
            e.preventDefault();
            let m = currentMonth - 1;
            let y = currentYear;
            if (m < 1) { m = 12; y--; }
            updateCalendar(m, y);
        });
        calendarControls.querySelector('#calendar-next').addEventListener('click', function (e) {
            e.preventDefault();
            let m = currentMonth + 1;
            let y = currentYear;
            if (m > 12) { m = 1; y++; }
            updateCalendar(m, y);
        });
    }

    // Start!
    renderControls();
    renderGrid(currentMonth, currentYear);
    attachListeners();
});
