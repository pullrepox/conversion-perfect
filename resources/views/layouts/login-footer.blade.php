<!-- Footer -->
<footer class="py-5" id="footer-main">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="copyright text-center text-muted text-cp">
                    &copy; 2019{{ date('Y') != 2019 ? ' - ' . date('Y') : '' }} <a href="{{ config('site.home_url') }}" class="font-weight-bold ml-1 text-uppercase text-cp" target="_blank">
                        {{ config('app.name') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
