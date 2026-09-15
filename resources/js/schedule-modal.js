export default function scheduleModal() {
    return {
        name: '',
        date: '',
        dateFormatted: '',
        data: {},
        url: '',

        open(name, date, dateFormatted, data, url) {
            this.name = name;
            this.date = date;
            this.dateFormatted = dateFormatted;
            this.data = data;
            this.url = url;
            this.$refs.dialog.showModal();
        },

        close() {
            this.name = '';
            this.date = '';
            this.dateFormatted = '';
            this.data = '';
            this.url = '';
            this.$refs.dialog.close();
        },
    };
}
