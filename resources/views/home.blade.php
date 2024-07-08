@extends('layouts.app')
@section('title', 'home')
@section('content')
<section class="mt-n12 jarallax overlay overlay-custom" data-jarallax data-speed=".8"
    style="background-image: url(assets/img/covers/cover-13.jpg)">
    <div class="container vh-100 d-flex">
        <div class="w-xl-80 text-center m-auto">
            <!-- Heading -->
            <h1 class="display-2 fw-medium text-white text-capitalize mb-4" data-aos="fade-left"
                data-aos-duration="150">Web Development for your career</h1>

            <!-- Text -->
            <p class="text-white px-md-8 px-xl-11 mw-xl-75 mx-auto mb-5" data-aos="fade-up" data-aos-duration="200">
                You will learned about how front-end, back-end work, and tips to build a fullfill website with many language
            </p>

            <!-- Buttons -->
            <a href="{{ route('courses.index', ['category[]' => 2]) }}" class="btn btn-white btn-x-wide rounded-lg lift" data-aos="fade-up"
                data-aos-duration="200">GET STARTED TODAY</a>
        </div>
    </div> <!-- / .container -->
</section>

<!-- FEATURED PRODUCT
================================================== -->
<section class="pt-5 pb-9 pt-md-8 pb-md-13 position-relative">
    <div class="container">
        <div class="text-center mb-5 mb-md-8">
            <h1 class="mb-1">Latest Online Courses</h1>
            <p class="font-size-lg text-capitalize">Discover your perfect program in our courses.</p>
        </div>

        <div class="row mb-2">
            @foreach ($courseLatest as $course)                
            <div class="col-12 col-md-6 col-xl-4 pb-4 pb-md-7">
                <!-- Card -->
                <div class="card border shadow p-2 sk-fade">
                    <!-- Image -->
                    <div class="card-zoom position-relative">
                        <a href="{{ route('courses.show', ['course' => $course->id]) }}"
                            class="card-img sk-thumbnail d-block">
                            <img class="rounded shadow-light-lg" src="{{ $course->poster_url }}" alt="...">
                        </a>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
                        <a href="course-list-v1.html" class="">
                            <div
                                class="avatar avatar-xl badge-float position-absolute top-0 right-0 mt-n6 me-5 rounded-circle shadow border border-white border-w-lg">
                                <img src="{{ $course->user->profile->avatar }}" alt="..." class="avatar-img rounded-circle">
                            </div>
                        </a>

                        <!-- Preheading -->
                        <a href="course-list-v1.html"><span
                                class="mb-1 d-inline-block text-gray-800">{{ $course->category->name }}</span></a>

                        <!-- Heading -->
                        <div class="position-relative">
                            <a href="#" class="d-block stretched-link">
                                <h4 class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-2">
                                    {{ $course->title }}
                                </h4>
                            </a>

                            <div class="d-lg-flex align-items-end flex-wrap mb-n1">
                                <div class="star-rating mb-2 mb-lg-0 me-lg-3">
                                    <div class="rating" style="width:50%;"></div>
                                </div>

                                <div class="font-size-sm">
                                    <span>{{ $course->average_rating }} ({{ $course->num_reviews }} reviews)</span>
                                </div>
                            </div>

                            <div class="row mx-n2 align-items-end">
                                <div class="col px-2">
                                    <ul class="nav mx-n3">
                                        <li class="nav-item px-3">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex icon-uxs text-secondary">
                                                    <!-- Icon -->
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z"
                                                            fill="currentColor" />
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">{{ $course->total_lessons }} lessons</div>
                                            </div>
                                        </li>
                                        <li class="nav-item px-3">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex icon-uxs text-secondary">
                                                    <!-- Icon -->
                                                    <svg width="16" height="16" viewBox="0 0 16 16"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z"
                                                            fill="currentColor" />
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">{{ $course->total_time }}h</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-auto px-2 text-right">
                                    <del class="font-size-sm">${{ $course->price }}</del>
                                    <ins class="h4 mb-0 d-block mb-lg-n1">${{
                                        number_format($course->discounted_price, 2) }}</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="{{ route('courses.index') }}" class="btn btn-dark btn-x-wide lift">VIEW ALL COURSES</a>
        </div>
    </div>

    <!-- Shape -->
    <div class="shape shape-bottom-100 shape-blur svg-shim text-light">
        <svg viewBox="0 0 1920 86" fill="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px">
            <path fill="currentColor" d="M0,86h1920V72.6C1174-69.7,752,34.5,0,72.6L0,86z" />
        </svg>

    </div>
