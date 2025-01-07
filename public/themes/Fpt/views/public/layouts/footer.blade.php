<footer>
    <div class="footer">
        <div class="footer_top">
            <div class="footer_top-img">
                <a href="/"><img src="{{ $footerLogo->path }}" alt="footer logo"></a>
            </div>
            <div class="icon_netword">
                <ul>
                    <li><a href=""><img src="{{ v(Theme::url('assets/img/icon/foot-hifpt1.png')) }}" alt=""></a></li>
                    <li><a href="{{ setting('fpt_youtube_link') }}"><img src="{{ v(Theme::url('assets/img/icon/foot-youtube1.png')) }}" alt=""></a></li>
                    <li><a href="{{ setting('fpt_instagram_link') }}"><img src="{{ v(Theme::url('assets/img/icon/foot-instagram1.png')) }}" alt=""></a></li>
                    <li><a href="{{ setting('fpt_zalo_link') }}"><img src="{{ v(Theme::url('assets/img/icon/foot-zalo1.png')) }}" alt=""></a></li>
                    <li><a href="{{ setting('fpt_facebook_link') }}"><img src="{{ v(Theme::url('assets/img/icon/foot-facebook1.png')) }}" alt=""></a></li>
                </ul>
            </div>
        </div>
        <div class="footer_bt">
            <div class="footer_right">
                {!! setting('fpt_footer_right') !!}
                <div class="online-gov-vn">
                    <a href="{{ setting('fpt_footer_noticed_gov_url') }}" target="_blank" class="img">
                        <img alt="FPT Telecom" src="{{ $noticeGovImage->path }}">
                    </a>
                </div>
            </div>
            <div class="footer_left footer_lefft-mb">
                @foreach($footerMenu->menus() as $menuItem)
                    <div class="footer_col">
                        <input type="checkbox" name="accordion-1" id="cb36" checked="">
                        <label for="cb36" class="tab__label">{{ $menuItem->name() }}</label>
                        <div class="tab__content">
                            <ul>
                                @foreach($menuItem->subMenus() as $subMenuItem)
                                    <li><a href="{{ $subMenuItem->url() }}" title="Giới thiệu chung">{{ $subMenuItem->name() }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="footer_left footer_lefft-destop">
                @foreach($footerMenu->menus() as $menuItem)
                    <div class="footer_col">
                        <div class="footer_menu-title">
                            <h4>{{ $menuItem->name() }}</h4>
                        </div>
                        <ul class="link-footer">
                            @foreach($menuItem->subMenus() as $subMenuItem)
                                <li>
                                    <a href="{{ $subMenuItem->url() }}" title="Giới thiệu chung">
                                        {{ $subMenuItem->name() }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="footer_mb" style="display: none;">
            <div class="icon_netword">
                <ul>
                    <li><a href=""><img src="{{ v(Theme::url('assets/img/icon/foot-hifpt1.png')) }}" alt=""></a></li>
                    <li><a href="{{ setting('fpt_youtube_link') }}"><img src="{{ v(Theme::url('assets/img/icon/foot-youtube1.png')) }}" alt=""></a></li>
                    <li><a href="{{ setting('fpt_instagram_link') }}"><img src="{{ v(Theme::url('assets/img/icon/foot-instagram1.png')) }}" alt=""></a></li>
                    <li><a href="{{ setting('fpt_zalo_link') }}"><img src="{{ v(Theme::url('assets/img/icon/foot-zalo1.png')) }}" alt=""></a></li>
                    <li><a href="{{ setting('fpt_facebook_link') }}"><img src="{{ v(Theme::url('assets/img/icon/foot-facebook1.png')) }}" alt=""></a></li>
                </ul>
            </div>
            <div class="online-gov-vn">
                <a href="{{ setting('fpt_footer_noticed_gov_url') }}" target="_blank" class="img">
                    <img alt="FPT Telecom" src="{{ $noticeGovImage->path }}">
                </a>
            </div>
        </div>
    </div>
</footer>
<div class="box_contact-scroll">
    <div class="scroll_contact">
        <ul>
            <li class="zalo"><a target="_blank" href="{{setting('fpt_contact_zalo')}}"><img src="{{ v(Theme::url('assets/img/icon/zalo-icon.png')) }}" alt="zalo"></a></li>
            <li class="cart messenger"><a href="{{setting('fpt_contact_messenger')}}"><img src="{{ v(Theme::url('assets/img/icon/icon-face-new.png')) }}" alt="Messenger"></a></li>
{{--            <li class="chat"><a target="_blank" href="{{setting('fpt_contact_zalo')}}"><img src="{{ v(Theme::url('assets/img/icon/icon-live-chat-new.png')) }}" alt="Chat"></a></li>--}}
            <li class="call"><a href="tel:{{setting('fpt_contact_phone')}}"><img src="{{ v(Theme::url('assets/img/icon/icon-call-new.png')) }}" alt="Phone Contact"></a></li>
        </ul>
    </div>
    <div class="croll-top">
        <a href="#"><img src="{{ v(Theme::url('assets/img/top.svg')) }}" alt="scroll to top"></a>
    </div>
</div>