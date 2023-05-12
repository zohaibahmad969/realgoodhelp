window.addEventListener('load', () => {
	document.addEventListener('click', (e) => {
		if (!e.target.classList.contains('add-row')) return

		const btn = e.target
		const table = btn.previousElementSibling
		const emptyRow = table.querySelector('.empty-row.custom-repeter-text')

		const newRow = emptyRow.content.querySelector('tr').cloneNode(true)

		emptyRow.closest('tbody').append(newRow)
	})
	document.addEventListener('click', (e) => {
		if (!e.target.classList.contains('remove-row')) return

		const remBtn = e.target
		const row = remBtn.closest('tr')
		const inputs = row.querySelectorAll('input')

		inputs.forEach((input) => input.remove())
		remBtn.style.display = 'none'
	})
})