document.addEventListener('click', e => {
    const isDropdownButton = e.target.mathches("[data-drop-down]")

    if (!isDropdownButton && e.target.closest('[data-dropdown]') != null) return
    let currentDropdown
    if (isDropdownButton) {
        currentDropdown = e.target.closest('[data-dropdown]')
        currentDropdown.classList.toggle('active')
    }

})