export default function scheduleModal() {
    return {
        name: '',
        date: '',
        data: {},
        url: '',

        open(name, date, data, url) {
            this.name = name;
            this.date = date;
            this.data = data;
            this.url = url;
            this.$refs.dialog.showModal();
        },

        close() {
            this.name = '';
            this.date = '';
            this.data = '';
            this.url = '';
            this.$refs.dialog.close();
        }
    }
}