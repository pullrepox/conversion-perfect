<div class="header-body">
    <div class="row align-items-center py-4">
        <div class="col-lg-12 col-12">
            <h6 class="h2 text-white d-inline-block mb-0">{{$bc['active']}}</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i></a></li>
                    @if(isset($bc['links']))
                        @foreach($bc['links'] as $link)
                            <li class="breadcrumb-item">
                                <a href="{{$link['url']}}">{{$link['title']}}</a>
                            </li>
                        @endforeach
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{$bc['active']}}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>