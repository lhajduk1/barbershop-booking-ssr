import Alpine from 'alpinejs';
import adminPanel from './admin-panel';

Alpine.data('adminPanel', adminPanel);
import flatpickr from 'flatpickr';
import bookingForm from './booking-form';

Alpine.data('bookingForm', (config) => bookingForm(config, flatpickr));

window.Alpine = Alpine;
window.flatpickr = flatpickr;

Alpine.start();
