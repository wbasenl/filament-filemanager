<script>
    document.addEventListener('DOMContentLoaded', () => {
        Livewire.on('imageLoaded', (name) => {
            const filename = name[0].name;
            const checkPreview = setInterval(() => {
                const fileInfo = document.querySelector('.filepond--file-info .filepond--file-info-main');
                if (fileInfo) {
                    fileInfo.innerText = filename;
                    setTimeout(() => {
                        clearInterval(checkPreview);
                    }, 100);
                }
            })
        });
    });
</script>
