document.addEventListener('DOMContentLoaded', () => {
    const favIcon = document.querySelector('.fav');
    if (favIcon) {
        favIcon.addEventListener('click', () => {
            const idDzbana = favIcon.dataset.dzban;
            fetch('changeFav.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `idDzbana=${idDzbana}`
            })
            .then(res => res.text())
            .then(res => {
                if (res.trim() === 'sukces') {
                    const src = favIcon.src.includes('heart-filled.png') 
                        ? 'icons/heart-empty.png' 
                        : 'icons/heart-filled.png';
                    favIcon.src = src;
                }
            });
        });
    }
});
