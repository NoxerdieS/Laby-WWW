<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "db.php";
?>
<footer class="footer">
    <div class="footer-author">
        Autor: Mateusz Bonat
    </div>
    <form id="reportForm">
        <label for="tresc-report">Zgłoś problem:</label>
        <textarea id="tresc-report" name="tresc" placeholder="Opisz problem..." required></textarea>
        <button type="submit">Wyślij zgłoszenie</button>
    </form>
    <script>
    document.getElementById('reportForm').addEventListener('submit', e => {
        e.preventDefault();
        const tresc = e.target.tresc.value;
        fetch('sendReport.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `tresc=${encodeURIComponent(tresc)}`
        })
        .then(res => res.text())
        .then(msg => {
            if (msg.trim() === 'sukces') {
                alert('Zgłoszenie zostało wysłane.');
                e.target.reset();
            } else if (msg.trim() === 'empty') {
                alert('Formularz jest pusty.');
            } else {
                alert('Wystąpił błąd. Spróbuj ponownie.');
            }
        });
    });
    </script>
</footer>
