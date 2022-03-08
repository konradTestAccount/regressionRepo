{{--
 * Results - Single: Fulltext of the single event.
--}}
<?php
$getVars = filter_var_array($_GET, FILTER_SANITIZE_STRING);
$event_type = isset($getVars['event_type']) && !empty($getVars['event_type']) ? $getVars['event_type'] : 'origin';
?>
{{-- to view all variable of data {{ var_dump("data", $data) }} --}}
@if(!empty($data))
  @if(!isset($data['url']))
    <h2>{{  $data['name']; }}</h2>
      <p class="meta">
  @endif

      @if(isset($data['multidayevent']) && $data['multidayevent'] === false)
          @if (empty($event['all_day']))
            {{ $data['module']::getDate($data['multi_dates'][$event_type]['startdate'],'l, d F Y \a\t H:i') }}
          @else
            {{ $data['module']::getDate($data['multi_dates'][$event_type]['startdate'],'l, d F Y') }} - All Day
          @endif
      @else
          @if (empty($event['all_day']))
            {{ $data['module']::getDate($data['multi_dates'][$event_type]['startdate'],'l, d F Y') }} to
            {{ $data['module']::getDate($data['multi_dates'][$event_type]['enddate'],'l, d F Y') }} at
            {{ $data['module']::getDate($data['multi_dates'][$event_type]['startdate'],'H:i') }} to
            {{ $data['module']::getDate($data['multi_dates'][$event_type]['enddate'],'H:i') }}
          @else
            {{ $data['module']::getDate($data['multi_dates'][$event_type]['startdate'],'l, d F Y') }} to
            {{ $data['module']::getDate($data['multi_dates'][$event_type]['enddate'],'l, d F Y') }} -
            All Day
          @endif

      @endif

  @if(!isset($data['url']))
      @if(!empty($data['location']))
        @if(isset($data['coordinates']))
            - <a href="#location-map">{{ $data['location'] }}</a>
        @else
            - {{ $data['location'] }}
        @endif
      @endif
  </p>
    <p>{{ $data['short_desc'] }}</p>

    <p>{{ $data['main_desc'] }}</p>

    @if(isset($data['coordinates']))

        @if(isset($data['location']))
            <h3 id="location-map">{{ $data['location'] }}</h3>
        @endif
        <div id="event-map"></div>
        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbsBU6J6ivi_YqZkc2XVeyU7hcbj_EHPE&sensor=false"></script>
        <script type="text/javascript">
            function initialize() {
                var myLatlng = new google.maps.LatLng({{ $data['coordinates'] }});
                var mapOptions = {
                    center: myLatlng,
                    zoom: 15
                };
                var map = new google.maps.Map(document.getElementById("event-map"), mapOptions);
                var eventMarker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    animation: google.maps.Animation.DROP
                });
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
    @endif
  @endif

@else
    <h2>Event not found</h2>
@endif