</section>

<!-- ICON BLOCKS
================================================== -->
<section class="py-10 pt-md-8 pb-md-12 bg-white text-center position-relative">
    <div class="container">
        <div class="mb-8">
            <h1 class="mb-1">Learning Objectives</h1>
            <p class="font-size-lg mb-0 text-capitalize">Discover your perfect program in our courses.</p>
        </div>

        <div class="row text-capitalize">
            <div class="col-md-4 mb-5">
                <div class="d-inline-block rounded-circle mb-4">
                    <div class="icon-circle icon-circle-lg" style="background-color: #EDEAF6; color: #4E35A3;">
                        <!-- Icon -->
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M35.416 40H6.24935C3.72102 40 1.66602 37.945 1.66602 35.4167V4.58333C1.66602 2.055 3.72102 0 6.24935 0H32.0827C32.7727 0 33.3327 0.56 33.3327 1.25V6.66667H35.416C36.106 6.66667 36.666 7.22667 36.666 7.91667V38.75C36.666 39.44 36.106 40 35.416 40ZM4.16602 8.665V35.4167C4.16602 36.565 5.10102 37.5 6.24935 37.5H34.166V9.16667H6.24935C5.49935 9.16667 4.79102 8.98667 4.16602 8.665ZM6.24935 2.5C5.10102 2.5 4.16602 3.435 4.16602 4.58333C4.16602 5.73167 5.10102 6.66667 6.24935 6.66667H30.8327V2.5H6.24935Z"
                                fill="currentColor" />
                            <path
                                d="M20.4173 31.6665C20.189 31.6665 19.964 31.6048 19.7606 31.4815L15.0006 28.5515L10.2407 31.4815C9.85398 31.7198 9.37232 31.7282 8.97398 31.5082C8.57732 31.2865 8.33398 30.8682 8.33398 30.4165V7.9165H10.834V28.1798L14.344 26.0198C14.7473 25.7732 15.2523 25.7732 15.6556 26.0198L19.1656 28.1798V7.9165H21.6673V30.4165C21.6673 30.8682 21.424 31.2865 21.0273 31.5082C20.8373 31.6132 20.6273 31.6665 20.4173 31.6665Z"
                                fill="currentColor" />
                        </svg>

                    </div>
                </div>

                <h5>Bookmark Fav Courses</h5>
                <p class="px-lg-4 px-xl-5">Getting the necessary clarity about the current state to help you improve
                    your game.</p>
            </div>

            <div class="col-md-4 mb-5">
                <div class="d-inline-block rounded-circle mb-4">
                    <div class="icon-circle icon-circle-lg" style="background-color: #E8F8FB; color: #17B5D1;">
                        <!-- Icon -->
                        <svg width="45" height="41" viewBox="0 0 45 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.8823 30.607C16.0556 29.4717 16.7871 27.8826 16.7871 26.125C16.7871 22.6842 13.9877 19.8848 10.5469 19.8848C7.10605 19.8848 4.30664 22.6842 4.30664 26.125C4.30664 27.877 5.03341 29.4616 6.20007 30.5962C2.54689 32.1308 0 35.5376 0 39.4844C0 40.2125 0.590273 40.8027 1.31836 40.8027C2.04645 40.8027 2.63672 40.2125 2.63672 39.4844C2.63672 35.5589 6.18521 32.3652 10.5469 32.3652C14.8601 32.3652 18.3691 35.5589 18.3691 39.4844C18.3691 40.2125 18.9594 40.8027 19.6875 40.8027C20.4156 40.8027 21.0059 40.2125 21.0059 39.4844C21.0059 35.5467 18.4917 32.1467 14.8823 30.607ZM6.94336 26.125C6.94336 24.1381 8.55993 22.5215 10.5469 22.5215C12.5338 22.5215 14.1504 24.1381 14.1504 26.125C14.1504 28.1119 12.5338 29.7285 10.5469 29.7285C8.55993 29.7285 6.94336 28.1119 6.94336 26.125Z"
                                fill="currentColor" />
                            <path
                                d="M23.9941 19.7969C23.9941 20.525 24.5844 21.1152 25.3125 21.1152C26.0406 21.1152 26.6309 20.525 26.6309 19.7969C26.6309 15.8714 30.1399 12.6777 34.4531 12.6777C38.8148 12.6777 42.3633 15.8714 42.3633 19.7969C42.3633 20.525 42.9536 21.1152 43.6816 21.1152C44.4097 21.1152 45 20.525 45 19.7969C45 15.8501 42.4531 12.4433 38.7999 10.9087C39.9666 9.77409 40.6934 8.18951 40.6934 6.4375C40.6934 2.99667 37.894 0.197266 34.4531 0.197266C31.0123 0.197266 28.2129 2.99667 28.2129 6.4375C28.2129 8.19514 28.9444 9.7842 30.1177 10.9195C26.5083 12.4592 23.9941 15.8592 23.9941 19.7969ZM30.8496 6.4375C30.8496 4.45056 32.4662 2.83398 34.4531 2.83398C36.4401 2.83398 38.0566 4.45056 38.0566 6.4375C38.0566 8.42444 36.4401 10.041 34.4531 10.041C32.4662 10.041 30.8496 8.42444 30.8496 6.4375Z"
                                fill="currentColor" />
                            <path
                                d="M5.53711 16.8965H18.3691C19.823 16.8965 21.0059 15.7137 21.0059 14.2598V11.3594C21.1184 11.246 21.9609 10.3023 24.3516 7.58441C26.0789 5.85709 25.225 3.42498 23.0585 3.03106C22.7863 2.9814 23.9588 3.00979 5.53711 3.00979C4.08322 3.00979 2.90039 4.19262 2.90039 5.64651V14.2598C2.90039 15.7137 4.08322 16.8965 5.53711 16.8965ZM5.53711 5.64651C15.7944 5.64651 21.0927 5.64835 22.5593 5.64835C22.3946 5.81543 21.4656 6.79321 19.2057 9.34002C18.6656 9.89918 18.3691 10.6074 18.3691 11.3594V14.2598H5.53711V5.64651Z"
                                fill="currentColor" />
                            <path
                                d="M31.6112 29.951C31.0054 30.3602 30.8438 31.1673 31.2473 31.7792C31.6268 32.3567 32.4396 32.5624 33.0754 32.1431C33.6786 31.7361 33.8448 30.9299 33.4393 30.315C33.0371 29.7175 32.233 29.5424 31.6112 29.951Z"
                                fill="currentColor" />
                            <path
                                d="M36.6764 31.3042C36.9167 32.4636 38.4285 32.7477 39.0652 31.7788C39.7006 30.8155 38.8907 29.5334 37.7117 29.7538C36.9978 29.9021 36.54 30.576 36.6764 31.3042Z"
                                fill="currentColor" />
                            <path
                                d="M44.9996 35.3534V26.7402C44.9996 25.2863 43.8168 24.1034 42.3629 24.1034C20.6699 24.1034 22.1948 24.0784 21.9412 24.1247C19.7747 24.5186 18.9207 26.9507 20.6481 28.6781C23.0388 31.396 23.8812 32.3397 23.9938 32.453V35.3534C23.9938 36.8073 25.1766 37.9902 26.6305 37.9902H42.3629C43.8168 37.9902 44.9996 36.8073 44.9996 35.3534ZM42.3629 35.3534H26.6305V32.453C26.6305 31.7011 26.334 30.9928 25.794 30.4337C23.534 27.8869 22.605 26.9091 22.4403 26.742C23.9069 26.742 32.1056 26.7402 42.3629 26.7402V35.3534Z"
                                fill="currentColor" />
                        </svg>

                    </div>
                </div>

                <h5>Live Chats</h5>
                <p class="px-lg-4 px-xl-5">Getting the necessary clarity about the current state to help you improve
                    your game.</p>
            </div>

            <div class="col-md-4 mb-5">
                <div class="d-inline-block rounded-circle mb-4">
                    <div class="icon-circle icon-circle-lg" style="background-color: #FFEBE5; color: #FD5000;">
                        <!-- Icon -->
                        <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22.5005 39.1303C23.581 39.1303 24.457 38.2544 24.457 37.1738C24.457 36.0932 23.581 35.2173 22.5005 35.2173C21.4199 35.2173 20.5439 36.0932 20.5439 37.1738C20.5439 38.2544 21.4199 39.1303 22.5005 39.1303Z"
                                fill="currentColor" />
                            <path
                                d="M19.2785 17.8952L15.3654 13.9822C14.9829 13.5997 14.3647 13.5997 13.9822 13.9822C13.5997 14.3647 13.5997 14.9829 13.9822 15.3654L17.2036 18.5869L13.9822 21.8083C13.5997 22.1908 13.5997 22.809 13.9822 23.1915C14.1729 23.3823 14.4234 23.4782 14.6738 23.4782C14.9243 23.4782 15.1747 23.3823 15.3654 23.1915L19.2785 19.2785C19.661 18.896 19.661 18.2777 19.2785 17.8952Z"
                                fill="currentColor" />
                            <path
                                d="M30.3258 21.5217H22.4997C21.9597 21.5217 21.5215 21.96 21.5215 22.5C21.5215 23.04 21.9597 23.4783 22.4997 23.4783H30.3258C30.8658 23.4783 31.3041 23.04 31.3041 22.5C31.3041 21.96 30.8658 21.5217 30.3258 21.5217Z"
                                fill="currentColor" />
                            <path
                                d="M30.3263 15.6521H24.4568C23.9168 15.6521 23.4785 16.0904 23.4785 16.6304C23.4785 17.1704 23.9168 17.6086 24.4568 17.6086H30.3263C30.8663 17.6086 31.3046 17.1704 31.3046 16.6304C31.3046 16.0904 30.8663 15.6521 30.3263 15.6521Z"
                                fill="currentColor" />
                            <path
                                d="M30.3257 27.3914H14.6736C14.1336 27.3914 13.6953 27.8296 13.6953 28.3696C13.6953 28.9096 14.1336 29.3479 14.6736 29.3479H30.3257C30.8657 29.3479 31.304 28.9096 31.304 28.3696C31.304 27.8296 30.8657 27.3914 30.3257 27.3914Z"
                                fill="currentColor" />
                            <path
                                d="M32.2788 0C32.0978 0 12.7175 0 12.7175 0C12.7175 0 12.7175 0 12.7165 0C11.4105 0 10.1828 0.508696 9.25932 1.43217C8.33585 2.35565 7.82617 3.58533 7.82617 4.8913V6.84587C7.82617 6.84685 7.82617 6.84685 7.82617 6.84783C7.82617 6.8488 7.82617 6.8488 7.82617 6.84978V40.1087C7.82617 42.8058 10.0204 45 12.7175 45H32.2827C34.9798 45 37.174 42.8058 37.174 40.1087V4.8913C37.174 2.19424 34.9798 0 32.2788 0ZM9.78269 4.8913C9.78269 4.10772 10.0879 3.37011 10.6426 2.81641C11.1963 2.26272 11.9329 1.95652 12.7165 1.95652H22.4991C29.0085 1.95652 31.3592 1.95652 32.2817 1.8812V1.95652C33.8998 1.95652 35.2165 3.27326 35.2165 4.8913V5.86957H9.78269V4.8913ZM35.2175 40.1087C35.2175 41.7267 33.9007 43.0435 32.2827 43.0435H12.7175C11.0994 43.0435 9.78269 41.7267 9.78269 40.1087V7.82609H35.2175V40.1087Z"
                                fill="currentColor" />
                        </svg>

                    </div>
                </div>

                <h5>App Access</h5>
                <p class="px-lg-4 px-xl-5">Getting the necessary clarity about the current state to help you improve
                    your game.</p>
            </div>

            <div class="col-md-4 mb-5">
                <div class="d-inline-block rounded-circle mb-4">
                    <div class="icon-circle icon-circle-lg" style="background-color: #E9F6FF; color: #0B55B5;">
                        <!-- Icon -->
                        <svg width="50" height="44" viewBox="0 0 50 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M28.9062 22C28.9062 19.8461 27.1539 18.0938 25 18.0938C22.8461 18.0938 21.0938 19.8461 21.0938 22C21.0938 24.1539 22.8461 25.9062 25 25.9062C27.1539 25.9062 28.9062 24.1539 28.9062 22ZM25 23.9531C23.923 23.9531 23.0469 23.077 23.0469 22C23.0469 20.923 23.923 20.0469 25 20.0469C26.077 20.0469 26.9531 20.923 26.9531 22C26.9531 23.077 26.077 23.9531 25 23.9531Z"
                                fill="currentColor" />
                            <path
                                d="M6.83594 43.4844H20.6055C21.1447 43.4844 21.582 43.0472 21.582 42.5078C21.582 41.9685 21.1447 41.5312 20.6055 41.5312H6.83594C4.47793 41.5312 2.50488 39.851 2.05127 37.624H47.9487C47.4951 39.851 45.5221 41.5312 43.1641 41.5312H29.3945C28.8553 41.5312 28.418 41.9685 28.418 42.5078C28.418 43.0472 28.8553 43.4844 29.3945 43.4844H43.1641C46.9334 43.4844 50 40.4178 50 36.6484C50 36.1091 49.5627 35.6719 49.0234 35.6719H45.6055V10.2812C45.6055 9.74189 45.1682 9.30469 44.6289 9.30469H37.6953V1.49219C37.6953 1.13203 37.4971 0.801074 37.1796 0.631152C36.862 0.46123 36.4766 0.479883 36.1771 0.679688L28.9062 5.52686V1.49219C28.9062 0.952832 28.4689 0.515625 27.9297 0.515625H13.2812C12.742 0.515625 12.3047 0.952832 12.3047 1.49219V9.30469H5.37109C4.83184 9.30469 4.39453 9.74189 4.39453 10.2812V35.6719H0.976562C0.437305 35.6719 0 36.1091 0 36.6484C0 40.4178 3.0666 43.4844 6.83594 43.4844ZM29.8828 35.6719H20.1172V32.7422C20.1172 30.0498 22.3076 27.8594 25 27.8594C27.6924 27.8594 29.8828 30.0498 29.8828 32.7422V35.6719ZM35.7422 3.31689V11.3862L29.6901 7.35156L35.7422 3.31689ZM14.2578 2.46875H26.9531V12.2344H14.2578V2.46875ZM6.34766 11.2578H12.3047V13.2109C12.3047 13.7503 12.742 14.1875 13.2812 14.1875H27.9297C28.4689 14.1875 28.9062 13.7503 28.9062 13.2109V9.17627L36.1771 14.0234C36.4771 14.2235 36.8625 14.2416 37.1796 14.072C37.4971 13.9021 37.6953 13.5711 37.6953 13.2109V11.2578H43.6523V35.6719H31.8359V32.7422C31.8359 28.9729 28.7693 25.9062 25 25.9062C21.2307 25.9062 18.1641 28.9729 18.1641 32.7422V35.6719H6.34766V11.2578Z"
                                fill="currentColor" />
                            <path
                                d="M25 43.4844C25.5393 43.4844 25.9766 43.0472 25.9766 42.5078C25.9766 41.9685 25.5393 41.5312 25 41.5312C24.4607 41.5312 24.0234 41.9685 24.0234 42.5078C24.0234 43.0472 24.4607 43.4844 25 43.4844Z"
                                fill="currentColor" />
                        </svg>

                    </div>
                </div>

                <h5>Video Demonstration</h5>
                <p class="px-lg-4 px-xl-5">Getting the necessary clarity about the current state to help you improve
                    your game.</p>
            </div>

            <div class="col-md-4 mb-5">
                <div class="d-inline-block rounded-circle mb-4">
                    <div class="icon-circle icon-circle-lg" style="background-color: #FCF7EB; color: #E0B339;">
                        <!-- Icon -->
                        <svg width="38" height="51" viewBox="0 0 38 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19 26.1389C24.5246 26.1389 28.7656 21.6148 28.7656 16.3123C28.7656 10.896 24.3862 6.48776 19.0033 6.4856C19.0032 6.4856 19.0001 6.4856 19 6.4856C13.6152 6.4856 9.23438 10.8938 9.23438 16.3123C9.23438 21.6121 13.4726 26.1389 19 26.1389ZM13.3845 21.7786L18.0234 18.2776V24.113C16.2487 23.8931 14.6256 23.0763 13.3845 21.7786ZM19.9766 24.113V18.2776L24.6156 21.7786C23.3747 23.0762 21.7514 23.8931 19.9766 24.113ZM26.8125 16.3123C26.8125 17.698 26.4605 19.0268 25.7882 20.2069L19.9766 15.8209V8.5146C23.8247 9.00034 26.8125 12.3113 26.8125 16.3123ZM18.0234 8.51451V15.8209L12.2117 20.207C11.5395 19.0272 11.1875 17.6982 11.1875 16.3123C11.1875 12.3104 14.1751 8.99994 18.0234 8.51451Z"
                                fill="currentColor" />
                            <path
                                d="M24.8594 30.0696H13.1406C12.6013 30.0696 12.1641 30.5095 12.1641 31.0522C12.1641 31.595 12.6013 32.0349 13.1406 32.0349H24.8594C25.3986 32.0349 25.8359 31.595 25.8359 31.0522C25.8359 30.5095 25.3986 30.0696 24.8594 30.0696Z"
                                fill="currentColor" />
                            <path
                                d="M19 50.3125C19.5393 50.3125 19.9766 49.8725 19.9766 49.3298C19.9766 48.7871 19.5393 48.3472 19 48.3472C18.4607 48.3472 18.0234 48.7871 18.0234 49.3298C18.0234 49.8725 18.4607 50.3125 19 50.3125Z"
                                fill="currentColor" />
                            <path
                                d="M0.445312 6.87866V43.4338C0.445312 47.2267 3.51191 50.3125 7.28125 50.3125H14.6055C15.1448 50.3125 15.582 49.8726 15.582 49.3298C15.582 48.7871 15.1448 48.3472 14.6055 48.3472H7.28125C4.58887 48.3472 2.39844 46.143 2.39844 43.4338C2.39844 40.7246 4.58887 38.5205 7.28125 38.5195H33.792C33.212 39.5402 32.8246 40.8983 32.7089 42.4512H7.28125C6.74189 42.4512 6.30469 42.8911 6.30469 43.4338C6.30469 43.9766 6.74189 44.4165 7.28125 44.4165H32.7089C32.8246 45.9694 33.2119 47.3275 33.7919 48.3472H23.3945C22.8553 48.3472 22.418 48.7871 22.418 49.3298C22.418 49.8726 22.8553 50.3125 23.3945 50.3125H36.5781C37.1174 50.3125 37.5547 49.8726 37.5547 49.3298C37.5547 48.7871 37.1174 48.3472 36.5781 48.3472C35.7818 48.3472 34.625 46.4331 34.625 43.4338C34.625 40.4345 35.7818 38.5205 36.5781 38.5205C37.1174 38.5205 37.5547 38.0806 37.5547 37.5378V0.982666C37.5547 0.43994 37.1174 0 36.5781 0H7.28125C3.51191 0 0.445312 3.08577 0.445312 6.87866ZM7.28125 1.96533H35.6016V36.5552H7.28125C5.37041 36.5552 3.64014 37.3482 2.39844 38.6244V6.87866C2.39844 4.16945 4.58887 1.96533 7.28125 1.96533Z"
                                fill="currentColor" />
                        </svg>

                    </div>
                </div>

                <h5>Book Quality</h5>
                <p class="px-lg-4 px-xl-5">Getting the necessary clarity about the current state to help you improve
                    your game.</p>
            </div>

            <div class="col-md-4 mb-5">
                <div class="d-inline-block rounded-circle mb-4">
                    <div class="icon-circle icon-circle-lg" style="background-color: #E6EFFF; color: #1264FF;">
                        <!-- Icon -->
                        <svg width="45" height="46" viewBox="0 0 45 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M36.5455 26.7089C35.746 23.8553 34.0867 21.2808 31.7968 19.3737C30.4514 18.2532 28.9205 17.3934 27.2882 16.8229C28.7711 15.4936 29.7073 13.5595 29.7073 11.4088V7.25208C29.7073 3.25326 26.4743 0 22.5003 0C18.5263 0 15.2933 3.25326 15.2933 7.25208V11.4088C15.2933 13.5595 16.2295 15.4936 17.7124 16.8229C16.0801 17.3934 14.5492 18.2532 13.2038 19.3737C10.914 21.2808 9.25457 23.8553 8.45512 26.7089H5.20703L7.25778 45.2812H37.7428L39.7936 26.7089H36.5455ZM17.93 7.25208C17.93 4.71624 19.9802 2.6532 22.5003 2.6532C25.0204 2.6532 27.0706 4.71624 27.0706 7.25208V11.4088C27.0706 13.9446 25.0204 16.0076 22.5003 16.0076C19.9802 16.0076 17.93 13.9446 17.93 11.4088V7.25208ZM22.5003 18.6608C27.6174 18.6608 32.1295 21.9612 33.7835 26.7089H11.2171C12.8711 21.9612 17.3832 18.6608 22.5003 18.6608ZM35.3828 42.6281H9.61782L8.15295 29.3621H36.8477L35.3828 42.6281Z"
                                fill="currentColor" />
                            <path
                                d="M22.5 37.2332C23.4708 37.2332 24.2578 36.4412 24.2578 35.4644C24.2578 34.4875 23.4708 33.6956 22.5 33.6956C21.5292 33.6956 20.7422 34.4875 20.7422 35.4644C20.7422 36.4412 21.5292 37.2332 22.5 37.2332Z"
                                fill="currentColor" />
                        </svg>

                    </div>
                </div>

                <h5>Courses for all Ages</h5>
                <p class="px-lg-4 px-xl-5">Getting the necessary clarity about the current state to help you improve
                    your game.</p>
            </div>
        </div>
    </div>

    <!-- Shape -->
    <div class="shape shape-bottom-100 shape-blur svg-shim text-white">
        <svg viewBox="0 0 1920 86" fill="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px">
            <path fill="currentColor" d="M0,86h1920V72.6C1174-69.7,752,34.5,0,72.6L0,86z" />
        </svg>

    </div>
