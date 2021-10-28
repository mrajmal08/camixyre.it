<div class="newsletter-home3 space_bot_150 margin_top_80  space_top_130 BG">
    <h1 class="title-font capital title-newsletter text-center">{{ __('common.get_our_latest_update_in_your_email') }}</h1>
    <p class="des-font des-newsletter space_bot_40 text-center">{{ __('common.subscribe_to_our_newsletter') }}</p>

    @if(session()->has('subscribe_success'))
        <p class="text-success des-font des-newsletter text-center">
            {{session('subscribe_success')}}
        </p>
    @endif

    <p class="text-danger des-font des-newsletter text-center">{{ $errors->first('email') }}</p>

    <form class="form-group des-font flex" method="post" action="{{ route('newsletter.add', $lang) }}">
        @csrf
        <input type="email" name="email" class="form-control" placeholder="{{ __('common.enter_your_email') }}">
        <button type="submit" class="menu-font uppercase">{{ __('common.subscribe') }}</button>
    </form>
    
</div>