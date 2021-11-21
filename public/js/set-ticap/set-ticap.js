function setTicap() {
    return {
        isOpen: false,
        ticap: "",
        message: "",
        showMessage: false,
    
        addTicap() {
            if(this.ticap == "") {
                this.message = "TICaP name is required";
                this.showMessage = true;
                return;
            }

            let formData = {
                ticap: this.ticap,
            }
            fetch('/set-ticap', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json;charset=utf-8',
                },
                body: JSON.stringify(formData),
            })
            .then(response => response.json())
            .then(msg => {
                if(msg.status == 403) {
                    msg.errors.ticap.forEach(err => {
                        this.message = err;
                    })
                    this.showMessage = true;
                } else {
                    alert(msg.success);
                    location.reload();
                }
            })
        },

        closeModal() {
            this.isOpen = false;
            this.message = "";
            this.ticap = "";
            this.showMessage = false;
        }
    };
}