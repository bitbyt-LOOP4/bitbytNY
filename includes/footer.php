<?php                                                       //Jesper & Oliver
if(isset($_SESSION['user_id'])) {
    /* Variabel til at styre footer */
    $footer = '
<footer class="footer py-4 px-4 my-0 d-none d-md-block bg-bitbyt-purple">
    <div class="row">
        <div class="col-3 text-light pt-2 small">
            &copy; 2019 Bitbyt.dk
        </div>
        <div class="col-6 text-center icon-footer">
            <a class="ins-ic mt-4" href="http://instagram.com/bitbyt">
                <i class="fab fa-instagram fa-lg mt-md-2 mr-md-5 mr-3 fa-2x text-light"></i>
            </a>
            <a class="fb-ic mt-4" href="http://www.facebook.com/bitbyt">
                <i class="fab fa-facebook-f fa-lg mt-md-2 text-light mr-md-5 mr-3 fa-2x"></i>
            </a>
        </div>
        <div class="col-3 text-right text-light">
            <a class="text-light small" href="om_os.php">Om os</a>
            <br>
            <a class="text-light small" href="kontakt.php">Kontakt</a>
        </div>
    </div>
</footer>
</body>

</html>
<script>
Popper.Defaults.modifiers.computeStyle.gpuAcceleration = false;
</script>
';
} else {
        $footer = '
<footer class="footer py-4 px-4 my-0 bg-bitbyt-purple">
    <div class="row">
        <div class="col-3 text-light pt-2 small">
            &copy; 2019 Bitbyt.dk
        </div>
        <div class="col-6 text-center icon-footer">
            <a class="ins-ic mt-4" href="http://instagram.com/bitbyt">
                <i class="fab fa-instagram fa-lg mt-md-2 mr-md-5 mr-3 fa-2x text-light"></i>
            </a>
            <a class="fb-ic mt-4" href="http://www.facebook.com/bitbyt">
                <i class="fab fa-facebook-f fa-lg mt-md-2 text-light mr-md-5 mr-3 fa-2x"></i>
            </a>
        </div>
        <div class="col-3 text-right text-light">
            <a class="text-light small" href="om_os.php">Om os</a>
            <br>
            <a class="text-light small" href="kontakt.php">Kontakt</a>
        </div>
    </div>
</footer>
</body>

</html>
';
}

echo $footer;
?>
