{{--
 * Search - GenericField: Displays the keywords search text
--}}
<div id="searchoptions-dates" class="ajax-load-area"   data-ajaxloadalso='["calendar_events", "calendar_box", "view_period_switchers", "view-switchers","calendar_page","jumpto_hidden_form","hidden_form_categories","past_events","hidden_form_dates","searchoptions-filters"]'>
    <form method="get" action="{{$data['all_event_url']}}" >
        <fieldset class="panel">
            <legend>&nbsp;</legend>

            <div id="dates_field">
                <label class="block" for="keywords">From:</label>
                <input type="date"
                       @if($data['date-from'])
                       value="{{ $data['date-from'] }}"
                       @endif
                       name="date-from" id="date-from"/>
                 <label class="block" for="date-from">to:</label>
                 <input type="date"
                        @if($data['date-to'])
                        value="{{ $data['date-to'] }}"
                        @endif
                        name="date-to" id="date-to"/>
            </div>
            <div id="hidden_form_dates">
            <input type="hidden"
                     @if($data['search'])
                     value="dates"
                     @endif
                     name="search" id="search_search"/>
              <input type="hidden"
                     @if($data['search_day'])
                     value="{{ $data['search_day'] }}"
                     @endif
                     name="day" id="search_day"/>
              <input type="hidden"
                     @if($data['search_month'])
                     value="{{ $data['search_month'] }}"
                     @endif
                     name="month" id="search_month"/>
              <input type="hidden"
                     @if($data['search_year'])
                     value="{{ $data['search_year'] }}"
                     @endif
                     name="year" id="search_year"/>
              <input type="hidden"
                     @if($data['keywords'])
                     value="{{ $data['keywords'] }}"
                     @endif
                     name="keywords" id="keywords"/>
            </div>

            <input type="submit" class="button calendar-button small" value="Search Dates" name="submit">

        </fieldset>
    </form>
</div>

