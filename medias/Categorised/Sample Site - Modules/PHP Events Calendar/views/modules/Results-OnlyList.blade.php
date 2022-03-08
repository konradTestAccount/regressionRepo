{{--
 * Results - OnlyList: Displays the list of the events, paginated and already ordered.
--}}

<div class="ajax-load-area" id="calendar_events" data-ajaxloadalso='["calendar_events", "calendar_box", "view-switchers"]'>
    <div class="section no-tp">

      
      
      
      
      
      
      <div class="events-module">

     <ul class="no-bullet">
    @foreach ($data['events'] as $date => $ids)
       

    {{--  Loop of events of the page the array is divided by single days --}}
      {{--  Day events Title --}}
        @if($data['result_set_params']['searching'] !== 'day' && ($data['module']::getConfig('view_for_date_multi') ==  true))
            <div class="eventdate">
                <a href="{{ $data['module']::getDayLink($date,'d/m/Y') }}">
                    {{ $data['module']::getDate($date,'D d F, Y','d/m/Y') }}
                </a>
            </div>
        @endif
      @foreach ($ids as $id => $event)

        @if(!empty($event))
        <li class="event-item snippet event clearfix">
          <div class="event-date-box">
          <a href="{{ (isset($event['url'])) ? $event['url'] : '?event_id='.$event['content_id'] }}{{ ($event['event_type'] != 'origin') ? ((!empty($event['url']) ? '?' : '&').'event_type='.$event['event_type']) : '' }}">
        


@if(!isset($event['multidayevent']) || $event['multidayevent'] !== false)

           <div class="date-stamp nobackevents">
            <div class="month">{{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['startdate'],'M') }}</div>

            <div class="day">{{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['startdate'],'d') }}</div>
          </div>  
		  <div class="date-stamp smaller" style="margin-right: 0;width: auto;margin-left: -1rem;margin-top: 2rem;"> – </div>
          <div class="date-stamp2 date-stamp">
            <div class="month">{{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['enddate'],'M') }}</div>

            <div class="day">{{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['enddate'],'d') }}</div>
          </div> 

 @else

           <div class="date-stamp t4-e right">
            <div class="month">{{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['startdate'],'M') }}</div>

            <div class="day">{{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['startdate'],'d') }}</div>
          </div> 
  @endif



          </a>
          </div>
          {{ isset($event['image']) ? $event['image'] : '' }}
          <div class="event-info-box">
          <div class="event-info">
            <header>
              <p class="title"><a href="{{ (isset($event['url'])) ? $event['url'] : '?event_id='.$event['content_id'] }}{{ ($event['event_type'] != 'origin') ? ((!empty($event['url']) ? '?' : '&').'event_type='.$event['event_type']) : '' }}">
                {{ $event['name'] }}</a></p>
            </header>
            <p>{{ $event['short_desc'] }}</p>
            <p class="categories_trigger ajax-load-link" data-baseurl="{{$data['all_event_url']}}?search=all">
              <span class="fa fa-clock-o"></span>
              @if (empty($event['all_day']))
              <span class="datelisting">{{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['startdate'],'g:i A') }}</span> - <span class="datelisting">{{ $data['module']::getDate($event['multi_dates'][$event['event_type']]['enddate'],'g:i A') }}</span><br/>
              @endif
              <span class="fa fa-map-marker"></span> {{ $event['location'] }}<br/>
              <span class="fa fa-university"></span> {{ implode($event['categories'], ', ') }}
            </p>
          </div>   
          </div>
        </li>
        @endif
      @endforeach
    @endforeach
  </ul>
 </div>
      

    {{--  Displays the pagination  --}}
    @if(!empty($data['events']))
        @if(!empty($data['pagination']))

                @if(is_array($data['pagination']))
                    <ul class="pagination ajax-load-link">
                    @foreach ($data['pagination'] as $page)
                        @if ($page['text'] == "<<")
                            <li><a href="{{$page['href']}}" class="first" title="First Page">{{$page['text']}}</a></li>
                        @elseif ($page['text'] == ">>")
                            <li><a href="{{$page['href']}}" class="last" title="Last Page">{{$page['text'] }}</a></li>
                        @elseif ($page['text'] == "<")
                            <li><a href="{{$page['href']}}" class="prev" title="Previous Page">{{$page['text']}}</a></li>
                        @elseif ($page['text'] == ">")
                            <li><a href="{{$page['href']}}" class="next" title="Next Page">{{$page['text'] }}</a></li>
                        @elseif ($page['text'] == "Page …")
                            <li><span class="ellipses" title="…">…</span></li>
                        @else
                            <li><a href="{{$page['href']}}" class="page" title="Page {{$page['text'] }}">{{$page['text'] }}</a></li>
                        @endif
                    @endforeach
                    </ul>
                @else
                    <div class="pagination">
                        {{ $data['pagination'] }}
                    </div>
                @endif

        @endif
    @endif

    {{--  Message if no events was found  --}}
    @if(empty($data['events']))
        <div class="no-found">
            <p>There are currently no events for this period.</p>
        </div>
    @endif
    </div>
</div>










