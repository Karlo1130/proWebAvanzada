const editProductModal = document.getElementById('editProductModal')

if (editProductModal) {
    editProductModal.addEventListener('show.bs.modal', event => {

        const button = event.relatedTarget

        const recipient = button.getAttribute('data-bs-whatever').split('|')

        const nameInput = editProductModal.querySelector('.name')
        const slugInput = editProductModal.querySelector('.slug')
        const descriptionInput = editProductModal.querySelector('.description')
        const featuresInput = editProductModal.querySelector('.features')
        const idInput = editProductModal.querySelector('.id')

        nameInput.value = recipient[0]
        slugInput.value = recipient[1]
        descriptionInput.value = recipient[2]
        featuresInput.value = recipient[3]
        idInput.value = recipient[4]
    })
}