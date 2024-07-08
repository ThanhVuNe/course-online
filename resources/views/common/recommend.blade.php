<!-- COURSE
================================================== -->
<section class="pt-5 pb-9 py-md-11 bg-white mb-8 border-bottom">
    <div class="container">
        <div class="text-center mb-4 mb-md-7 text-capitalize" data-aos="fade-up">
            <h1 class="mb-1">Recommended for you</h1>
            <p class="font-size-lg mb-0">Discover your perfect program in our courses.</p>
        </div>

        <section class="bg-light pt-5 pb-5 shadow-sm" data-aos="fade-up">
            <div class="container">
                <div class="row d-flex flex-row flex-nowrap overflow-auto">
                    @foreach ($recommend as $course)
                        <!--ADD CLASSES HERE d-flex align-items-stretch-->
                        <div class="col-lg-4 mb-3 d-flex align-items-stretch">
                            <!-- Card -->
                            <div class="card border shadow p-2 lift sk-fade">
                                <!-- Image -->
                                <div class="card-zoom position-relative">
                                    <a href="{{ route('courses.show', ['course' => $course->id]) }}"
                                        class="card-img sk-thumbnail d-block">
                                        <img class="rounded shadow-light-lg" src="{{ $course->poster_url }}"
                                            alt="...">
                                    </a>
                                </div>

                                <!-- Footer -->
                                <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">

                                    <!-- Preheading -->
                                    <a href="{{ route('courses.show', ['course' => $course->id]) }}"><span
                                            class="mb-1 d-inline-block text-gray-800">{{ $course->category->name }}</span></a>

                                    <!-- Heading -->
                                    <div class="position-relative">
                                        <a href="{{ route('courses.show', ['course' => $course->id]) }}"
                                            class="d-block stretched-link">
                                            <h4 class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-2">
                                                {{ $course->title }}</h4>
                                        </a>

                                        <div class="d-lg-flex align-items-end flex-wrap mb-n1">
                                            <div class="star-rating mb-2 mb-lg-0 me-lg-3">
                                                <div class="rating"
                                                    style="width:{{ (($course->average_rating - 1) / 3.6) * 100 }}%;">
                                                </div>
                                            </div>

                                            <div class="font-size-sm">
                                                <span>{{ $course->average_rating }}
                                                    ({{ convert_to_short_form($course->num_reviews) }}
                                                    {{ __('reviews') }})
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row mx-n2 align-items-end">
                                            <div class="col px-2">
                                                <ul class="nav mx-n3">
                                                    <li class="nav-item px-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="me-2 d-flex icon-uxs text-secondary">
                                                                <!-- Icon -->
                                                                <svg width="20" height="20" viewBox="0 0 20 20"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z"
                                                                        fill="currentColor" />
                                                                </svg>

                                                            </div>
                                                            <div class="font-size-sm">{{ $course->total_lessons }}
                                                                {{ __('lessons') }}</div>
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
                                                <ins
                                                    class="h4 mb-0 d-block mb-lg-n1">${{ number_format($course->discounted_price, 2) }}</ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</section>
