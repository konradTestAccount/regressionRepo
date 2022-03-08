{{--
 * Results - Headings: Displays headings and prev and next view
--}}

<div class="ajax-load-area" id="view_period_switchers" data-ajaxloadalso='["calendar_events", "calendar_box", "view-switchers"]'>

    {{--  Determines if it is a Day, Month, All view and show the relative headings --}}
    @if(isset($data['result_set_params']) && isset($data['result_set_params']['searching']))
        @if(!empty($data['result_set_params']['custom_heading']))
        @elseif($data['result_set_params']['searching'] !== 'all' && $data['result_set_params']['searching'] !== 'day')
            <p class="view_period_range">{{ $data['module']::getDate($data['result_set_params']['startdate'],'l, d F Y') }} - {{ $data['module']::getDate($data['result_set_params']['enddate'],'l, d F Y') }}</p>
        @elseif($data['result_set_params']['searching'] === 'day')
            <p class="view_period_range">{{ $data['module']::getDate($data['result_set_params']['startdate'],'l, d F Y') }}</p>
        @elseif($data['result_set_params']['searching'] === 'month')
            <p class="view_period_range">{{ $data['module']::getDate($data['result_set_params']['startdate'],'F Y') }}</p>
        @elseif(isset($data['result_set_params']['searching']) && $data['result_set_params']['searching'] === 'all')
            <p>You are viewing all events</p>
        @endif
    @endif
  
  
  
    {{--  Displays Prev and Next link of the current view --}}
    <nav class="view_period_switchers ajax-load-link">
    {{--  Displays prev link --}}
    @if(!empty($data['prev_link']) && $data['prev_check'])
            <a href="{{$data['prev_link']['href']}}" class="prev-search-link" rel="nofollow"  >
            @if($data['result_set_params']['searching']=="day")
                <span class="fa fa-chevron-left"></span> Previous Day
            @endif
  
            @if($data['result_set_params']['searching']=="week")
                <span class="fa fa-chevron-left"></span> Previous Week
            @endif
  
            @if($data['result_set_params']['searching']=="month")
               <span class="fa fa-chevron-left"></span> Previous Month
            @endif
  
            @if($data['result_set_params']['searching']=="year")
                <span class="fa fa-chevron-left"></span> Previous Year
            @endif
            </a>
    @endif
    @if(!empty($data['prev_link']) && !empty($data['next_link']) && $data['prev_check'] && $data['next_check'])
         |
    @endif
    {{--  Displays next link --}}
    @if(!empty($data['next_link']) && $data['next_check'])
            <a href="{{$data['next_link']['href']}}" class="next-search-link" rel="nofollow"  >
            @if($data['result_set_params']['searching']=="day")
                Next Day <span class="fa fa-chevron-right"></span>
            @endif
  
            @if($data['result_set_params']['searching']=="week")
                Next Week <span class="fa fa-chevron-right"></span>
            @endif
  
            @if($data['result_set_params']['searching']=="month")
                Next Month <span class="fa fa-chevron-right"></span>
            @endif
  
            @if($data['result_set_params']['searching']=="year")
                Next year <span class="fa fa-chevron-right"></span>
            @endif
            </a>
    @endif
    </nav>
  </div>
  
  
