import Alpine from 'alpinejs';
import flatpickr from 'flatpickr';
import adminPanel from './admin-panel';
import bookingForm from './booking-form';
import generateSlug from './generate-slug';
import scheduleChangeWeek from './schedule-change-week';
import scheduleModal from './schedule-modal';

Alpine.data('bookingForm', (config) => bookingForm(config, flatpickr));
Alpine.data('adminPanel', adminPanel);
Alpine.data('generateSlug', (name, slug) => generateSlug(name, slug));
Alpine.data('scheduleModal', () => scheduleModal());
Alpine.data('scheduleChangeWeek', (date) => scheduleChangeWeek(date));

window.Alpine = Alpine;
window.flatpickr = flatpickr;

Alpine.start();
