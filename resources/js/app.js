import Alpine from 'alpinejs';
import flatpickr from 'flatpickr';
import adminPanel from './admin-panel';
import bookingForm from './booking-form';
import generateSlug from './generate-slug';
import scheduleModal from './schedule-modal';

Alpine.data('bookingForm', (config) => bookingForm(config, flatpickr));
Alpine.data('adminPanel', adminPanel);
Alpine.data('generateSlug', (name, slug) => generateSlug(name, slug));
Alpine.data('scheduleModal', () => scheduleModal());

window.Alpine = Alpine;
window.flatpickr = flatpickr;

Alpine.start();
