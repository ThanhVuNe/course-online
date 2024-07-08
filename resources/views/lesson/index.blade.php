@extends('layouts.lesson')
@section('title', 'Lesson: ' . $lesson->title)
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
    <style>
        .completedLesson {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease; /* Transition for opacity change */
        }

        .completedLesson.show {
            display: flex;
            opacity: 1;
            animation: slideIn 0.5s ease; /* Animation for sliding in */
        }

        @keyframes slideIn {
            from {
                transform: translateY(100%);
            }
            to {
                transform: translateY(0);
            }
        }
    </style>
@endsection
@section('script')
    <script type="module" src="{{ asset('assets/js/comment.js') }}"></script>
    <script src="{{ asset('assets/js/submitForm.js') }}"></script>
    <script src="{{ asset('assets/js/toast.js') }}"></script>
@endsection
@section('modal')
    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel">Delete</h5>
                </div>
                <div class="modal-body delete_item">
                    Do you really want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancelDelete" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="submitDelete" class="btn btn-alizarin">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Notification-->
    <div class="notification-toast toast-success" style="display: none">
        <div>
            <span class="alert-icon"><i class="fa-solid fa-thumbs-up"></i></span>
            <span class="alert-text"><strong class="me-2">{{ __('success') }}</strong><br></span>
        </div>
        <div><span class="messageNotice"></span></div>
        <button type="button" class="btn-close" aria-label="Close"></button>
    </div>
    <div class="notification-toast toast-error" style="display: none">
        <div>
            <span class="alert-icon"><i class="fa-solid fa-circle-exclamation"></i></i></span>
            <span class="alert-text"><strong class="me-2">{{ __('error') }}</strong><br></span>
        </div>
        <div><span class="messageNotice"></span></div>
        <button type="button" class="btn-close" aria-label="Close"></button>
    </div>

