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
                            <article class="documentation_body" id="documentation">
                                <div class="shortcode_title">
                                    <h1>Authentication</h1>
                                    <p>Endpoint untuk tabel "admin"</p>
                                </div>
                                <div class="border_bottom"></div>
                            </article>
                            <article class="documentation_body" id="Login">
                                <h4 class="c_head">Login</h4>
                                <div class="highlight">
                                    <pre>
                                        <code class="language-htmlasc" data-lang="html">{{ env('BASE_URL') }}/login</code>
                                    </pre>
                                </div>
                                
                                <p>Login berisi Endpoint untuk mendapatkan sebuah "token" yang digunakan untuk mengakses seluruh Endpoint Private</p>
                                <a class="toggle_btn" data-toggle="collapse" href="#lVhxosIk2Q" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Response 200 OK</a>
                                <div class="collapse multi-collapse show" id="lVhxosIk2Q">
                                    <div class="card card-body toggle_body"> 
                                        <div class="highlight">
                                            <pre>
                                                <code class="language-html" data-lang="html">
                                                    {
                                                        "body": {
                                                            "token": "2|UPhthLXiwZHNuy83LASdkddXOubynOMhccd9t3eT",
                                                            "token_type": "Bearer"
                                                        },
                                                        "status": true,
                                                        "__type": "login"
                                                    }
                                                </code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                                <div class="border_bottom"></div>
                            </article>
                            <article class="documentation_body" id="profile">
                                <h4 class="c_head">Profile</h4>
                                <div class="highlight">
                                    <pre>
                                        <code class="language-htmlasc" data-lang="html">{{ env('BASE_URL') }}/user</code>
                                    </pre>
                                </div>
                                
                                <p>Profile berisi informasi Admin yang telah login berdasarkan "token" yang diberikan</p>
                                <a class="toggle_btn" data-toggle="collapse" href="#lVhxosIk2Q" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Response 200 OK</a>
                                <div class="collapse multi-collapse show" id="lVhxosIk2Q">
                                    <div class="card card-body toggle_body"> 
                                        <div class="highlight">
                                            <pre>
                                                <code class="language-html" data-lang="html">
                                                    {
                                                        "id": 3,
                                                        "id_perusahaan": 1,
                                                        "nama": "test",
                                                        "email": "test@gmail.com",
                                                        "soft_delete": false,
                                                        "created_at": null,
                                                        "updated_at": null
                                                    }
                                                </code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                                <div class="border_bottom"></div>
                            </article>
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
                            <h6>Dalam Halaman Ini:</h6>
                            <nav class="list-unstyled doc_menu" id="navbar-example3">
                                <a href="#login" class="nav-link">Login</a>
                                <a href="#profile" class="nav-link">Profile</a>
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