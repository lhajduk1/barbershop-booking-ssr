export default function scheduleModal() {
    return {
        employeeName: '',
        date: {},
        shift: {},

        open({ employeeName, date, shift }) {
            this.employeeName = employeeName;
            this.date = date;
            this.shift = shift;

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
        },
    };
}
