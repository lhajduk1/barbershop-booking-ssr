export default function bookingForm(
    config = {},
    createPicker,
    request = fetch,
) {
    let picker;
    let datesVersion = 0;
    let slotsVersion = 0;
    return {
        employeeId: config.employeeId || '',
        selectedDate: '',
        selectedTime: '',
        availableDates: [],
        availableSlots: [],
        loadingDates: false,
        loadingSlots: false,
        error: '',
        get canSubmit() {
            return (
                !this.loadingDates &&
                !this.loadingSlots &&
                !this.error &&
                this.availableDates.includes(this.selectedDate) &&
                this.availableSlots.includes(this.selectedTime)
            );
        },
        get status() {
            if (this.error)
                return 'We could not load appointments. Please try again.';
            if (this.loadingDates) return 'Loading available dates…';
            if (this.loadingSlots) return 'Loading available times…';
            if (!this.employeeId)
                return 'Choose a barber to see available appointments.';
            if (!this.availableDates.length)
                return 'No available dates for this barber.';
            if (!this.selectedDate)
                return 'Choose an available date to see appointment times.';
            if (!this.availableSlots.length)
                return 'No available times on this date. Please choose another date.';
            return `${this.availableSlots.length} appointment times available.`;
        },
        init() {
            picker = createPicker(this.$refs.datePicker, {
                dateFormat: 'Y-m-d',
                enable: [],
                disableMobile: true,
                onReady: (_, __, instance) =>
                    instance.calendarContainer.classList.add(
                        'booking-calendar',
                    ),
                onChange: (_, date) => {
                    this.selectedDate = date;
                    this.loadAvailableSlots();
                },
            });
            if (this.employeeId && config.urls[this.employeeId])
                this.loadAvailableDates(true);
            else this.employeeId = '';
        },
        destroy() {
            datesVersion++;
            slotsVersion++;
            picker?.destroy();
        },
        async loadAvailableDates(restore = false) {
            const version = ++datesVersion;
            slotsVersion++;
            this.selectedDate = '';
            this.selectedTime = '';
            this.availableDates = [];
            this.availableSlots = [];
            this.error = '';
            this.loadingSlots = false;
            this.loadingDates = false;
            picker.clear();
            picker.set('enable', []);
            if (!this.employeeId) return;
            this.loadingDates = true;
            try {
                const response = await request(config.urls[this.employeeId], {
                    headers: { Accept: 'application/json' },
                });
                if (!response.ok) throw new Error('availability');
                const data = await response.json();
                if (!data.dates || typeof data.dates !== 'object')
                    throw new Error('dates');
                if (version !== datesVersion) return;
                this.availableDates = [...new Set(Object.values(data.dates))];
                picker.set('enable', this.availableDates);
                if (this.availableDates.length)
                    picker.jumpToDate(this.availableDates[0]);
                if (restore && this.availableDates.includes(config.date)) {
                    this.selectedDate = config.date;
                    picker.setDate(config.date, false);
                    await this.loadAvailableSlots(config.time);
                }
            } catch {
                if (version === datesVersion) this.error = 'dates';
            } finally {
                if (version === datesVersion) this.loadingDates = false;
                console.log([...this.availableDates]);
                console.log(this.selectedDate);
            }
        },
        async loadAvailableSlots(restoreTime = '') {
            const version = ++slotsVersion;
            this.selectedTime = '';
            this.availableSlots = [];
            this.error = '';
            this.loadingSlots = false;
            if (!this.selectedDate || !this.employeeId) return;
            this.loadingSlots = true;
            try {
                const response = await request(
                    `${config.urls[this.employeeId]}?date=${encodeURIComponent(this.selectedDate)}`,
                    { headers: { Accept: 'application/json' } },
                );
                if (!response.ok) throw new Error('availability');
                const data = await response.json();
                if (!Array.isArray(data.slots)) throw new Error('slots');
                if (version !== slotsVersion) return;
                this.availableSlots = [...new Set(data.slots)];
                if (this.availableSlots.includes(restoreTime))
                    this.selectedTime = restoreTime;
            } catch {
                if (version === slotsVersion) this.error = 'slots';
            } finally {
                if (version === slotsVersion) this.loadingSlots = false;
            }
        },
        retry() {
            return this.error === 'dates'
                ? this.loadAvailableDates()
                : this.loadAvailableSlots();
        },
    };
}
