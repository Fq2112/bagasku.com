@extends('layouts.mst')
@section('title', 'Cara Kerja | '.env('APP_TITLE'))
@push('styles')
    <style>
        .breadcrumbs {
            background-image: url({{asset('images/slider/tentang.jpg')}});
        }

        .cara-kerja {
            display: flex;
            width: 860px;
            margin: 1em auto 0;
        }

        .cara-kerja > * {
            padding: 20px 25px;
        }

        .table-of-contents {
            position: relative;
            flex-basis: 260px;
            background: #f5f5f5;
        }

        .table-of-contents p {
            text-transform: uppercase;
            letter-spacing: 0.125em;
            color: #555;
        }

        .table-of-contents ul {
            position: fixed;
            /* Chrome (asshole) */
            position: sticky;
            /* Firefox */
            margin-top: 2em;
            top: 4em;
        }

        h1:first-child {
            margin-top: 0;
        }

        .post-content {
            flex-basis: 600px;
            max-width: 100%;
        }

        /* TOC part */

        .table-of-contents svg {
            position: absolute;
            left: 0;
            top: 50%;
            bottom: auto;
            display: none;
            stroke: #122752;
            transform: translateY(-50%);
        }

        .toc-reading svg {
            display: block;
        }

        .table-of-contents ul {
            width: 200px;
            counter-reset: articles;
            padding: 0;
        }

        .table-of-contents li {
            display: block;
            counter-increment: articles;
        }

        .table-of-contents li + li {
            margin-top: 2em;
        }

        .table-of-contents a {
            display: block;
            padding: 0 1.1em 0 3.2em;
            position: relative;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        a.toc-reading,
        a.toc-already-read.toc-reading {
            color: #122752;
            opacity: 1;
        }

        a.toc-already-read {
            opacity: 0.4;
        }

        .table-of-contents a:before {
            content: counter(articles, decimal);
            position: absolute;
            bottom: auto;
            left: 0;
            top: 50%;
            width: 36px;
            height: 36px;
            line-height: 34px;
            text-align: center;
            transform: translateY(-50%);
            transition: background-color 0.3s ease 0s, color 0.3s ease 0s;
            border-radius: 50%;
            box-shadow: 0 0 0 1px #d9d9d9 inset;
            color: #4d4d4d;
        }
    </style>
@endpush
@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-overlay"></div>
        <div class="page-title">
            <h2>Cara Kerja</h2>
            <p>Anda ingin tahu lebih banyak tentang cara kerja {{env('APP_NAME')}}?</p>
        </div>
        <ul class="crumb">
            <li><a href="{{route('beranda')}}"><i class="fa fa-home"></i></a></li>
            <li><a href="{{route('beranda')}}"><i class="fa fa-angle-double-right"></i> Beranda</a></li>
            <li><a href="#" onclick="goToAnchor()"><i class="fa fa-angle-double-right"></i> Cara Kerja</a></li>
        </ul>
    </div>

    <section class="none-padding">
        <div class="cara-kerja">
            <aside class="table-of-contents">
                <!-- will be generated with JS -->
            </aside>
            <main class="post-content">
                <h1>Table of content with progress bar</h1>
                <p>The best web to build this kind of Table Of Content is using JS. Editor will just have to be focus on
                    his main task: writing.</p>

                <h2>How to build it</h2>
                <p>First at all, you need to see this pen in Edit Mode to watch the code, then, Lorem ipsum dolor sit
                    amet, consectetur adipisicing elit. Dolore nesciunt facere ullam amet tempora voluptatum molestiae
                    inventore asperiores ad itaque architecto consectetur, expedita nulla at perspiciatis velit
                    excepturi blanditiis doloribus.</p>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, neque aperiam eum. Libero ut saepe ab
                    numquam sed, quia enim quisquam maxime amet vero. Vitae quasi quidem doloremque eos. Quod! Lorem
                    ipsum dolor sit amet, consectetur adipisicing elit. Enim in, ex, ad non at quibusdam quaerat. Iste
                    deserunt dolor assumenda deleniti quam, qui vitae exercitationem, neque rerum voluptate sunt
                    quo!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem nobis eius reprehenderit vel ad
                    quisquam. Accusamus quia, modi doloribus rerum voluptatum debitis dolorem placeat cupiditate itaque,
                    animi suscipit deserunt explicabo.</p>

                <h2>Lorem ipsum dolor sit</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit enim modi cumque porro non beatae
                    autem, ea ab dolor delectus ipsum reiciendis a aliquid error, necessitatibus, unde aperiam corporis
                    facere. Optio distinctio ipsam mollitia nobis sit explicabo quod magni quas tempore aperiam in est
                    at, molestiae maiores veritatis impedit dolore adipisci voluptate, expedita soluta! Architecto
                    officia, omnis nulla sint iure laboriosam ea? Repellendus molestias amet eius libero dolorem tempore
                    nihil omnis ullam velit dolores expedita eum accusantium pariatur voluptates quaerat, modi
                    dignissimos laudantium quod odit. Earum dignissimos eos at corporis debitis tempore ea molestiae
                    illum, obcaecati amet incidunt ratione tenetur natus, modi culpa. Dolor excepturi quas sunt itaque
                    cum nihil pariatur atque dolorum doloremque officia ea enim doloribus inventore laudantium maiores
                    dolores, velit, fugiat facere officiis architecto. Explicabo distinctio aut quidem ex quod
                    cupiditate delectus, expedita velit accusantium, ratione, illum doloribus cum. Aspernatur explicabo,
                    fugit quaerat, reiciendis soluta ratione cum, dolore quasi sint consequatur facere ipsa. Eos illo
                    nam natus! Perspiciatis hic impedit, sed culpa tenetur id, quibusdam harum expedita nostrum, nihil
                    itaque. Fugit, incidunt, minus! Voluptatibus aut optio neque delectus sapiente eos totam veritatis
                    minima cupiditate saepe odit, ratione hic veniam mollitia, quasi. Laborum eos nesciunt maxime sequi
                    unde.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur at cumque aut eos autem dolorem
                    quibusdam hic accusantium officiis sunt fugiat laboriosam quasi commodi doloribus laborum assumenda,
                    culpa optio magni minus provident vel ut explicabo voluptas? Eaque consequuntur neque a illum,
                    voluptatem at accusantium ipsa provident nulla, quia quasi iusto.</p>

                <h2>Et voilàààà!</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit enim modi cumque porro non beatae
                    autem, ea ab dolor delectus ipsum reiciendis a aliquid error, necessitatibus, unde aperiam corporis
                    facere. Optio distinctio ipsam mollitia nobis sit explicabo quod magni quas tempore aperiam in est
                    at, molestiae maiores veritatis impedit dolore adipisci voluptate, expedita soluta! Architecto
                    officia, omnis nulla sint iure laboriosam ea? Repellendus molestias amet eius libero dolorem tempore
                    nihil omnis ullam velit dolores expedita eum accusantium pariatur voluptates quaerat, modi
                    dignissimos laudantium quod odit. Earum dignissimos eos at corporis debitis tempore ea molestiae
                    illum, obcaecati amet incidunt ratione tenetur natus, modi culpa. Dolor excepturi quas sunt itaque
                    cum nihil pariatur atque dolorum doloremque officia ea enim doloribus inventore laudantium maiores
                    dolores, velit, fugiat facere officiis architecto. Explicabo distinctio aut quidem ex quod
                    cupiditate delectus, expedita velit accusantium, ratione, illum doloribus cum. Aspernatur explicabo,
                    fugit quaerat, reiciendis soluta ratione cum, dolore quasi sint consequatur facere ipsa. Eos illo
                    nam natus! Perspiciatis hic impedit, sed culpa tenetur id, quibusdam harum expedita nostrum, nihil
                    itaque. Fugit, incidunt, minus! Voluptatibus aut optio neque delectus sapiente eos totam veritatis
                    minima cupiditate saepe odit, ratione hic veniam mollitia, quasi. Laborum eos nesciunt maxime sequi
                    unde.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur at cumque aut eos autem dolorem
                    quibusdam hic accusantium officiis sunt fugiat laboriosam quasi commodi doloribus laborum assumenda,
                    culpa optio magni minus provident vel ut explicabo voluptas? Eaque consequuntur neque a illum,
                    voluptatem at accusantium ipsa provident nulla, quia quasi iusto.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur at cumque aut eos autem dolorem
                    quibusdam hic accusantium officiis sunt fugiat laboriosam quasi commodi doloribus laborum assumenda,
                    culpa optio magni minus provident vel ut explicabo voluptas? Eaque consequuntur neque a illum,
                    voluptatem at accusantium ipsa provident nulla, quia quasi iusto.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur at cumque aut eos autem dolorem
                    quibusdam hic accusantium officiis sunt fugiat laboriosam quasi commodi doloribus laborum assumenda,
                    culpa optio magni minus provident vel ut explicabo voluptas? Eaque consequuntur neque a illum,
                    voluptatem at accusantium ipsa provident nulla, quia quasi iusto.</p>
            </main>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        var positions = [],
            build_toc = function () {
                var output = "<p>Table of content</p><ul>",
                    svg =
                        '<svg viewBox="0 0 36 36" height="36px" width="36px" y="0px" x="0px"><circle transform="rotate(-90 18 18)" stroke-dashoffset="100" stroke-dasharray="100 100" r="16" cy="18" cx="18" stroke-width="2" fill="none"/></svg>';

                $(".post-content")
                    .find("h2")
                    .each(function (i) {
                        $(this).attr("id", "title_" + i);

                        output +=
                            '<li><a href="#title_' +
                            i +
                            '" class="toc-title_' +
                            i +
                            '">' +
                            svg +
                            $(this).text() +
                            "</a></li>";
                    });

                return output;
            },
            get_bottom_off_content = function () {
                var $content = $(".post-content"),
                    offset = $content.offset();

                return $content.outerHeight() + offset.top;
            },
            get_positions = function () {
                $(".post-content")
                    .find("h2")
                    .each(function (i) {
                        offset = $(this).offset();
                        positions["title_" + i] = offset.top;
                    });
                return positions;
            },
            set_toc_reading = function () {
                var st = $(document).scrollTop(),
                    count = 0;

                for (var k in positions) {
                    var n = parseInt(k.replace("title_", ""));
                    (has_next = typeof positions["title_" + (n + 1)] !== "undefined"),
                        (not_next =
                            has_next && st < positions["title_" + (n + 1)] ? true : false),
                        (diff = 0),
                        ($link = $(".toc-" + k));

                    if (has_next) {
                        diff =
                            ((st - positions[k]) /
                                (positions["title_" + (n + 1)] - positions[k])) *
                            100;
                    } else {
                        diff =
                            ((st - positions[k]) / (get_bottom_off_content() - positions[k])) *
                            100;
                    }

                    $link.find("circle").attr("stroke-dashoffset", Math.round(100 - diff));

                    if (st >= positions[k] && not_next && has_next) {
                        $(".toc-" + k).addClass("toc-reading");
                    } else if (st >= positions[k] && !not_next && has_next) {
                        $(".toc-" + k).removeClass("toc-reading");
                    } else if (st >= positions[k] && !not_next && !has_next) {
                        $(".toc-" + k).addClass("toc-reading");
                    }

                    if (st >= positions[k]) {
                        $(".toc-" + k).addClass("toc-already-read");
                    } else {
                        $(".toc-" + k).removeClass("toc-already-read");
                    }

                    if (st < positions[k]) {
                        $(".toc-" + k).removeClass("toc-already-read toc-reading");
                    }

                    count++;
                }
            };

        // build our table of content
        $(".table-of-contents").html(build_toc());

        // first definition of positions
        get_positions();

        // on resize, re-calc positions
        $(window).on("resize", function () {
            get_positions();
        });

        $(document).on("scroll", function () {
            set_toc_reading();
        });

        function goToAnchor() {
            $('html,body').animate({scrollTop: $(".about-us").offset().top}, 500);
        }
    </script>
@endpush
