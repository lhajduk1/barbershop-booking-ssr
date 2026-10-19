export default function scheduleModal() {
    return {
        employeeName: '',
        date: {},
        shift: {},
        scheduleBreaks: {},

        open({ employeeName, date, shift, scheduleBreaks }) {
            this.employeeName = employeeName;
            this.date = date;
            this.shift = shift;
            this.scheduleBreaks = scheduleBreaks;

            this.$refs.dialog.showModal();
        },

        close() {
            this.reset();
            this.$refs.dialog.close();
        },

        reset() {
            this.employeeName = '';
            this.date = {};
            this.shift = {};
            this.scheduleBreaks = {};
        },
    };
}
