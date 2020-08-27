class App {
    renderPopup() {
        $(document.body).append(`
            <div hidden style="position:absolute;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.5)" id="popup">
                <br>
                <br>
                <div><button style="width: 100%; height: 30px; margin: 5px;" id="close">Close</button></div>
                <div><button style="width: 100%; height: 30px; margin: 5px;" id="save">Save</button></div>
                <br>
                <br>
            </div>
        `);

        $('#popup').append(document.forms[0].cloneNode(true));

        $('#addManager').click(() => $('#popup').removeAttr('hidden'));
        $('#close').click(event => this.closePopup(event));
        $('#save').click(event => {
            this.renderManagers(event);

            this.closePopup(event);
        })
    }

    renderManagers(event) {
        const [first, middle, last] = this.getFormInputValues(document.forms[1]);
        const json = JSON.parse(localStorage.managers || '[]').concat({
            first,
            middle,
            last,
            img: $(event.target).closest('#popup').find('img').attr('src')
        });

        localStorage.managers = JSON.stringify(json);

        $("#managers").html(json.map(({first,middle,last,img}) => (`
            <li><img src="${img}" width="100" /> ${first} ${middle} ${last}</li>
        `)))
    }

    closePopup(event) {
        document.forms[1].reset();
        $(event.target).closest('#popup').find('img').removeAttr('src');
        $('#popup').attr('hidden', 'hidden');
    }

    watchAvatars() {
        [].slice.call(document.forms).forEach(([{elements: {avatar: inputFile}}]) => {
            inputFile.addEventListener('change', ({target: rootTarget, target: {files: [file]}}) => {
                if (file) {
                    const reader = new FileReader();

                    reader.onload = ({target}) => {
                        const $img = $(rootTarget).closest('form').find('img');

                        $img
                            .attr('src', target.result)
                            .removeAttr('hidden');
                    };

                    reader.readAsDataURL(file);
                }
            });
        })
    }

    getFormInputValues(form) {
        return $(form).serialize().split('&').map(i => i.split('=')[1]);
    }

    updateHeader() {
        const { merge, fromEvent } = rxjs;
        const { tap, throttleTime } = rxjs.operators;

        const form$ = merge(
            ...$('input[type="text"]', document.forms[0])
                .toArray()
                .map(input => fromEvent(input, 'input'))
        );

        form$
            .pipe(
                throttleTime(1000, undefined, { trailing: true }),
                tap(() => {
                    const [first, middle, last] = this.getFormInputValues(document.forms[0]);

                    $('#header').html(`
                        First: ${first} Middle: ${middle} Last: ${last}
                    `);
                })
            )
            .subscribe();
    }

    render() {
        this.renderPopup();

        this.watchAvatars();

        this.updateHeader();
    }
}

new App().render();