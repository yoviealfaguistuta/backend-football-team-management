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
                                    <h1>Studi Kasus</h1>
                                    <p>
                                        Perusahaan XYZ merupakan sebuah perusahaan yang menaungi beberapa tim sepakbola amatir di
                                        Indonesia, perusahaan ini berencana membangun sebuah aplikasi berbasis android sederhana untuk
                                        mengelola tim-tim sepakbola yang dinaunginya. Saat ini pencatatan data tim sepak bola yang dimiliki
                                        oleh perusahaan XYZ masih dilakukan secara manual. Perusahaan XYZ meminta anda untuk
                                        membangun sebuah sistem backend API Endpoint menggunakan format respon JSON agar nantinya
                                        dapat dipakai oleh aplikasi android yang sedang dikembangkan
                                    </p>
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
                            <h6>Dalam Halaman Ini:</h6>
                            <nav class="list-unstyled doc_menu" id="navbar-example3">
                                <a href="#list" class="nav-link">List</a>
                                <a href="#create" class="nav-link">Create</a>
                                <a href="#update" class="nav-link">Update</a>
                                <a href="#delete" class="nav-link">Delete</a>
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