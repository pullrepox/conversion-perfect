@if(Session::has('errors'))
    <div data-notify="container"
         class="alert alert-dismissible alert-danger alert-notify w-auto animated fadeInDown fade show" role="alert"
         data-notify-position="top-center"
         style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1080; top: 80px; left: 0px; right: 0px;">
        <span class="alert-icon fas fa-bug" data-notify="icon"></span>
        <div class="alert-text">
            <span class="alert-title" data-notify="title"></span>
            <span data-notify="message">{{$errors->all()[0]}}</span>
        </div>
        <button type="button" class="close" data-notify="dismiss" data-dismiss="alert" aria-label="Close"
                style="position: absolute; right: 10px; top: 5px; z-index: 1082;"><span aria-hidden="true">×</span>
        </button>
    </div>
@elseif(Session::has('message'))
    <div data-notify="container"
         class="alert alert-dismissible alert-success alert-notify w-auto animated fadeInDown fade show" role="alert"
         data-notify-position="top-center"
         style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1080; top: 80px; left: 0px; right: 0px;">
        <span class="alert-icon fas fa-smile" data-notify="icon"></span>
        <div class="alert-text">
            <span class="alert-title" data-notify="title"></span>
            <span data-notify="message" class="success-message">{{Session::get('message')}}</span>
        </div>
        <button type="button" class="close" data-notify="dismiss" data-dismiss="alert" aria-label="Close"
                style="position: absolute; right: 10px; top: 5px; z-index: 1082;"><span aria-hidden="true">×</span>
        </button>
    </div>
@endif