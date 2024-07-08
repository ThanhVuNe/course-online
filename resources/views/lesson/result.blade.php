@extends('layouts.lesson')
@section('title', 'Quiz Result')
@section('style')
    <style>
    .result{
        /* background-color: black; */
        margin-bottom: 20px;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 4px 8px 0 rgba(225, 217, 217, 0.2), 0 6px 20px 0 rgba(237, 235, 235, 0.19);
    }

    @media (max-width: 768px) {
        /* Điều chỉnh bố trí cho màn hình nhỏ hơn */
        .product {
            width: 100%; /* Hiển thị sản phẩm theo cột trên màn hình nhỏ */
        }
        .img-header {
            width: 50px;
            height: 50px;
        }
        .navbar-nav {
            background-color: #343a40!important;
        }
        .navbar-nav .nav-link{
            padding-left: 20px;
        }
    }
    </style>
@endsection
@section('content')
    <!-- COURSE
        ================================================== -->
    <div class="container-fluid">
      
    <main style="margin-top: 150px; margin-bottom: 150px">
    
        <div class="container">
            @if (isset($answers))
            <h1 class="text-center text-danger font-weight-bold mb-4">Current result: {{ $answers['answers']->sum('is_correct') }}/{{ $answers['answers']->count() }} ({{ $answers['average'] }})</h1>
            <div class="result">
                <ul>
                    @foreach ($answers['answers'] as $answer)       
                        <li style="font-size: 25px;">
                            Question {{ $answer->question->title }}:
                            @if ($answer->is_correct == 1)
                                <p style="color: greenyellow">
                                    {{ $answer->title }}
                                    <i class="fa-solid fa-check" aria-hidden="true"></i>
                                </p>
                            @else 
                                <p style="color: red">
                                    {{ $answer->title }}
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </p>
                            @endif
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div>
                <ul>
                    <h1 class="text-center text-danger font-weight-bold mb-4">
                        All results you have completed
                    </h1>

                    <div class="px-4 py-4 d-flex justify-content-center">
                        <table class="table table-primary table-striped table-hover ">
                            <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Questions</th>
                                <th scope="col">Total point</th>
                                <th scope="col">Correct answer</th>
                                <th scope="col">Incorrect answer</th>
                                <th scope="col">Your point</th>
                                <th scope="col">Day</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $item)  
                                    <tr class="table-info">
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $item->topic->questions->count() }}</td>
                                        <td> 10</td>
                                        <td>{{ $item->correct }}</td>
                                        <td>{{ $item->topic->questions->count() - $item->correct }}</td>
                                        <td>{{ number_format(($item->correct/$item->topic->questions->count())*10, 2) }}({{ number_format(($item->correct/$item->topic->questions->count())*100) }}%) </td>
                                        <td>{{ $item->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </ul>
            </div>
            <div class="submit-button mt-3 mb-5 text-center">
                <a href="{{ route('courses.lessons.show', ['courseId' => $course->id, 'lessonId' => $nextTopic->lessons->first()->id])}}" class="btn btn-danger float-end"> Next lesson </a>
                <a href="{{ route('courses.topic.questions', ['courseId' => $course->id, 'topicId' => $result->first()->topic->id]) }}" class="btn btn-danger float-end mx-4">
                    Start test
                </a>
            </div>
        </div>
    </main>
    </div>

@endsection
