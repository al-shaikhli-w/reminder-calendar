window.addEventListener('load', function () {

    let editButton = document.querySelectorAll('.editButton');
    if (editButton) {
        editButton.forEach(
            button => {
                button.addEventListener("click", e => {
                    const modalID = e.target.id;
                    const modal = e.target.parentElement.querySelector(`section .${modalID}`)
                    modal.classList.remove('hidden');
                    const closeModal = modal.querySelector('.close-modal')

                    closeModal.addEventListener('click', function () {
                        modal.classList.add('hidden');
                    })
                })
            })
    }
})
