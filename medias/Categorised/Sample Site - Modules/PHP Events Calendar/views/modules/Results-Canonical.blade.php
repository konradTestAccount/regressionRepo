{{--
 * Results - Canonical: Displays the prev, next and canonical link
--}}

{{--  Searching for the pagination array --}}
{{--  Note: Remember to update the domain URL --}}
@if(!empty($data['events']))
    @if(!empty($data['pagination']))
            @if(is_array($data['pagination']))
                @foreach ($data['pagination'] as $page)
                    @if ($page['text'] == "&rsaquo;" || $page['text'] == htmlentities ("›"))
                        <link rel="next" href="{{(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"}}{{$data['all_event_url']}}{{$page['href']}}">
                    @endif
                    @if ($page['text'] == "&lsaquo;" || $page['text'] == htmlentities("‹"))
                        <link rel="prev" href="{{(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"}}{{$data['all_event_url']}}{{$page['href']}}">
                    @endif
                    @if ($page['text'] == $data['param_page'])
                        <link rel="canonical" href="{{(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"}}{{$data['all_event_url']}}{{$page['href']}}">
                    @endif
                @endforeach
            @endif
    @elseif(isset($data['canonical_params']))
        <link rel="canonical" href="{{(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"}}{{$data['all_event_url']}}{{$data['canonical_params']}}">
    @endif
@elseif(isset($data['canonical_params']))
        <link rel="canonical" href="{{(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"}}{{$data['all_event_url']}}{{$data['canonical_params']}}">
@endif

