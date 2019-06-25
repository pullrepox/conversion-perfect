<!-- Footer -->
<footer class="footer pt-0" id="footer-main">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between m-0">
            <div class="col-lg-6">
                <div class="copyright text-center text-lg-left text-muted text-cp">
                    &copy; 2013 - {{ date('Y') }} <a href="{{ env('APP_URL') }}" class="font-weight-bold ml-1 text-uppercase text-cp" target="_blank">
                        {{ config('app.name') }}
                    </a>
                </div>
            </div>
{{--            <div class="col-lg-6"></div>--}}
        </div>
    </div>
</footer>
