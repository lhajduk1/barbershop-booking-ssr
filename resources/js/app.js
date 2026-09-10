import Alpine from 'alpinejs';
import flatpickr from 'flatpickr';
import bookingForm from './booking-form';

Alpine.data('bookingForm', (config) => bookingForm(config, flatpickr));

window.Alpine = Alpine;
window.flatpickr = flatpickr;

Alpine.start();
