{{--
 * Calendar - Switches: Shows the Day | Week | Month | Year | All switcher
--}}
<div class="view-switchers align-centre ajax-load-area" id="view-switchers" data-ajaxloadalso='["calendar_events", "view_period_switchers", "calendar_box","past_events","searchoptions","hidden_form_categories","hidden_form_generic","calendar_page"]'>
	{{-- Display the link only if it is not the current filter --}}
	@if ($data['param_search'] == "day")
		<span>
	@else
    <a href="{{$data['all_event_url']}}{{$data['search_day']}}" class=" ajax-load-link">
    @endif
    	Day
    @if ($data['param_search'] == "day")
		</span>
	@else
    	</a>
    @endif
    |
    @if ($data['param_search'] == "week")
		<span>
	@else
    <a href="{{$data['all_event_url']}}{{$data['search_week']}}" class=" ajax-load-link">
    @endif
    	Week
    @if ($data['param_search'] == "week")
		</span>
	@else
    	</a>
    @endif
    |
    @if ($data['param_search'] == "month")
		<span>
	@else
    <a href="{{$data['all_event_url']}}{{$data['search_month']}}" class=" ajax-load-link">
    @endif
    	Month
    @if ($data['param_search'] == "month")
		</span>
	@else
    	</a>
    @endif
    |
    @if ($data['param_search'] == "year")
		<span>
	@else
    <a href="{{$data['all_event_url']}}{{$data['search_year']}}" class=" ajax-load-link">
    @endif
    	Year
    @if ($data['param_search'] == "year")
		</span>
	@else
    	</a>
    @endif
    |
    @if ($data['param_search'] == "all")
		<span>
	@else
    <a href="{{$data['all_event_url']}}{{$data['search_all']}}" class=" ajax-load-link">
    @endif
    	All
    @if ($data['param_search'] == "all")
		</span>
	@else
    	</a>
    @endif
</div>


