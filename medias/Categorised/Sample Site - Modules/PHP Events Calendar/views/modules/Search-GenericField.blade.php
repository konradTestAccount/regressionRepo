{{--
 * Search - GenericField: Displays the keywords search text
--}}
<div id="searchoptions-generic" class="ajax-load-area search-filter"   data-ajaxloadalso='["calendar_events", "calendar_box", "view_period_switchers", "view-switchers","calendar_page","jumpto_hidden_form","hidden_form_categories","past_events","hidden_form_dates","searchoptions-filters"]'>
    <form method="get" action="{{$data['all_event_url']}}" class="" >
			<fieldset>
            <legend>Filter for events</legend>
            <div id="search_field">
                <label for="keywords">Filter for events:</label>
                <input type="text"
                       @if($data['keywords'])
                       value="{{ $data['keywords'] }}"
                       @endif
                       name="keywords" id="keywords" placeholder="Search by Keyword"/>
            </div>

            {{-- Display the hidden element for the filter--}}
            <div id="hidden_form_generic">
                @foreach($data['options'] as $name => $val)
                    <input type="hidden" name="{{$name}}" value="{{$val}}"/>
                @endforeach
            </div>

            <noscript>
              <input type="submit" class="button calendar-button small" value="Submit" name="submit">
            </noscript>
               </fieldset>
    </form>
</div>





