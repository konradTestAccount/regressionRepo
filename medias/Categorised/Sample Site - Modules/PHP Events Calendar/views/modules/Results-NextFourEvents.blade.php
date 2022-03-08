
  {{--  Loop of events of the page the array is divided by single days --}}
    @foreach ($data['events'] as $date => $ids)

        {{--  Loop for all event of the speicific day  --}}
        @foreach ($ids as $id => $event)

            {{--  Display single event information  --}}
            @if(!empty($event))
            {{-- to view all variable of $event {{ var_dump("event", $event) }} --}}
        <a href="{{ $event['url'] }}{{ ($event['event_type'] != 'origin') ? '?event_type='.$event['event_type'] : '' }}" class="events_listing">
            <div class="event_date">
              <?php
                $dateDay = $data['module']::getDate($event['multi_dates'][$event['event_type']]['startdate'],'d');
                $dateMonth = $data['module']::getDate($event['multi_dates'][$event['event_type']]['startdate'],'M');
              ?>
              <span class="month">{{ $dateMonth }}</span>
              <span class="day">{{ $dateDay }}</span>
            </div>
          <span class="event_title">{{ $event['name'] }}</span>
        </a>

  @endif
        @endforeach
    @endforeach

    {{--  Message if no events was found  --}}
    @if(empty($data['events']))
		<div class="events_listing">
            <p>There are currently no events for this period.</p>
		</div>
    @endif



