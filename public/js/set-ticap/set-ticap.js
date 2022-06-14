async function addTicap() {
    try {
        const response = await fetch('/set-ticap', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json;charset=utf-8',
            },
            body: JSON.stringify({ ticap: this.ticap }),
        });
        const data = await response.json();
        console.log("🚀 ~ file: set-ticap.js ~ line 12 ~ addTicap ~ data", data)
        // Show error message
        if (data?.errors) {
            this.message = data?.errors?.ticap[0];
            this.showMessage = true;
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