@endsection
@section('content')
    <!-- COURSE ================================================== -->
    @include('layouts.message')
    <div class="container container-wd" style="margin-top: 110px;">
        <div class="row pt-8 pb-10">
            <div class="col-lg-8">
                @if ($lesson->file_type == 'mp4') 
                    <video id="lessonVideo" controls width="750" height="470">
                        <source src="{{ $lesson->lesson_url }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @elseif ($lesson->file_type == 'pdf')
                    <embed src="{{ $lesson->lesson_url }}" type="application/pdf" width="750" height="600">
                         <a class="text-white" href="{{ $lesson->lesson_url }}">Download the PDF</a> instead.
                    </embed>
                @else
                    <!-- Handle other file types or display a message if no file type matches -->
                @endif

                @if ($lesson->processing->isEmpty())
                    
                    @if ($lesson->file_type == 'pdf')
                    <div class="d-flex justify-content-end " style="margin-right: 30px;">
                        <button style="padding: 10px;" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#nextLessonModal">
                            Completed Lesson
                        </button>
                    </div>
                    @else
                        <div class="justify-content-end completedLesson" style="margin-right: 30px;">
                            <button style="padding: 10px;" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#nextLessonModal">
                                Completed Lesson
                            </button>
                        </div>
                    @endif
                @endif
                <h3 class="text-white">Course Description</h3>
                    
                <p class="mb-6 line-height-md">{!! $course->description !!}</p>
                <a class="text-teal read-more h6 d-inline-block mb-8" data-bs-toggle="collapse" href="#readcollapseExample"
                    role="button" aria-expanded="false" aria-controls="readcollapseExample">
                    <span class="d-inline-flex align-items-center more">
                        Read More
                        <span
                            class="d-flex align-items-center justify-content-center bg-teal rounded-circle ms-2 p-2 w-26p">
                            <i class="fas fa-plus font-size-10 text-white"></i>
                        </span>
                    </span>
                    <span class="d-inline-flex align-items-center less">
                        Read Less
                        <span
                            class="d-flex align-items-center justify-content-center bg-teal rounded-circle ms-2 p-2 w-26p">
                            <i class="fas fa-minus font-size-10 text-white"></i>
                        </span>
                    </span>
                </a>
                <h3 class="text-white mb-6">Comment</h3>
                <ul class="list-unstyled pt-2">
                    @foreach ($comments as $comment)
                        @if (empty($comment->parent_id))
                            <div class="row-cols-md-12 mb-6" id="comment{{ $comment->id}}">
                                <li class="media d-flex">
                                    <div class="avatar avatar-xl me-3 me-md-6 flex-shrink-0">
                                        <img src="{{ $comment->user->profile->avatar }}" alt="..."
                                            class="avatar-img rounded-circle">
                                    </div>
                                    <div class="media-body flex-grow-1">
                                        <div class="d-md-flex align-items-center mb-1">
                                            <div class="me-auto mb-4 mb-md-0 d-flex  align-items-center">
                                                <h5 class="text-white mb-1 mx-2 fw-semi-bold">
                                                    {{ $comment->user->profile->full_name }}
                                                    <span
                                                        class="font-size-sm text-blue">{{ '@' . $comment->user->username }}</span>
                                                </h5>
                                                <p class="font-size-sm font-italic m-0">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                            @if (auth()->id() == $comment->user->id)
                                                <div class="me-0 sidenav-right">
                                                    <button class="btn" data-bs-toggle="dropdown" href="#"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-wd-end border-xl"
                                                        aria-labelledby="navbarActionParent">
                                                        <li class="dropdown-item">
                                                            <a class="dropdown-link btn-edit" href="javascript:void(0)"
                                                                data-comment-id="{{ $comment->id }}">
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <form id="formDelete{{ $comment->id }}"
                                                                data-url="{{ route('comments.destroy', ['comment' => $comment->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="id" value="{{ $comment->id }}">
                                                                <a class="dropdown-link text-alizarin" id="commentId"
                                                                    data-id="{{ $comment->id }}" href="javascript:void(0)" onclick="deleteComment({{ $comment->id }}, null)"
                                                                    data-bs-toggle="modal" data-bs-target="#commentModal">
                                                                    Delete
                                                                </a>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="mb-2 line-height-md comment-content {{ $comment->id }}">
                                            {{ $comment->content }}</p>
                                            <div class="edit-comment {{ $comment->id }}">
                                                <div class="bg-portgore rounded p-1 p-md-4 mb-4">
                                                    <form
                                                        data-url="{{ route('comments.update', ['comment' => $comment->id]) }}"
                                                        id="formEdit{{ $comment->id }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <textarea class="form-control placeholder-1 bg-dark border-0 mb-4" id="content{{ $comment->id }}" name="content"
                                                            rows="3" placeholder="Add you comment">{{ $comment->content }}</textarea>
                                                        <button type="button" class="btn btn-orange btn-block mw-md-200p"
                                                            onclick="submitForm({{ $comment->id }})">SUBMIT</button>
                                                        <a class="btn btn-gray-200 btn-block mw-md-200p btn-edit"
                                                            data-comment-id="{{ $comment->id }}">CANCEL</a>
                                                    </form>
                                                </div>
                                            </div>
                                        <div class="mb-4">
                                            <button class="btn fa-solid fa-reply btn-reply"
                                                data-parentId="{{ $comment->id }}"></button>Reply
                                            {{-- <button class="btn fa-regular fa-flag"></button>Report (To Do) --}}
                                        </div>
                                            <div class="reply-comment {{ $comment->id }}">
                                                <div class="bg-portgore rounded p-1 p-md-4 mb-4">
                                                    <form action="{{ route('comments.store') }}" method="POST">
                                                        @csrf
                                                        <input name="lesson_id" type="hidden" value="{{ $lesson->id }}">
                                                        <input name="parent_id" type="hidden" value="{{ $comment->id }}">
                                                        <textarea class="form-control placeholder-1 bg-dark border-0 mb-4" name="content" rows="3"
                                                            placeholder="Add you comment" data-parentId="{{ $comment->id }}"></textarea>
                                                        <button type="submit" id="submit-child"
                                                            class="btn btn-orange btn-block mw-md-300p">SUBMIT</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @if ($comments->where('parent_id', $comment->id)->count() != 0)
                                            <a class="mb-4 btn" href="javascript:void(0)">
                                                <span class="show-reply {{ $comment->id }}"
                                                    data-parentId="{{ $comment->id }}">
                                                    <i class="fa-solid fa-chevron-down"></i>
                                                    Show <span id="count{{ $comment->id }}">{{ $comments->where('parent_id', $comment->id)->count() }}</span> replys
                                                </span>
                                            </a>
                                        @endif
                                    </div>
                                </li>
                                @if ($comments->where('parent_id', $comment->id)->count() != 0)
                                    <div class="offset-1 col-md-11 media reply-wrap {{ $comment->id }}">
                                        @foreach ($comments as $childComment)
                                            @if ($childComment->parent_id == $comment->id)
                                                <li class="d-flex" id="comment{{ $childComment->id}}">
                                                    <div class="avatar avatar-xl me-3 me-md-6 flex-shrink-0">
                                                        <img src="{{ $childComment->user->profile->avatar }}"
                                                            alt="..." class="avatar-img rounded-circle">
                                                    </div>
                                                    <div class="media-body flex-grow-1">
                                                        <div class="d-md-flex align-items-center mb-1">
                                                            <div class="me-auto mb-4 mb-md-0">
                                                                <h5 class="text-white mb-1 fw-semi-bold">
                                                                    {{ $childComment->user->profile->full_name }}
                                                                    <span
                                                                        class="font-size-sm text-blue">{{ '@' . $childComment->user->username }}</span>
                                                                </h5>
                                                                <p class="font-size-sm font-italic">
                                                                    {{ $childComment->created_at->diffForHumans() }}
                                                                </p>
                                                            </div>
                                                            @if (auth()->id() == $childComment->user->id)
                                                                <div class="me-0 sidenav-right">
                                                                    <button class="btn" data-bs-toggle="dropdown"
                                                                        href="#" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-wd-end border-xl"
                                                                        aria-labelledby="navbarAction">
                                                                        <li class="dropdown-item">
                                                                            <a class="dropdown-link btn-edit" href="javascript:void(0)"
                                                                                data-comment-id="{{ $childComment->id }}">
                                                                                Edit
                                                                            </a>
                                                                        </li>
                                                                        <li class="dropdown-item">
                                                                            <form id="formDelete{{ $childComment->id }}"
                                                                                data-url="{{ route('comments.destroy', ['comment' => $childComment->id]) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $childComment->id }}">
                                                                                <a class="dropdown-link text-alizarin"
                                                                                    id="commentId"
                                                                                    data-id="{{ $childComment->id }}"
                                                                                    href="javascript:void(0)" onclick="deleteComment({{ $childComment->id }}, {{ $comment->id }})"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#commentModal">
                                                                                    Delete
                                                                                </a>
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <p
                                                            class="mb-2 line-height-md comment-content {{ $childComment->id }}">
                                                            {{ $childComment->content }}</p>
                                                            <div class="edit-comment {{ $childComment->id }}">
                                                                <div class="bg-portgore rounded p-1 p-md-4 mb-4">
                                                                    <form
                                                                        data-url="{{ route('comments.update', ['comment' => $childComment->id]) }}"
                                                                        id="formEdit{{ $childComment->id }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <textarea class="form-control placeholder-1 bg-dark border-0 mb-4" id="content{{ $childComment->id }}"
                                                                            name="content" rows="3" placeholder="Add you comment">{{ $childComment->content }}</textarea>
                                                                        <button type="button"
                                                                            class="btn btn-orange btn-block mw-md-200p"
                                                                            onclick="submitForm({{ $childComment->id }})">SUBMIT</button>
                                                                        <a class="btn btn-gray-200 btn-block mw-md-200p btn-edit"
                                                                            data-comment-id="{{ $childComment->id }}">CANCEL</a>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        <div class="mb-4">
                                                            <button class="btn fa-regular fa-flag"></button>Report 
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                        <a class="mb-6 btn" href="javascript:void(0)">
                                            <span class="hide-reply {{ $comment->id }}"
                                                data-parentId="{{ $comment->id }}">
                                                <i class="fa-solid fa-chevron-up"></i> Hide comments
                                            </span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </ul>

                <div class="bg-portgore rounded p-6 p-md-9 mb-8">
                    <h3 class="text-white mb-2">Add Comment</h3>
                    <div class="">What is it like to Lesson?</div>
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input name="lesson_id" type="hidden" value="{{ $lesson->id }}">
                        <div class="form-group mb-6">
                            <label id="label_content" class="text-white" for="content">Content</label>
                            <textarea class="form-control placeholder-1 bg-dark border-0" id="content-text" name="content" rows="5"
                                placeholder="Content"></textarea>
                        </div>

                        <button type="submit" class="btn btn-orange btn-block mw-md-300p">SUBMIT</button>
                    </form>
                </div>

                <div class="d-md-flex align-items-center justify-content-between">
                    <a href="#"
                        class="btn btn-blue d-flex align-items-center mb-5 mb-md-0 btn-block mw-md-280p justify-content-center">
                        <i class="fas fa-arrow-left font-size-xs"></i>
                        <span class="ms-3">Introduction</span>
                    </a>
                    <a href="#"
                        class="btn btn-blue d-flex align-items-center btn-block mw-md-280p justify-content-center mt-0">
                        <span class="me-3">Structure of the course</span>
                        <i class="fas fa-arrow-right font-size-xs"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4">

                <div class="bg-portgore rounded p-6">
                    <!-- Search -->
                    <form class="mb-5">
                        <div class="input-group rounded">
                            <div class="input-group-prepend">
                                <button class="btn btn-sm text-secondary bg-dark" type="submit">
                                    <!-- Icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.80758 0C3.95121 0 0 3.95121 0 8.80758C0 13.6642 3.95121 17.6152 8.80758 17.6152C13.6642 17.6152 17.6152 13.6642 17.6152 8.80758C17.6152 3.95121 13.6642 0 8.80758 0ZM8.80758 15.9892C4.8477 15.9892 1.62602 12.7675 1.62602 8.80762C1.62602 4.84773 4.8477 1.62602 8.80758 1.62602C12.7675 1.62602 15.9891 4.8477 15.9891 8.80758C15.9891 12.7675 12.7675 15.9892 8.80758 15.9892Z"
                                            fill="currentColor" />
                                        <path
                                            d="M19.762 18.6121L15.1007 13.9509C14.7831 13.6332 14.2687 13.6332 13.9511 13.9509C13.6335 14.2682 13.6335 14.7831 13.9511 15.1005L18.6124 19.7617C18.7712 19.9205 18.9791 19.9999 19.1872 19.9999C19.395 19.9999 19.6032 19.9205 19.762 19.7617C20.0796 19.4444 20.0796 18.9295 19.762 18.6121Z"
                                            fill="currentColor" />
                                    </svg>

                                </button>
                            </div>
                            <input class="form-control form-control-sm border-0 ps-0 bg-dark" type="search"
                                placeholder="Search item" aria-label="Search">
                        </div>
                    </form>
                    @foreach ($topics as $key => $topic)
                        <div id="accordionCurriculum" class="">
                            <div class="overflow-hidden bg-dark rounded mb-6">
                                <div class="d-flex align-items-center" id="curriculumheading{{ $key }}">
                                    <h5 class="mb-0 w-100">
                                        @php
                                            $lessonsCompleted = $topic->lessons->filter(function ($lesson) {
                                                return $lesson->processing ->isNotEmpty();
                                            })->count();
                                        @endphp
                                        <button
                                            class="d-flex align-items-center p-5 min-height-80 text-white fw-medium collapse-accordion-toggle line-height-one"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#Curriculumcollapse{{ $key }}" aria-expanded="true"
                                            aria-controls="Curriculumcollapse{{ $key }}">
                                            <span class="mx-1">
                                                {{ $lessonsCompleted }}/{{ $topic->lessons->count() }}
                                            </span>
                                            <span class="me-4 text-white d-flex">
                                                <!-- Icon -->
                                                <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="15" height="2" fill="currentColor" />
                                                </svg>

                                                <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 7H15V9H0V7Z" fill="currentColor" />
                                                    <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor" />
                                                </svg>
                                            </span>

                                            {{ $topic->name }}
                                        </button>
                                    </h5>
                                </div>
                                @foreach ($topic->lessons as $les)
                                    <div id="Curriculumcollapse{{ $key }}" class="collapse show"
                                        aria-labelledby="curriculumheading{{ $key }}"
                                        data-parent="#accordionCurriculum">

                                        <div
                                            class="{{ $lesson->id === $les->id ? 'bg-secondary' : ''}}  border-top px-5 border-color-20 py-4 min-height-70 d-md-flex align-items-center">
                                            <div class="d-flex align-items-center me-auto mb-4 mb-md-0">
                                                <div class="text-secondary d-flex">
                                                    @if ($les->file_type == 'pdf')                                              
                                                        <svg width="14" height="18" viewBox="0 0 14 18"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12.5717 0H4.16956C4.05379 0.00594643 3.94322 0.0496071 3.85456 0.124286L0.413131 3.57857C0.328167 3.65957 0.280113 3.77191 0.280274 3.88929V16.8514C0.281452 17.4853 0.794988 17.9988 1.42885 18H12.5717C13.1981 17.9989 13.7086 17.497 13.7203 16.8707V1.14857C13.7191 0.514714 13.2056 0.00117857 12.5717 0ZM8.18099 0.857143H10.6988V4.87714L9.80527 3.45214C9.76906 3.39182 9.71859 3.3413 9.65827 3.30514C9.45529 3.18337 9.19204 3.24916 9.07027 3.45214L8.18099 4.87071V0.857143ZM3.7367 1.46786V2.66143C3.73552 3.10002 3.38029 3.45525 2.9417 3.45643H1.74813L3.7367 1.46786ZM12.8546 16.86C12.8534 17.0157 12.7274 17.1417 12.5717 17.1429H1.42885C1.42665 17.1429 1.42445 17.143 1.42226 17.143C1.26486 17.1441 1.13635 17.0174 1.13527 16.86V4.32214H2.9417C3.85793 4.31979 4.60006 3.57766 4.60242 2.66143V0.857143H7.31527V5.23286C7.31345 5.42593 7.37688 5.61391 7.49527 5.76643C7.67533 5.99539 7.98036 6.08561 8.25599 5.99143L8.28813 5.98071C8.49272 5.89484 8.66356 5.7443 8.77456 5.55214L9.44099 4.48071L10.1074 5.55214C10.2184 5.7443 10.3893 5.89484 10.5938 5.98071C10.8764 6.0922 11.1987 6.00509 11.3867 5.76643C11.5051 5.61391 11.5685 5.42593 11.5667 5.23286V0.857143H12.5717C12.7266 0.858268 12.8523 0.982982 12.8546 1.13786V16.86Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M10.7761 14.3143H3.22252C2.98584 14.3143 2.79395 14.5062 2.79395 14.7429C2.79395 14.9796 2.98584 15.1715 3.22252 15.1715H10.7761C11.0128 15.1715 11.2047 14.9796 11.2047 14.7429C11.2047 14.5062 11.0128 14.3143 10.7761 14.3143Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M10.7761 12.2035H3.22252C2.98584 12.2035 2.79395 12.3954 2.79395 12.6321C2.79395 12.8687 2.98584 13.0606 3.22252 13.0606H10.7761C11.0128 13.0606 11.2047 12.8687 11.2047 12.6321C11.2047 12.3954 11.0128 12.2035 10.7761 12.2035Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M10.7761 10.0928H3.22252C2.98584 10.0928 2.79395 10.2847 2.79395 10.5213C2.79395 10.758 2.98584 10.9499 3.22252 10.9499H10.7761C11.0128 10.9499 11.2047 10.758 11.2047 10.5213C11.2047 10.2847 11.0128 10.0928 10.7761 10.0928Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M10.7761 7.98218H3.22252C2.98584 7.98218 2.79395 8.17407 2.79395 8.41075C2.79395 8.64743 2.98584 8.83932 3.22252 8.83932H10.7761C11.0128 8.83932 11.2047 8.64743 11.2047 8.41075C11.2047 8.17407 11.0128 7.98218 10.7761 7.98218Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    @else
                                                    <svg width="16" height="16" viewBox="0 0 16 16"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div class="ms-4">
                                                    {{ $les->title }}
                                                </div>
                                            </div>

                                            <div
                                                class="d-flex align-items-center overflow-auto overflow-md-visible flex-shrink-all">
                                                <div
                                                    class="badge btn-orange-soft text-white-70 me-5 font-size-sm fw-normal py-2">
                                                    {{ $les->lesson_duration }}
                                                </div>
                                                <a href="{{ route('courses.lessons.show', ['courseId' => $course->id, 'lessonId' => $les->id])}}" class="text-secondary d-flex">
                                                    <!-- Icon -->
                                                    <svg width="14" height="16" viewBox="0 0 14 16"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.8704 6.15374L3.42038 0.328572C2.73669 -0.0923355 1.9101 -0.109836 1.20919 0.281759C0.508282 0.673291 0.0898438 1.38645 0.0898438 2.18929V13.7866C0.0898438 15.0005 1.06797 15.9934 2.27016 16C2.27344 16 2.27672 16 2.27994 16C2.65563 16 3.04713 15.8822 3.41279 15.6591C3.70694 15.4796 3.79991 15.0957 3.62044 14.8016C3.44098 14.5074 3.05697 14.4144 2.76291 14.5939C2.59188 14.6982 2.42485 14.7522 2.27688 14.7522C1.82328 14.7497 1.33763 14.3611 1.33763 13.7866V2.18933C1.33763 1.84492 1.51713 1.53907 1.81775 1.3711C2.11841 1.20314 2.47294 1.21064 2.76585 1.39098L12.2159 7.21615C12.4999 7.39102 12.6625 7.68262 12.6618 8.01618C12.6611 8.34971 12.4974 8.64065 12.2118 8.81493L5.37935 12.9983C5.08548 13.1783 4.9931 13.5623 5.17304 13.8562C5.35295 14.1501 5.73704 14.2424 6.03092 14.0625L12.8625 9.87962C13.5166 9.48059 13.9081 8.78496 13.9096 8.01868C13.9112 7.25249 13.5226 6.55524 12.8704 6.15374Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                    <input {{ $les->processing->isNotEmpty() ? 'checked' : '' }} onclick="return false;" readonly class="mx-4" type="checkbox">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="border-top px-5 border-color-20 py-4 min-height-70 d-flex justify-content-center align-items-center">
                                    @if ($lessonsCompleted == $topic->lessons->count())  
                                    
                                        @if ($topic->results->isNotEmpty())
                                            <a href="{{ route('courses.topic.results', ['courseId' => $course->id, 'topicId' => $topic->id]) }}" class="text-secondary">
                                                You have completed
                                            </a>
                                            <input checked onclick="return false;" readonly class="mx-4" type="checkbox"> 
                                        @else
                                            <a href="{{ route('courses.topic.questions', ['courseId' => $course->id, 'topicId' => $topic->id]) }}" class="text-secondary">
                                                Exercises for this topic
                                            </a>
                                            <input onclick="return false;" readonly class="mx-4" type="checkbox"> 
                                        @endif
                                    @else
                                        <p>
                                            Completed lessons to unlock
                                        </p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="nextLessonModal" tabindex="-1" role="dialog" aria-labelledby="nextLessonModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Next Lesson</h5>
            </div>
            <div class="modal-body delete_item">
                Are you sure complete this lesson?
            </div>
            <div class="modal-footer">
                <button type="button" id="cancelDelete" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="lessonCompleteForm" action="{{ route('courses.lesson.complete', ['courseId' => $course->id, 'lessonId' => $lesson->id]) }}" method="post">
                    @csrf
                    <input type="submit" class="btn btn-danger"  value="OK">
                </form>
            </div>
        </div>
    </div>
    </div>

    <script>
        var video = document.getElementById('lessonVideo');
        var completedButton = document.querySelector('.completedLesson');

        // video.addEventListener('ended', function() {
        //     // Submit the form when the video ends
        //     document.querySelector('#lessonCompleteForm').submit();
        // });

        video.addEventListener('timeupdate', function() {
            var ninetyPercentDuration = video.duration * 0.8;

            if (video.currentTime >= ninetyPercentDuration) {
                // If less than or equal to 5 seconds remaining, show the completed lesson button
                completedButton.style.display = 'flex';
                completedButton.classList.add('show');
            }
        });
    </script>
@endsection
