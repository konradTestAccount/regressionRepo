<?php
$i = 0;
?>
<div id="searchoptions-filters" class="ajax-load-area" data-ajaxloadalso='["calendar_events", "calendar_box","view_period_switchers", "view-switchers","calendar_page","jumptoform","searchoptions-categories","past_events","category-filters","searchoptions-generic"]'>
    <div class="event-filters" id="event-filters">
        <ul class="no-bullet">
          	@foreach ($data['categories'] as $parent_cat)
            	@if(array_key_exists($parent_cat['link'], $data['selections']))
                    <li class="category-filter event-filter filter-{{ $i++ }}  small primary"  data-category="{{ strtolower($parent_cat['link']) }}">{{ str_replace('>',': ', $parent_cat['link']) }} <span class="remove"><i class="fa fa-times"></i></span></li>
                @endif
                
                @if(!empty($parent_cat['categories']))
                    @foreach ($parent_cat['categories'] as $second_level_cats)
                        @if(array_key_exists($second_level_cats['link'], $data['selections']))
                            <li class="category-filter event-filter filter-{{ $i++ }}  small primary"  data-category="{{ strtolower($second_level_cats['link']) }}">{{ str_replace('>',': ', $second_level_cats['link']) }} <span class="remove"><i class="fa fa-times"></i></span></li>
                        @endif
                        @if(!empty($second_level_cats['categories']))
                            @foreach ($second_level_cats['categories'] as $third_level_cats)
                                @if(array_key_exists($third_level_cats['link'], $data['selections']))
                                    <li class="category-filter event-filter filter-{{ $i++ }}  small primary"  data-category="{{ strtolower($third_level_cats['link']) }}">{{ str_replace('>',': ', $third_level_cats['link']) }} <span class="remove"><i class="fa fa-times"></i></span></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif  
          	@endforeach
            @if (!empty($data['keywords']))
        		<li class="keywords-filter event-filter filter-{{ $i++ }}  small primary">{{ $data['keywords'] }} <span class="remove"><i class="fa fa-times"></i></span></li>
          	@endif
            @if ($data['module']::getConfig('default_past') != $data['past'])
                @if($data['module']::getConfig('default_past') == false)
                 <li class="past-filter event-filter filter-{{ $i++ }}  small primary" >Visible Past Events <span class="remove"><i class="fa fa-times"></i></span></li>
                @endif
                @if($data['module']::getConfig('default_past') == true)
                 <li class="past-filter event-filter filter-{{ $i++ }}  small primary" >Hidden Past Events <span class="remove"><i class="fa fa-times"></i></span></li>
                @endif
          	@endif
        </ul>
        <a href="{{$data['all_event_url']}}" class=" button primary small clear-filters {{ !$i ? 'is-hidden' : '' }} ajax-load-link">Clear Filters <i class="fa fa-chevron-right"></i></a>
    </div>
</div>

