<div class="card mb-2">
    <div class="card-header">
        <div class="form-row">
            <h3 class="mb-0 col">{{ $header_data['main_name'] }}</h3>
            <div class="col text-right">
                <button type="submit" class="btn btn-success btn-sm text-capitalize">{{ $flag ? 'Create' : 'Update' }}</button>
                <a href="{{ secure_redirect(route('bars')) }}" class="btn btn-light btn-sm text-capitalize">
                    @{{ changed_status ? 'Cancel' : 'Close' }}
                </a>
                @if (!$flag)
                    <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#">Reset Stats</a>
                            <a class="dropdown-item" href="#">Archive</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body pb-0 pt-0">
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-bars" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-main-tab" data-toggle="tab" role="tab" aria-controls="tabs-main" aria-selected="true">
                        Main
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0{{ $flag ? ' disabled' : '' }}" id="tabs-appearance-tab" data-toggle="tab" role="tab" aria-controls="tabs-appearance" aria-selected="false">
                        Appearance
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0{{ $flag ? ' disabled' : '' }}" id="tabs-content-tab" data-toggle="tab" role="tab" aria-controls="tabs-content" aria-selected="false">
                        Content
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0{{ $flag ? ' disabled' : '' }}" id="tabs-timer-tab" data-toggle="tab" role="tab" aria-controls="tabs-timer" aria-selected="false">
                        Timer
                    </a>
                </li>
                <li class="nav-item disabled">
                    <a class="nav-link mb-sm-3 mb-md-0{{ $flag ? ' disabled' : '' }}" id="tabs-overlay-tab" data-toggle="tab" role="tab" aria-controls="tabs-overlay" aria-selected="false">
                        Overlay
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0{{ $flag ? ' disabled' : '' }}" id="tabs-lead-capture-tab" data-toggle="tab" role="tab" aria-controls="tabs-lead-capture"
                       aria-selected="false">
                        Lead Capture
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0{{ $flag ? ' disabled' : '' }}" id="tabs-translation-tab" data-toggle="tab" role="tab" aria-controls="tabs-translation" aria-selected="false">
                        Translation
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
