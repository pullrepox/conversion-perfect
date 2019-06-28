<!-- Footer -->
<footer class="footer pt-0" id="footer-main">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between m-0">
            <div class="col-lg-6">
                <div class="copyright text-center text-lg-left text-muted text-cp">
                    &copy; 2019{{ date('Y') != 2019 ? ' - ' . date('Y') : '' }} <a href="{{ config('site.home_url') }}" class="font-weight-bold ml-1 text-uppercase text-cp" target="_blank">
                        {{ config('app.name') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
