
document.addEventListener('DOMContentLoaded', function () {
    // Listen for click events on elements with the data-modal-toggle attribute
    document.querySelectorAll('[data-modal-toggle]').forEach(function (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            // Get the target modal ID from the data-modal-toggle attribute
            var target = toggleBtn.getAttribute('data-modal-toggle');
            var modal = document.getElementById(target);

            if (modal) {
                // Toggle the "hidden" class on the modal
                modal.classList.toggle('hidden');
            }
        });
    });
});

function closeModal(modalId){
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById(`${modalId}`);
        modal.addEventListener('click', function(event) {
            const modalContent = modal.querySelector('.relative');
            if (!modalContent.contains(event.target)) {
                modal.classList.add('hidden');
            }
        });
    });
}