class DnD {
    config = {
        inputElem: "#file",
        previewContainer: "#fileList",
        dropContainer: "#dropArea",
        btnClass: '.btn-form',
        inputName: 'image',
        csrf: false,
        allowedTypes: ["image/jpeg", "image/png", "image/webp"],
    };
    input = document.querySelector(this.config.inputElem);
    fileList = document.querySelector(this.config.previewContainer);
    dropArea = document.querySelector(this.config.dropContainer);
    btn = document.querySelector(this.config.btnClass)
    files = [];

    constructor(formContainer, config) {
        this.dropForm = formContainer;
        this.config = config ? Object.assign({}, this.config, config) : this.config;
        if (this.dropForm) {
            this.dropFile();
            this.fileInput();
            this.submit();
        }
    }

    getFileIcon(filename) {
        const ext = filename.split('.').pop().toLowerCase();

        const map = {
            pdf: 'bi-file-earmark-pdf',
            doc: 'bi-file-earmark-word',
            docx: 'bi-file-earmark-word',
            xls: 'bi-file-earmark-excel',
            xlsx: 'bi-file-earmark-excel',
            zip: 'bi-file-earmark-zip',
            rar: 'bi-file-earmark-zip',
            txt: 'bi-file-earmark-text',
            mp4: 'bi-file-earmark-play',
        };

        const icon = map[ext] || 'bi-file-earmark';

        return `<i class="bi ${icon}"></i>`;
    }

    dropFile() {
        this.dropArea.addEventListener("dragover", (e) => {
            e.preventDefault();
            this.dropArea.classList.add("highlight");
        });

        this.dropArea.addEventListener("dragleave", (e) => {
            e.preventDefault();
            this.dropArea.classList.remove("highlight");
        });

        this.dropArea.addEventListener("drop", (e) => {
            e.preventDefault();
            this.dropArea.classList.remove("highlight");
            this.handleFiles(e.dataTransfer.files);
        })
    }

    fileInput() {
        this.input.addEventListener("change", (e) => {
            this.handleFiles(e.target.files);
        })
    }

    handleFiles(files) {
        this.files = files;
        this.fileList.innerHTML = "";
        [...files].forEach(file => {
            if (this.config.allowedTypes.includes(file.type)) {
                this.previewFiles(file);
            } else {
                alert(`File type not allowed: ${file.name} (${file.type})`);
            }
        })
    }

    previewFiles(file) {
        console.log(file);
        
        const div = document.createElement('div');
        div.classList.add('file');

        const imgBlock = document.createElement('div');
        imgBlock.classList.add('img-block');

        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.onload = () => URL.revokeObjectURL(img.src);
            imgBlock.appendChild(img);
        } else {
            const icon = document.createElement('div');
            icon.className = 'file-icon';
            icon.innerHTML = this.getFileIcon(file.name);
            imgBlock.appendChild(icon);
        }

        const span = document.createElement('span');
        span.classList.add('name');
        span.textContent = file.name;

        const deleteButton = document.createElement('button');
        deleteButton.innerHTML = '<span class="icon"><i class="bi bi-trash"></i></span>';
        deleteButton.classList.add('fileDelete');
        deleteButton.addEventListener("click", () => {
            const dataTransfer = new DataTransfer();
            for (let i = 0; i < this.files.length; i++) {
                const fileInList = this.files[i];
                if (fileInList.name !== file.name) {
                    dataTransfer.items.add(fileInList);
                }
            }
            this.files = dataTransfer.files;
            div.remove();
        });
        div.appendChild(imgBlock);
        div.appendChild(span);
        div.appendChild(deleteButton);
        this.fileList.appendChild(div);
    }

    submit() {
        this.btn.addEventListener('click', (e) => {
            e.preventDefault();
            this.sendForm();
        })
    }

    sendForm() {
        let headers = {};
        this.dropForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(this.dropForm);

            [...this.files].forEach(file => {
                formData.append(this.config.inputName, file);
            })
            if (this.config.csrf) {
                headers = {
                    'X-CSRF-Token': this.getCSRFToken()
                }
            }
            fetch(e.target.getAttribute('action'), {
                method: 'POST',
                body: formData
            })
            .then(res => {
                if (res.ok) {
                    alert("Upload successful!");
                    window.location.href = res.url;
                }
            })
            .catch(err => {
                alert("Upload failed.");
                window.location.reload();
            });
        });
    }

    getCSRFToken() {
        return document.querySelector('meta[name=csrf-token]').getAttribute('content');
    }
}

export default DnD;