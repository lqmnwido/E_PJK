import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';


$(document).ready(function () {
    // When payment option changes, toggle the upload section
    $('input[name="paymentOpt"]').on('change', function () {
        toggleUploadSection();
    });

    // Initialize toggle state on page load
    toggleUploadSection();

    function toggleUploadSection() {
        var paymentOption = $('input[name="paymentOpt"]:checked').val();
        if (paymentOption === 'FPX') {
            $('#upload').hide(); // Hide upload for FPX
        } else if (paymentOption === 'CDM') {
            $('#upload').show(); // Show upload for CDM
        } else {
            $('#upload').hide(); // Default state
        }
    }
});

$('input[name="paymentOpt"]').on('change', function () {
    console.log('Triggered!');
});