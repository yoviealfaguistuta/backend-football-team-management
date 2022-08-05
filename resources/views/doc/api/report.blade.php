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
                                    <h1>Report</h1>
                                    <p>Report berisi Endpoint untuk merangkum beberapa tabel dengan informasi yang dibutuhkan</p>
                                    <h6>Soal Nomor 5</h6>
                                    <p>
                                        data report yang menampilkan informasi hasil pertandingan berupa (jadwal pertandingan,
                                        tim home, tim away, skor akhir, status akhir pertandingan (Tim Home Menang/Tim Away
                                        Menang/ Draw), pemain dengan pencetak gol terbanyak, akumulasi total kemenangan tim
                                        home dari awal sampai dengan hasil pertandingan tersebut, akumulasi total kemenangan
                                        tim away dari awal sampai dengan hasil pertandingan tersebut)
                                    </p>
                                </div>
                                <div class="border_bottom"></div>
                            </article>
                            <article class="documentation_body" id="report">
                                <h4 class="c_head">Report <span class="badge bg-success ml-1">GET</span></h4>
                                <div class="highlight">
                                    <pre>
                                        <code class="language-htmlasc" data-lang="html">{{ env('BASE_URL') }}/report/4</code>
                                    </pre>
                                </div>
                                <p>Menampilkan rangkuman data dari beberapa tabel dengan informasi yang dibutuhkan</p>
                                <a class="toggle_btn" data-toggle="collapse" href="#lVhxosIk2Q" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Response 200 OK</a>
                                <div class="collapse multi-collapse" id="lVhxosIk2Q">
                                    <div class="card card-body toggle_body"> 
                                        <div class="highlight">
                                            <pre>
                                                <code class="language-html" data-lang="html">
                                                    {
                                                        "body": {
                                                            "id_jadwal_pertandingan": 4,
                                                            "id_tim_tuan_rumah": 3,
                                                            "id_tim_tamu": 2,
                                                            "nama_tim_tuan_rumah": "Manchester United",
                                                            "nama_tim_tamu": "Manchester City",
                                                            "logo_tim_tuan_rumah": "/assets/images/data/1659684690_1200px-Manchester_United_FC_crest.svg.png",
                                                            "logo_tim_tamu": "/assets/images/data/1659684897_Manchester_City_FC_badge.svg.png",
                                                            "hasil": [
                                                                {
                                                                    "id_jadwal_pertandingan": 4,
                                                                    "nama_pemain": "Kevin De Bruyne",
                                                                    "tipe": "1",
                                                                    "waktu": "12:14",
                                                                    "id_tim_pemain": 2,
                                                                    "nomor_punggung_pemain": 17,
                                                                    "tim": "Manchester City",
                                                                    "status_tim": "Tamu"
                                                                },
                                                                {
                                                                    "id_jadwal_pertandingan": 4,
                                                                    "nama_pemain": "Kevin De Bruyne",
                                                                    "tipe": "1",
                                                                    "waktu": "15:00",
                                                                    "id_tim_pemain": 2,
                                                                    "nomor_punggung_pemain": 17,
                                                                    "tim": "Manchester City",
                                                                    "status_tim": "Tamu"
                                                                },
                                                                {
                                                                    "id_jadwal_pertandingan": 4,
                                                                    "nama_pemain": "Kevin De Bruyne",
                                                                    "tipe": "1",
                                                                    "waktu": "12:20",
                                                                    "id_tim_pemain": 2,
                                                                    "nomor_punggung_pemain": 17,
                                                                    "tim": "Manchester City",
                                                                    "status_tim": "Tamu"
                                                                },
                                                                {
                                                                    "id_jadwal_pertandingan": 4,
                                                                    "nama_pemain": "Kevin De Bruyne",
                                                                    "tipe": "1",
                                                                    "waktu": "12:20",
                                                                    "id_tim_pemain": 2,
                                                                    "nomor_punggung_pemain": 17,
                                                                    "tim": "Manchester City",
                                                                    "status_tim": "Tamu"
                                                                },
                                                                {
                                                                    "id_jadwal_pertandingan": 4,
                                                                    "nama_pemain": "Kevin De Bruyne",
                                                                    "tipe": "1",
                                                                    "waktu": "12:20",
                                                                    "id_tim_pemain": 2,
                                                                    "nomor_punggung_pemain": 17,
                                                                    "tim": "Manchester City",
                                                                    "status_tim": "Tamu"
                                                                },
                                                                {
                                                                    "id_jadwal_pertandingan": 4,
                                                                    "nama_pemain": "Kevin De Bruyne",
                                                                    "tipe": "1",
                                                                    "waktu": "12:20",
                                                                    "id_tim_pemain": 2,
                                                                    "nomor_punggung_pemain": 17,
                                                                    "tim": "Manchester City",
                                                                    "status_tim": "Tamu"
                                                                },
                                                                {
                                                                    "id_jadwal_pertandingan": 4,
                                                                    "nama_pemain": "Luke Shaw",
                                                                    "tipe": "1",
                                                                    "waktu": "17:20",
                                                                    "id_tim_pemain": 3,
                                                                    "nomor_punggung_pemain": 23,
                                                                    "tim": "Manchester United",
                                                                    "status_tim": "Tuan Rumah"
                                                                },
                                                                {
                                                                    "id_jadwal_pertandingan": 4,
                                                                    "nama_pemain": "Kevin De Bruyne",
                                                                    "tipe": "1",
                                                                    "waktu": "15:20",
                                                                    "id_tim_pemain": 2,
                                                                    "nomor_punggung_pemain": 17,
                                                                    "tim": "Manchester City",
                                                                    "status_tim": "Tamu"
                                                                }
                                                            ],
                                                            "skor_tuan_rumah": 1,
                                                            "skor_tamu": 7,
                                                            "kartu_kuning": 0,
                                                            "kartu_merah": 0,
                                                            "total_skor_akhir": "Skor Tim Tuan Rumah: 1 - Skor Tim Tamu: 7",
                                                            "status_akhir_pertandingan": "Manchester City (Tamu) Menang",
                                                            "jumlah_gol": {
                                                                "Kevin De Bruyne": 7,
                                                                "Luke Shaw": 1
                                                            },
                                                            "gol_terbanyak": "Kevin De Bruyne mencetak gol terbanyak",
                                                            "detail_seluruh_kemenangan": [
                                                                {
                                                                    "id_jadwal_pertandingan": 4,
                                                                    "tuan_rumah": 0,
                                                                    "tamu": 1
                                                                },
                                                                {
                                                                    "id_jadwal_pertandingan": 5,
                                                                    "tuan_rumah": 0,
                                                                    "tamu": 1
                                                                }
                                                            ],
                                                            "total_seluruh_kemenangan_tuan_rumah": 0,
                                                            "total_seluruh_kemenangan_tamu": 2
                                                        },
                                                        "status": true,
                                                        "__type": "report"
                                                    }
                                                </code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                                <div class="border_bottom mt-5"></div>
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
                                <a href="#report" class="nav-link">Report</a>
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