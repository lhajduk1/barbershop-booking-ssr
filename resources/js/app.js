import Alpine from 'alpinejs';
import flatpickr from 'flatpickr';
import adminPanel from './admin-panel';
import bookingForm from './booking-form';
import generateSlug from './generate-slug';

Alpine.data('bookingForm', (config) => bookingForm(config, flatpickr));
Alpine.data('adminPanel', adminPanel);
Alpine.data('generateSlug', (name, slug) => generateSlug(name, slug));

window.Alpine = Alpine;
window.flatpickr = flatpickr;

Alpine.start();
