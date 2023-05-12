window.addEventListener('click', (e) => {
	if (
		!e.target.closest('.conditinal_control') ||					//Is the checkbox pressed
		!e.target.closest('.conditinal_control').checked ||		//Is the checkbox active
		!e.target.closest('.repeater-table')							//Is it in the repeater unit
	) return;

	const checkbox = e.target.closest('.conditinal_control')
	const container = checkbox.closest('.repeater-table')

	const allCheck = container.querySelectorAll('.conditinal_control')
	let other

	allCheck.forEach((check) => {
		if (check !== checkbox) other = check;
	})

	if (other.checked) other.click();
})