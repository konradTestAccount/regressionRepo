{{--
 * Calendar - Mini: View to display the mini calendar
--}}

{{--Heading table - data-ajaxloadalso is used to load the other box  when any .ajax-load-link are clicked--}}
<div class="pcb-mini-cal ajax-load-area" id="calendar_box" data-ajaxloadalso='["calendar_page","calendar_events", "view_period_switchers", "view-switchers","hidden_form","jumpto_hidden_form","calendar_events","past_events","searchoptions-generic","searchoptions-categories"]'>
    <table class="cal-table">
        <thead>
        <tr class="calendar-box-header">
            {{-- Display Previous month link if exists --}}

            <th  id="prev_month">
                @if(!empty($data['previous_month_link']) && $data['prev_check'])
                <a href="{{ $data['previous_month_link']['href'] }}" class="ajax-load-link" ><span class="fa fa-chevron-left"></span><span class="prev-next-link">Prev</span></a>
                @endif
            </th>
            {{-- Display Heading Calendar ( ex. 'January') --}}
            <th colspan="5"  id="current_month">{{ $data['calendar']['heading'] }}</th>
            {{-- Display News link if it exits --}}

            <th  id="next_month">
                @if(!empty($data['next_month_link']) && $data['next_check'])
                <a href="{{ $data['next_month_link']['href'] }}" class="ajax-load-link" ><span class="fa fa-chevron-right"></span><span class="prev-next-link">Next</span></a>
                @endif
            </th>
        </tr>
        {{--Display Weeday Heading (Ex. 'Mo','Tu', ...) --}}
        <tr class="calendar-dayhead">
            @foreach ($data['day_headings'] as $key => $heading)
                {{-- Limit the heading to 2 chars --}}
                <?php $week_day = mb_substr($heading, 0, 2); ?>
                <th id="heading-{{$key}}" headers="current_month"><span>{{ $week_day }}</span></th>
            @endforeach
        </tr>

        </thead>

        <tbody>
        {{-- $data['dates'] is organized to be split for weeks and than for days --}}

        @foreach ($data['dates'] as $row_dates)
            <?php $col = 0; ?>
            <tr class="calendar-dayrow">
                {{-- Display single day --}}
                @foreach($row_dates as $key => $date_data)
                   {{-- Check if the day as event --}}
                    @if((!isset($date_data['href'])) || $date_data['href'] == false || (preg_match("/custom-(.+)(day|days|week|weeks|month|months|year|years)$/iU", $data['module']::getConfig('default_search')) && $date_data['default_period'] == false))
                        {{-- No events found --}}
                        <td class="{{{ $date_data['class'] }}}" headers="heading-{{$col++%7 }}" id="day{{$key}}">
                            <span>{{ $date_data['date'] }}</span>
                        </td>
                    @elseif((!isset($date_data['searched_href'])) || $date_data['searched_href'] == false)
                        {{-- Searched events (when filter as Categories or Keyword are set) --}}
                        <td class="{{{ $date_data['class'] }}} hasEvents NotInFilter" headers="heading-{{$col++%7 }}" id="day{{$key}}">
                            <a href="{{$data['all_event_url']}}{{ $date_data['href'] }}" class="ajax-load-link">{{{ $date_data['date'] }}}</a>
                        </td>
                    @else
                        {{-- Rest of the events --}}
                        <td class="{{{ $date_data['class'] }}} hasEvents inFilter" headers="heading-{{$col++%7 }}" id="day{{$key}}">
                            <a href="{{$data['all_event_url']}}{{ $date_data['href'] }}" class="ajax-load-link">{{{ $date_data['date'] }}}</a>
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


