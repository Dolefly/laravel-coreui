
document.addEventListener('livewire:load', function () {
    var addDoctorModal = new bootstrap.Modal(document.getElementById('addDoctor'));
    var updateDoctorModal = new bootstrap.Modal(document.getElementById('updateDoctor'));

    // Handle when the addDoctor modal is hidden
    addDoctorModal._element.addEventListener('hidden.bs.modal', function () {
        Livewire.emit('resetFields');
    });

    // Handle when the updateDoctor modal is hidden
    updateDoctorModal._element.addEventListener('hidden.bs.modal', function () {
        Livewire.emit('resetFields');
    });

    Livewire.on('addDoctor', function () {
        addDoctorModal.show();
    });

    Livewire.on('updateDoctor', function () {
        updateDoctorModal.show();
    });
});

