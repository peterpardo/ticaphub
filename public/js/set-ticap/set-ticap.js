async function addTicap() {
    try {
        const response = await fetch('/set-ticap', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json;charset=utf-8',
            },
            body: JSON.stringify({ ticap: this.ticap }),
        });
        const data = await response.json();
        // Show error message
        if (data?.errors) {
            this.message = data?.errors?.ticap[0];
            this.showMessage = true;
        } else {
            // reload the page
            location.reload();
        }
    } catch (err) {
        console.log("🚀 ~ file: set-ticap.js ~ line 18 ~ addTicap ~ err", err);
    }
}

function closeModal() {
    this.isOpen = false;
    this.message = "";
    this.ticap = "";
    this.showMessage = false;
}
