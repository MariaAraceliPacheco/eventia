<style>
    /* From Uiverse.io by srinivasaiml */
    /* SCOPED WRAPPER */
    .ui-404-wrapper {
        width: 100%;
        min-height: 600px;
        background: #f2fdfd;
        /* brand background */
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: "Roboto Condensed", sans-serif;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }

    /* Fixed Container - Maintains Aspect Ratio */
    .ui-404-wrapper .container {
        position: relative;
        width: 100%;
        max-width: 750px;
        aspect-ratio: 750 / 600;
    }

    .ui-404-wrapper svg {
        display: block;
        width: 100%;
        height: 100%;
        overflow: visible;
    }

    /* SVG TEXT STYLING */
    .ui-404-wrapper text {
        font-family: "Roboto Condensed", sans-serif;
        text-transform: uppercase;
        fill: #020d0c;
        /* brand text-main */
        opacity: 0;
        transform-box: fill-box;
        transform-origin: center;
        dominant-baseline: hanging;
        animation: ui-404-popIn 1s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    /* Text Specifics */
    .ui-404-wrapper .textA {
        font-size: 15px;
        transform: rotate(-3deg) scale(0);
        --rotate: -3deg;
        animation-delay: 0.5s;
    }

    .ui-404-wrapper .textB {
        font-weight: 700;
        font-size: 115px;
        transform: rotate(-2deg) scale(0);
        --rotate: -2deg;
        animation-delay: 0.6s;
    }

    .ui-404-wrapper .textC {
        font-size: 20px;
        transform: rotate(1deg) scale(0);
        --rotate: 1deg;
        cursor: pointer;
        animation-delay: 0.7s;
        transition:
            fill 0.3s ease,
            transform 0.3s ease;
    }

    /* Hover effect for the link */
    .ui-404-wrapper .link-group:hover .textC {
        fill: #ea57de;
        /* brand accent */
        transform: rotate(1deg) scale(1.1);
    }

    /* SVG GRAPHIC ANIMATIONS */
    .ui-404-wrapper .box {
        transform-origin: 50% 50%;
        transform: scale(0);
        animation: ui-404-elastic 1.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    .ui-404-wrapper .spin-circles {
        transform-origin: 41% 30%;
        animation: ui-404-spin 8s linear infinite;
    }

    .ui-404-wrapper .sq-bottom,
    .ui-404-wrapper .sq-top {
        stroke-dasharray: 400;
        stroke-dashoffset: 400;
        animation: ui-404-draw 1.5s ease-out forwards;
        animation-delay: 1s;
    }

    .ui-404-wrapper .tri-dots,
    .ui-404-wrapper .dots-bottom,
    .ui-404-wrapper .dots-top,
    .ui-404-wrapper .big-white-circle,
    .ui-404-wrapper .grow-crosshairs,
    .ui-404-wrapper .left-lines,
    .ui-404-wrapper .top-triangles,
    .ui-404-wrapper .bottom-triangles {
        opacity: 0;
        animation: ui-404-fadeIn 1s ease-out forwards;
        animation-delay: 1.2s;
    }

    .ui-404-wrapper .grow-circles circle {
        transform-origin: center;
        animation: ui-404-pulse 2s ease-in-out infinite alternate;
    }

    .ui-404-wrapper .grow-circles circle:nth-child(odd) {
        animation-delay: 0s;
    }

    .ui-404-wrapper .grow-circles circle:nth-child(even) {
        animation-direction: alternate-reverse;
    }

    /* KEYFRAMES */
    @keyframes ui-404-elastic {
        0% {
            transform: scale(0);
        }

        100% {
            transform: scale(1);
        }
    }

    @keyframes ui-404-popIn {
        0% {
            opacity: 0;
            transform: rotate(var(--rotate)) scale(0);
        }

        100% {
            opacity: 1;
            transform: rotate(var(--rotate)) scale(1);
        }
    }

    @keyframes ui-404-fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes ui-404-spin {
        100% {
            transform: rotate(2deg);
        }
    }

    @keyframes ui-404-draw {
        to {
            stroke-dashoffset: 0;
        }
    }

    @keyframes ui-404-pulse {
        0% {
            transform: scale(0.8);
        }

        100% {
            transform: scale(1.2);
        }
    }

    body {
        background-color: #f2fdfd;
        /* brand background */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
</style>

<!-- From Uiverse.io by srinivasaiml -->

<body>
    <div class="ui-404-wrapper">
        <div class="container">
            <svg class="page-not-found" viewBox="0 0 750 600">
                <title>Page Not Found</title>

                <g transform="scale(0.5859375)">
                    <g class="tri-dots">
                        <circle cx="406.1" cy="890.7" r="3.5" transform="translate(-361.3 283) rotate(-27.1)"
                            style="fill: #ffe029"></circle>
                        <circle cx="426.2" cy="878.8" r="3.7" transform="translate(-353.7 290.8) rotate(-27.1)"
                            style="fill: #ffe029"></circle>
                        <circle cx="424.4" cy="861.8" r="3.7" transform="translate(-346.1 288.1) rotate(-27.1)"
                            style="fill: #ffe029"></circle>
                        <circle cx="445.8" cy="867.7" r="3.7" transform="translate(-346.5 298.5) rotate(-27.1)"
                            style="fill: #ffe029"></circle>
                        <circle cx="438.3" cy="851.8" r="3.7" transform="translate(-340.1 293.4) rotate(-27.1)"
                            style="fill: #ffe029"></circle>
                        <circle cx="453.8" cy="845.8" r="3.7" transform="translate(-335.6 299.8) rotate(-27.1)"
                            style="fill: #ffe029"></circle>
                        <circle cx="589.7" cy="797.2" r="3.7" transform="translate(-298.5 356.4) rotate(-27.1)"
                            style="fill: #ffe029"></circle>
                        <circle cx="590" cy="782.3" r="3.7" transform="translate(-291.7 354.8) rotate(-27.1)"
                            style="fill: #ffe029"></circle>
                        <circle cx="608.2" cy="784.4" r="3.7" transform="translate(-290.7 363.4) rotate(-27.1)"
                            style="fill: #ffe029"></circle>
                        <circle cx="612.4" cy="765.8" r="3.7" transform="translate(-281.7 363.2) rotate(-27.1)"
                            style="fill: #ffe029"></circle>
                        <circle cx="627.4" cy="776" r="3.7" transform="translate(-284.7 371.2) rotate(-27.1)"
                            style="fill: #ffe029"></circle>
                        <circle cx="630.6" cy="758.5" r="3.7" transform="translate(-276.4 370.8) rotate(-27.1)"
                            style="fill: #ffe029"></circle>
                    </g>

                    <g class="spin-circles">
                        <path d="M776.3,403.3A151,151,0,0,1,989.8,189.8"
                            style="fill: none;stroke: #25e4ce;stroke-miterlimit: 10;stroke-width: 8px"></path>
                        <path d="M989.8,189.8A151,151,0,0,1,776.3,403.3"
                            style="fill: none;stroke: #fff;stroke-miterlimit: 10;stroke-width: 2px"></path>
                        <path d="M786.9,392.7c-53-53-52.8-138.9.3-192.1s139.1-53.2,192.1-.3"
                            style="fill: none;stroke: #25e4ce;stroke-miterlimit: 10;stroke-width: 8px"></path>
                        <path d="M979.2,200.4c53,53,52.8,138.9-.3,192.1s-139.1,53.2-192.1.3"
                            style="fill: none;stroke: #fff;stroke-miterlimit: 10;stroke-width: 2px"></path>
                        <path d="M797.5,382.1c-46.9-46.9-46.7-123.3.6-170.6s123.6-47.5,170.6-.6"
                            style="fill: none;stroke: #25e4ce;stroke-miterlimit: 10;stroke-width: 8px"></path>
                        <path d="M968.6,211c46.9,46.9,46.7,123.3-.6,170.6s-123.6,47.5-170.6.6"
                            style="fill: none;stroke: #fff;stroke-miterlimit: 10;stroke-width: 2px"></path>
                        <path d="M808.1,371.5c-40.9-40.9-40.6-107.7.8-149.1s108.1-41.8,149.1-.8"
                            style="fill: none;stroke: #25e4ce;stroke-miterlimit: 10;stroke-width: 8px"></path>
                        <path d="M958,221.6c40.9,40.9,40.6,107.7-.8,149.1s-108.1,41.8-149.1.8"
                            style="fill: none;stroke: #fff;stroke-miterlimit: 10;stroke-width: 2px"></path>
                        <path d="M818.7,360.9c-34.9-34.9-34.4-92,1.1-127.6s92.7-36,127.6-1.1"
                            style="fill: none;stroke: #25e4ce;stroke-miterlimit: 10;stroke-width: 8px"></path>
                        <path d="M947.4,232.2c34.9,34.9,34.4,92-1.1,127.6s-92.7,36-127.6,1.1"
                            style="fill: none;stroke: #fff;stroke-miterlimit: 10;stroke-width: 2px"></path>
                    </g>

                    <g class="big-white-circle">
                        <circle cx="644" cy="482" r="277" style="fill: #fff"></circle>
                    </g>

                    <g class="grow-circles">
                        <circle cx="940" cy="523" r="27" style="fill: #ffe029"></circle>
                        <circle cx="708.5" cy="217.6" r="14.5" transform="translate(-21.2 87.8) rotate(-7)"
                            style="fill: #25e4ce"></circle>
                        <circle cx="725.5" cy="755.6" r="14.5" transform="translate(-86.5 93.8) rotate(-7)"
                            style="fill: #ea57de"></circle>
                        <circle cx="446.9" cy="181.6" r="16.5" transform="translate(-18.8 55.7) rotate(-7)"
                            style="fill: #25e4ce"></circle>
                        <circle cx="314.9" cy="348.6" r="16.5" transform="translate(-40.1 40.9) rotate(-7)"
                            style="fill: #ea57de"></circle>
                        <circle cx="682.6" cy="187.5" r="7.5" transform="translate(-17.7 84.4) rotate(-7)"
                            style="fill: #ea57de"></circle>
                        <circle cx="328.5" cy="500.6" r="7.5" transform="translate(-58.4 43.7) rotate(-7)"
                            style="fill: #fff"></circle>
                        <circle cx="364" cy="439" r="27" style="fill: #ffe029"></circle>
                    </g>

                    <g class="box">
                        <polygon class="main-container"
                            points="364.4 328.1 888.1 292.8 889.1 635 453.7 698.2 364.4 328.1"
                            style="fill: #fff;stroke: #020d0c;stroke-miterlimit: 10;stroke-width: 24px"></polygon>
                        <polygon points="395 285.6 762 258.9 732.7 336.1 431.6 350.2 395 285.6" style="fill: #ffe029">
                        </polygon>
                        <polygon points="709.7 622 933.7 622.3 960.9 662.9 931.9 700.1 708.7 699.4 709.7 622"
                            style="fill: #ffe029"></polygon>
                    </g>

                    <g class="bottom-triangles">
                        <path
                            d="M646.6,741.1,476.8,822.7a8.6,8.6,0,0,1-12.3-8.4l14.3-187.9c.5-6.2,8.4-10,13.5-6.5L647.8,726.2a8.6,8.6,0,0,1-1.1,14.9ZM482.8,800.6,625.7,732,494.8,642.5Z"
                            style="fill: #ea57de"></path>
                        <polygon points="548.3 732.9 520.4 628.4 687 671 548.3 732.9" style="fill: #25e4ce"></polygon>
                    </g>

                    <g class="squiggles">
                        <g class="squiggle-bottom">
                            <path class="sq-bottom"
                                d="M798,749.1c2.9.1,5.5,2.1,7.1,4.6a33.5,33.5,0,0,1,3.5,8,116.3,116.3,0,0,0,8.3,18.8,7.5,7.5,0,0,0,3,3.4,5.8,5.8,0,0,0,5.1-.5c9.5-5.2,15.4-15.3,24.5-21.2,2.2-1.5,4.9-2.7,7.5-2a9.3,9.3,0,0,1,4.6,3.7c5.8,7.7,7.9,17.5,11.4,26.4,1.1,2.8,2.7,5.8,5.6,6.4s5-1.1,7-2.7c7.9-6.5,14.4-14.7,23-20.3,1.6-1.1,3.5-2.1,5.4-1.7s3.4,2.2,4.6,3.9a67.9,67.9,0,0,1,8.5,18.2c.9,3.2,1.7,6.6,3.5,9.4s5.1,5,8.4,4.5"
                                style="fill: none;stroke: #25e4ce;stroke-linecap: round;stroke-miterlimit: 10;stroke-width: 12px">
                            </path>
                            <g class="dots-bottom">
                                <circle cx="802.6" cy="727.5" r="1.6" style="fill: #fff"></circle>
                                <circle cx="799.1" cy="734.8" r="1.5" style="fill: #fff"></circle>
                                <circle cx="809.6" cy="734.3" r="1.6" style="fill: #fff"></circle>
                            </g>
                        </g>
                        <g class="squiggle-top">
                            <path class="sq-top"
                                d="M403.3,245.7c-3.3.5-6.6-1.7-8.4-4.5s-2.6-6.2-3.5-9.4a67.9,67.9,0,0,0-8.5-18.2c-1.1-1.7-2.6-3.5-4.6-3.9s-3.8.6-5.4,1.7c-8.5,5.6-15,13.9-23,20.3-2,1.6-4.5,3.3-7,2.7s-4.5-3.6-5.6-6.4c-3.5-9-5.6-18.7-11.4-26.4a9.3,9.3,0,0,0-4.6-3.7c-2.6-.7-5.3.5-7.5,2-9.1,5.9-15,16-24.5,21.2a5.8,5.8,0,0,1-5.1.5,7.5,7.5,0,0,1-3-3.4,116.3,116.3,0,0,1-8.3-18.8,33.5,33.5,0,0,0-3.5-8c-1.6-2.4-4.2-4.4-7.1-4.6"
                                style="fill: none;stroke: #ea57de;stroke-linecap: round;stroke-miterlimit: 10;stroke-width: 12px">
                            </path>
                            <g class="dots-top">
                                <circle cx="389" cy="270.1" r="1.5"
                                    transform="matrix(0.03, -1, 1, 0.03, 106.66, 650.38)" style="fill: #fff"></circle>
                                <circle cx="392.7" cy="263.2" r="1.5" transform="translate(117.1 647.4) rotate(-88.2)"
                                    style="fill: #fff"></circle>
                            </g>
                        </g>
                    </g>

                    <g class="grow-crosshairs">
                        <path
                            d="M983.1,582.2h-9v-9a5.9,5.9,0,0,0-11.9,0v9h-9a5.9,5.9,0,1,0,0,11.9h9v9a5.9,5.9,0,0,0,11.9,0v-9h9a5.9,5.9,0,0,0,0-11.9Z"
                            style="fill: #ea57de"></path>
                        <path
                            d="M997,452.5h-6.2v-6.2a4.1,4.1,0,0,0-8.2,0v6.2h-6.2a4.1,4.1,0,0,0,0,8.2h6.2v6.2a4.1,4.1,0,1,0,8.2,0v-6.2H997a4.1,4.1,0,1,0,0-8.2Z"
                            style="fill: #fff"></path>
                        <path
                            d="M382.4,704.4h-5.6v-5.6a3.7,3.7,0,0,0-7.3,0v5.6h-5.6a3.7,3.7,0,1,0,0,7.3h5.6v5.6a3.7,3.7,0,1,0,7.3,0v-5.6h5.6a3.7,3.7,0,0,0,0-7.3Z"
                            style="fill: #fff"></path>
                        <path
                            d="M363.3,137.4h-5.6v-5.6a3.7,3.7,0,1,0-7.3,0v5.6h-5.6a3.7,3.7,0,1,0,0,7.3h5.6v5.6a3.7,3.7,0,1,0,7.3,0v-5.6h5.6a3.7,3.7,0,1,0,0-7.3Z"
                            style="fill: #fff"></path>
                    </g>

                    <g class="left-lines">
                        <line x1="381.1" y1="507.1" x2="272.1" y2="598"
                            style="fill: none;stroke: #ea57de;stroke-linecap: round;stroke-miterlimit: 10;stroke-width: 6px">
                        </line>
                        <line x1="384.1" y1="521.1" x2="275.1" y2="611.9"
                            style="fill: none;stroke: #ea57de;stroke-linecap: round;stroke-miterlimit: 10;stroke-width: 6px">
                        </line>
                        <line x1="387.2" y1="535.1" x2="278.2" y2="625.9"
                            style="fill: none;stroke: #ea57de;stroke-linecap: round;stroke-miterlimit: 10;stroke-width: 6px">
                        </line>
                    </g>

                    <g class="top-triangles">
                        <polygon points="593 168.6 659.5 244.5 497.1 255.2 593 168.6" style="fill: #ea57de"></polygon>
                        <polyline
                            points="659.5 234.5 657.3 213.9 590.7 138 494.8 224.6 497.1 245.2 497.1 245.2 593 158.6 659.5 234.5"
                            style="fill: #ffe029"></polyline>
                    </g>
                </g>

                <text class="text-element textA" x="260" y="180">Page Not Found</text>
                <text class="text-element textB" x="263" y="249">404</text>

                <a class="link-group" href={{ route("home") }}>
                    <text class="text-element textC" x="428" y="380">Go Back</text>
                </a>
            </svg>
        </div>
    </div>
</body>