</section>

<!-- INSTRUCTORS
================================================== -->
{{-- <section class="pt-8 pb-12 bg-white">
    <div class="container">
        <div class="text-center mb-6">
            <h1>Top Rating Instructors</h1>
            <p class="font-size-lg text-capitalize mb-0">Discover your perfect program in our courses.</p>
        </div>

        <div class="mx-n3 mx-md-n4"
            data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
            <div class="col-12 mw-xl-20 mw-md-25 text-center py-5 px-3 px-md-4">
                <div class="card">
                    <!-- Image -->
                    <div class="card-zoom position-relative d-flex justify-content-center rounded-circle overflow-hidden card-hover-overlay mx-auto w-100"
                        style="max-width: 150px;">
                        <div class="card-float card-hover center">
                            <ul class="nav mx-n6 justify-content-center font-size-sm">
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <a href="instructors-single.html" class="card-img sk-thumbnail img-ratio-one d-block">
                            <img class="shadow-light-lg rounded-circle h-100 o-f-c"
                                src="assets/img/instructors/instructor-1.jpg" alt="...">
                        </a>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-0 pt-4 pb-0">
                        <a href="#" class="d-block">
                            <h5 class="mb-0">Jack Wilson</h5>
                        </a>
                        <span class="font-size-d-sm">Developer</span>
                    </div>
                </div>
            </div>
            <div class="col-12 mw-xl-20 mw-md-25 text-center py-5 px-3 px-md-4">
                <div class="card">
                    <!-- Image -->
                    <div class="card-zoom position-relative d-flex justify-content-center rounded-circle overflow-hidden card-hover-overlay mx-auto w-100"
                        style="max-width: 150px;">
                        <div class="card-float card-hover center">
                            <ul class="nav mx-n6 justify-content-center font-size-sm">
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <a href="instructors-single.html" class="card-img sk-thumbnail img-ratio-one d-block">
                            <img class="shadow-light-lg rounded-circle h-100 o-f-c"
                                src="assets/img/instructors/instructor-2.jpg" alt="...">
                        </a>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-0 pt-4 pb-0">
                        <a href="#" class="d-block">
                            <h5 class="mb-0">Anna Richard</h5>
                        </a>
                        <span class="font-size-d-sm">Travel Bloger</span>
                    </div>
                </div>
            </div>
            <div class="col-12 mw-xl-20 mw-md-25 text-center py-5 px-3 px-md-4">
                <div class="card">
                    <!-- Image -->
                    <div class="card-zoom position-relative d-flex justify-content-center rounded-circle overflow-hidden card-hover-overlay mx-auto w-100"
                        style="max-width: 150px;">
                        <div class="card-float card-hover center">
                            <ul class="nav mx-n6 justify-content-center font-size-sm">
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <a href="instructors-single.html" class="card-img sk-thumbnail img-ratio-one d-block">
                            <img class="shadow-light-lg rounded-circle h-100 o-f-c"
                                src="assets/img/instructors/instructor-3.jpg" alt="...">
                        </a>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-0 pt-4 pb-0">
                        <a href="#" class="d-block">
                            <h5 class="mb-0">Kathelen Monero</h5>
                        </a>
                        <span class="font-size-d-sm">Designer</span>
                    </div>
                </div>
            </div>
            <div class="col-12 mw-xl-20 mw-md-25 text-center py-5 px-3 px-md-4">
                <div class="card">
                    <!-- Image -->
                    <div class="card-zoom position-relative d-flex justify-content-center rounded-circle overflow-hidden card-hover-overlay mx-auto w-100"
                        style="max-width: 150px;">
                        <div class="card-float card-hover center">
                            <ul class="nav mx-n6 justify-content-center font-size-sm">
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <a href="instructors-single.html" class="card-img sk-thumbnail img-ratio-one d-block">
                            <img class="shadow-light-lg rounded-circle h-100 o-f-c"
                                src="assets/img/instructors/instructor-4.jpg" alt="...">
                        </a>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-0 pt-4 pb-0">
                        <a href="#" class="d-block">
                            <h5 class="mb-0">Kristen Pala</h5>
                        </a>
                        <span class="font-size-d-sm">User Experience Design</span>
                    </div>
                </div>
            </div>
            <div class="col-12 mw-xl-20 mw-md-25 text-center py-5 px-3 px-md-4">
                <div class="card">
                    <!-- Image -->
                    <div class="card-zoom position-relative d-flex justify-content-center rounded-circle overflow-hidden card-hover-overlay mx-auto w-100"
                        style="max-width: 150px;">
                        <div class="card-float card-hover center">
                            <ul class="nav mx-n6 justify-content-center font-size-sm">
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <a href="instructors-single.html" class="card-img sk-thumbnail img-ratio-one d-block">
                            <img class="shadow-light-lg rounded-circle h-100 o-f-c"
                                src="assets/img/instructors/instructor-5.jpg" alt="...">
                        </a>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-0 pt-4 pb-0">
                        <a href="#" class="d-block">
                            <h5 class="mb-0">Anna Richard</h5>
                        </a>
                        <span class="font-size-d-sm">Travel Bloger</span>
                    </div>
                </div>
            </div>
            <div class="col-12 mw-xl-20 mw-md-25 text-center py-5 px-3 px-md-4">
                <div class="card">
                    <!-- Image -->
                    <div class="card-zoom position-relative d-flex justify-content-center rounded-circle overflow-hidden card-hover-overlay mx-auto w-100"
                        style="max-width: 150px;">
                        <div class="card-float card-hover center">
                            <ul class="nav mx-n6 justify-content-center font-size-sm">
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="#" class="d-block text-white">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <a href="instructors-single.html" class="card-img sk-thumbnail img-ratio-one d-block">
                            <img class="shadow-light-lg rounded-circle h-100 o-f-c"
                                src="assets/img/instructors/instructor-1.jpg" alt="...">
                        </a>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-0 pt-4 pb-0">
                        <a href="#" class="d-block">
                            <h5 class="mb-0">Jack Wilson</h5>
                        </a>
                        <span class="font-size-d-sm">Developer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection