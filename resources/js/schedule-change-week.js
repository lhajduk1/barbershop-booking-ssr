export default function scheduleChangeWeek(date) {
    return {
        date: date,
        employees: {},
        weekLabel: '',
        startOfWeek: '',
        endOfWeek: '',
        week: [],
        shift: null,
        overrides: [],

        init() {
            this.loadWeek('current');
        },

        async loadWeek(type) {
            const response = await fetch(
                `/admin/schedule/change-week?date=${this.date}&type=${type}`,
                {
                    headers: { Accept: 'application/json' },
                },
            );

            const data = await response.json();

            if (data) {
                this.date = data.startOfWeek;
                this.employees = data.employees;
                this.weekLabel = data.weekLabel;
                this.startOfWeek = data.startOfWeek;
                this.endOfWeek = data.endOfWeek;
                this.week = data.week;

                this.employees.forEach((employee) => {
                    employee.schedule.forEach((day) => {
                        day.override =
                            day.schedule_overrides.find(
                                (item) =>
                                    item.date === this.week[item.weekday].date,
                            ) ?? null;
                    });
                });
            }
        },
    };
}
