export default function generateSlug(name, slug) {
    return {
        name: name,
        slug: slug,
        slugEdited: '',

        generate(value) {
            return value
                .toLowerCase()
                .trim()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/ł/g, 'l')
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
        },

        update() {
            if (!this.slugEdited) {
                this.slug = this.generateSlug(this.name);
            }
        },
    };
}
