@include('frame.head')

<body data-spy="scroll" data-target="#navbar-example3" data-offset="86" data-scroll-animation="true" class="doc">
    <div class="body_wrapper">
        @include('frame.navbar-mobile')

        <section class="doc_documentation_area" id="sticky_doc">
            <div class="overlay_bg"></div>
            <div class="container custom_container">
                <div class="row">
                    <div class="col-lg-3 doc_mobile_menu display_none">
                        @include('frame.sidebar-left-desktop')
                    </div>
                    <div class="col-lg-7 col-md-8">
                        <div id="post" class="documentation_info">
                            <article class="documentation_body" id="getting-started">
                                <div class="shortcode_title">
                                    <h1>Getting Started</h1>
                                    <p><span>Welcome to Ayo Indonesia - Software Developer Technical Test !</span> Sistem ini dibuat untuk memenuhi syarat untuk lolos ke tahap berikutnya:</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="media documentation_item">
                                            <div class="icon">
                                                <img src="{{ url('img') }}/side-nav/terminals.png" alt="">
                                            </div>
                                            <div class="media-body">
                                                <a href="{{ route('studi-kasus') }}">
                                                    <h5>Studi Kasus</h5>
                                                </a>
                                                <p>Penjelasan mengenai masalah utama</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="media documentation_item">
                                            <div class="icon">
                                                <img src="{{ url('img') }}/side-nav/issuin.png" alt="">
                                            </div>
                                            <div class="media-body">
                                                <a href="{{ route('authentication') }}">
                                                    <h5>Authentication</h5>
                                                </a>
                                                <p>Endpoint untuk mengelola tabel "admin"</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="media documentation_item">
                                            <div class="icon">
                                                <img src="{{ url('img') }}/home_one/icon/android.png" alt="">
                                            </div>
                                            <div class="media-body">
                                                <a href="{{ route('perusahaan') }}">
                                                    <h5>Perusahaan</h5>
                                                </a>
                                                <p>Endpoint untuk mengelola tabel "perusahaan"</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="media documentation_item">
                                            <div class="icon">
                                                <img src="{{ url('img') }}/home_one/icon/smartphone.png" alt="">
                                            </div>
                                            <div class="media-body">
                                                <a href="{{ route('tim') }}">
                                                    <h5>Tim</h5>
                                                </a>
                                                <p>Endpoint untuk mengelola tabel "tim"</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="media documentation_item">
                                            <div class="icon">
                                                <img src="{{ url('img') }}/home_one/icon/management.png" alt="">
                                            </div>
                                            <div class="media-body">
                                                <a href="{{ route('pemain') }}">
                                                    <h5>Pemain</h5>
                                                </a>
                                                <p>Endpoint untuk mengelola tabel "perusahaan"</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="media documentation_item">
                                            <div class="icon">
                                                <img src="{{ url('img') }}/home_one/icon/newspaper.png" alt="">
                                            </div>
                                            <div class="media-body">
                                                <a href="{{ route('jadwal-pertandingan') }}">
                                                    <h5>Jadwal Pertandingan</h5>
                                                </a>
                                                <p>Endpoint untuk mengelola tabel "jadwal_pertandingan"</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="media documentation_item">
                                            <div class="icon">
                                                <img src="{{ url('img') }}/home_one/icon/smartphone.png" alt="">
                                            </div>
                                            <div class="media-body">
                                                <a href="{{ route('hasil-pertandingan') }}">
                                                    <h5>Hasil Pertandingan</h5>
                                                </a>
                                                <p>Endpoint untuk mengelola tabel "hasil_pertandingan"</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="media documentation_item">
                                            <div class="icon">
                                                <img src="{{ url('img') }}/side-nav/issuin.png" alt="">
                                            </div>
                                            <div class="media-body">
                                                <a href="{{ route('report') }}">
                                                    <h5>Report</h5>
                                                </a>
                                                <p>Endpoint untuk merangkum informasi yang dibutuhkan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border_bottom"></div>
                            </article>
                            <div class="border_bottom"></div>
                            @include('frame.footer')
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 doc_right_mobile_menu">
                        <div class="open_icon" id="right">
                            <i class="arrow_carrot-left"></i>
                            <i class="arrow_carrot-right"></i>
                        </div>
                        <div class="doc_rightsidebar scroll mCustomScrollbar _mCS_3"><div id="mCSB_3" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;"><div id="mCSB_3_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
                            <div id="font-switcher" class="d-flex justify-content-between align-items-center">
                                <div id="rvfs-controllers" class="fontsize-controllers group"><div class="btn-group"><a href="#" class="rvfs-decrease btn" title="Decrease font size">A-</a><a href="#" class="rvfs-reset btn disabled" title="Default font size">A</a><a href="#" class="rvfs-increase btn" title="Increase font size">A+</a></div></div>
                                <a href="javascript:window.print()" class="print"><i class="icon_printer"></i></a>
                            </div>
                            <div class="doc_switch">
                                <label for="something" class="tab-btn tab-btns"><i class="icon_lightbulb_alt"></i></label>
                                <input type="checkbox" name="something" id="something" class="tab_switcher">
                                <label for="something" class="tab-btn"><i class="far fa-moon"></i></label>
                            </div>
                            <h6>On this page:</h6>
                            <nav class="list-unstyled doc_menu" id="navbar-example3">
                                <a href="#getting-started" class="nav-link">Getting Started</a>
                            </nav>
                        </div><div id="mCSB_3_scrollbar_vertical" class="mCSB_scrollTools mCSB_3_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_3_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 223px; max-height: 240px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('frame.script')
</body>

</html>