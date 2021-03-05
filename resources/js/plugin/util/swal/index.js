

import Swal from 'sweetalert2';

class VueSwal {
    constructor() {
        this.Swal = {};
        this.options = {};

        this.title = '';
        this.text = '';
        this.icon = 'success';
        this.timer = 3000;
        this.position = 'top-end';
        this.timerProgressBar = false;

        this.confirmBtn = false;
        this.button = {
            show: true,
            reverse: true,
            confirmText: 'Confirm',
            cancelText: 'Cancel'
        }

        return this;
    }

    show() {
        this.Swal.fire(this.options);
    }

    toast () {
        const Toast = Swal.mixin({
            toast: true,
            position: this.position,
            showConfirmButton: false,
            timer: this.timer,
            timerProgressBar: this.timerProgressBar,
        });
        Toast.fire({
            title: this.title,
            icon: this.icon
        });
    }

    dialog () {
        Swal.fire({
            title: this.title, 
            text: this.text, 
            icon: this.icon,
            timer: this.timer,
            showConfirmButton: this.confirmBtn
        });
    }

    confirm(callback=null) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-5'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: this.title,
            text: this.text,
            icon: this.icon,
            showCancelButton: this.button.show,
            confirmButtonText: this.button.confirmText,
            cancelButtonText: this.button.cancelText,
            reverseButtons: this.button.reverse
        }).then((result) => {
            if (result.value) {
                callback();
            }
        });
    }

    setTitle(title='')
    {
        this.title = title;
        return this;
    }

    setText(text = '')
    {
        this.text = text;
        return this;
    }

    setIcon(icon)
    {
        this.icon = icon;
        return this;
    }

    setTimer(timer)
    {
        this.timer = timer;
        return this;
    }

    setPosition(position)
    {
        this.position = position;
        return this;
    }

    showTimerProgressBar()
    {
        this.timerProgressBar = true;
        return this;
    }

    showConfirmButton()
    {
        this.confirmBtn = true;
        return this;
    }

    setButton(confirmText, cancelText, show=true, reverse=true)
    {
        this.showBtn = true;
        this.button = {
            show: show,
            reverse: reverse,
            confirmText: confirmText,
            cancelText: cancelText
        }
        return this;
    }
}

export default new VueSwal;