{{--
 * Calendar - Page: View to display the mini calendar
--}}

{{--Heading table - data-ajaxloadalso is used to load the other box  when any .ajax-load-link are clicked--}}
<div class="pcb-large-cal ajax-load-area" id="calendar_page" data-ajaxloadalso='["calendar_box", "view-switchers","hidden_form","jumpto_hidden_form","past_events"]'>
    <table class="cal-table">
        <thead>
        <tr class="calendar-box-header">
            {{-- Display Previous month link if exists --}}

            <th  id="pbc_prev_month">
                @if(!empty($data['previous_month_link']) && $data['prev_check'])
                <a href="{{ $data['previous_month_link']['href'] }}" class="ajax-load-link" ><span class="fa fa-chevron-left"></span><span class="prev-next-link">Prev</span></a>
                @endif
            </th>
            {{-- Display Heading Calendar ( ex. 'January') --}}
            <th colspan="5"  id="pbc_current_month">{{ $data['calendar']['heading'] }}</th>
            {{-- Display News link if it exits --}}

            <th  id="pbc_next_month">
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
                <th id="pbc-heading-{{$key}}" headers="pbc_current_month"><span>{{ $week_day }}</span></th>
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
                    <td class="{{{ $date_data['class'] }}}" headers="pbc-heading-{{$col++%7 }}">
                        @if((!isset($date_data['searched_href'])) || $date_data['searched_href'] == false)
                            <span>{{ $date_data['date'] }}</span>
                        @else
                            <a href="{{$data['all_event_url']}}{{ $date_data['searched_href'] }}" class="hasEvents"><span>{{{ $date_data['date'] }}}</span></a>
                                <?php $i = -1; ?>
                                @foreach($date_data["searched"] as $event)
                                    <?php
                                        $i++;
                                        if ($i>2) {
                                            continue;
                                        }
                                        if ($i==2) {
                                            ?>
                                            <a href="{{$data['all_event_url']}}{{ $date_data['searched_href'] }}" class="hasMoreEvents"><span>...</span></a>
                                            <?php
                                            continue;
                                        }
                                    ?>
                                    <div class="cal-event" id="pcb-calevent-{{$event["content_id"]}}-{{$key}}-{{$i}}" >
                                        @if (isset($event["url"]) && !empty($event["url"]))
                                            <a href="{{ $event['url'] }}{{ ($event['event_type'] != 'origin') ? '?event_type='.$event['event_type'] : '' }}" title="{{$event["name"]}}" data-tooltipcal="pcb-tooltip-{{ $date_data['date'] }}-{{$event["content_id"]}}">
                                        @else
                                            <a href="?event={{urlencode($event['name'])}}&event_id={{$event['content_id']}}" title="{{$event["name"]}}" data-tooltip="pcb-tooltip-{{ $date_data['date'] }}-{{$event["content_id"]}}">
                                        @endif
                                        {{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['startdate'],'H:i') }} {{$event["name"]}}
                                        @if (isset($event["url"]) && !empty($event["url"]))
                                            </a>
                                        @else
                                            </a>
                                        @endif
                                    </div>
                                    <div class="tooltip-info" id="pcb-tooltip-{{ $date_data['date'] }}-{{$event["content_id"]}}">
                                        @if (isset($event["tooltipHTML"]) && !empty($event["tooltipHTML"]))
                                            {{$event["tooltipHTML"]}}
                                        @else
                                            <h2>{{$event["name"]}}</h2>
                                            <div class="info">
                                                <p><strong>Start time</strong>: {{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['startdate'],'d/M/Y H:i') }}</p>
                                                <p><strong>End time</strong>: {{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['enddate'],'d/M/Y H:i') }}</p>

                                                @if (isset($event["location"]) && !empty($event["location"]))
                                                    <p><strong>Venue</strong>: {{ $event['location'] }}</p>
                                                @endif
                                            </div>
                                            <div class="short-desc">
                                                {{$event['short_desc']}}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>




