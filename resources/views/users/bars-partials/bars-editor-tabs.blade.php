<div class="card mb-2">
    <div class="card-header">
        <div class="form-row">
            <h3 class="mb-0 col" id="edit_page_title">{{ $header_data['main_name'] }}</h3>
            <div class="col text-right">
                <button type="submit" class="btn btn-success btn-sm text-capitalize">@{{ create_edit ? 'Create' : 'Update' }}</button>
                <a href="{{ secure_redirect(route('bars')) }}" class="btn btn-light btn-sm text-capitalize">
                    @{{ changed_status ? 'Cancel' : 'Close' }}
                </a>
                <div class="dropdown" v-if="!create_edit">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="javascript: void(0)" data-toggle="modal" data-target="#template-save-modal">Save as Template</a>
                        <a class="dropdown-item" href="#">Reset Stats</a>
                        <a class="dropdown-item" href="javascript: void(0)" @click="archiveBar">Archive</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body pt-0 pb-2">
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="barsTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" :class="{'active': model.sel_tab=== 'main'}" id="tabs-main-tab" href="javascript: void(0)" data-toggle="pill"
                       role="tab" aria-controls="tabs-main" :aria-selected="model.sel_tab === 'main' ? 'true' : 'false'" @click="tabClick($event, 'main')">
                        Main
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" :class="{'active': model.sel_tab=== 'appearance'}" href="javascript: void(0)" id="tabs-appearance-tab"
                       data-toggle="pill" role="tab" aria-controls="tabs-appearance" :aria-selected="model.sel_tab === 'appearance' ? 'true' : 'false'" @click="tabClick($event, 'appearance')">
                        Appearance
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" :class="{'active': model.sel_tab === 'content'}" href="javascript: void(0)" id="tabs-content-tab"
                       data-toggle="pill" role="tab" aria-controls="tabs-content" :aria-selected="model.sel_tab === 'content' ? 'true' : 'false'" @click="tabClick($event, 'content')">
                        Content
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" :class="{'active': model.sel_tab === 'timer'}" href="javascript: void(0)" id="tabs-timer-tab"
                       data-toggle="pill" role="tab" aria-controls="tabs-timer" :aria-selected="model.sel_tab === 'timer' ? 'true' : 'false'" @click="tabClick($event, 'timer')">
                        Timer
                    </a>
                </li>
                <li class="nav-item disabled">
                    <a class="nav-link mb-sm-3 mb-md-0" :class="{'active': model.sel_tab === 'overlay'}" href="javascript: void(0)" id="tabs-overlay-tab"
                       data-toggle="pill" role="tab" aria-controls="tabs-overlay" :aria-selected="model.sel_tab === 'overlay' ? 'true' : 'false'" @click="tabClick($event, 'overlay')">
                        Overlay
                    </a>
                </li>
                @if (!is_null(auth()->user()->permissions))
                    @if (auth()->user()->permissions['lead-capture'])
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" :class="{'active': model.sel_tab === 'lead_capture'}" href="javascript: void(0)" id="tabs-lead_capture-tab"
                               data-toggle="pill" role="tab" aria-controls="tabs-lead_capture" :aria-selected="model.sel_tab === 'lead_capture' ? 'true' : 'false'"
                               @click="tabClick($event, 'lead_capture')">
                                Lead Capture
                            </a>
                        </li>
                    @endif
                @endif
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" :class="{'active': model.sel_tab === 'translation'}" href="javascript: void(0)" id="tabs-translation-tab"
                       data-toggle="pill" role="tab" aria-controls="tabs-translation" :aria-selected="model.sel_tab === 'translation' ? 'true' : 'false'" @click="tabClick($event, 'translation')">
                        Translation
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="barsTabContent">
            @include('users.bars-partials.bars-main')
            @include('users.bars-partials.bars-appearance')
            @include('users.bars-partials.bars-content')
            @include('users.bars-partials.bars-countdown')
            @include('users.bars-partials.bars-overlay')
            @include('users.bars-partials.bars-lead-capture')
            @include('users.bars-partials.bars-translation')
        </div>
    </div>
</div>
