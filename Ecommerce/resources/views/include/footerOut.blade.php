<footer class="footer navbar-dark bg-dark">
    <div class="container footer__container">
        <div class="footer__menu--top">
            <h2 class="navbar-brand mb-0 h1"><a class="text-light home__url" href="{{ route('home') }}">Lucas Store
                    Test</a></h2>
        </div>
        <div class="footer__menu--bottom">
            <div class="footer__contact">
                <p>Contact</p>
                <div class="footer__info">
                    <a href="mailto:lucasdasilvamendes123456@hotmail.com">E-mail:
                        <span>lucasdasilvamendes123456@hotmail.com</span></a>
                    <a href="tel:11932303094">Tel: <span>(11) 93230-3094</span></a>
                    <a href="https://api.whatsapp.com/send?phone=5511932303094">WhatsApp</a>
                    <a href="https://www.linkedin.com/in/lucasmendes0402/">LinkedIn</a>
                </div>
            </div>
            <p class="text-light footer__rights">Test performed by Lucas</p>
        </div>
    </div>
</footer>

<script src="{{ url('/js/include/jquery-3.6.0.min.js') }}"></script>
<script src="{{ url('/js/default.js') }}"></script>
<script src="{{ url('/js/include/bootstrap.bundle.js') }}"></script>
<script src="@yield('utilities')"></script>
<script src="@yield('js')"></script>
<script src="@yield('page')"></script>
</body>

</html>
