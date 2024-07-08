@extends('layouts.lesson')
@section('title', 'Quiz of topic')
@section('style')
    <style>
    .question{
        /* background-color: black; */
        margin-bottom: 20px;
        border-radius: 20px;
        padding: 0px 40px;
        box-shadow: 0 4px 8px 0 rgba(225, 217, 217, 0.2), 0 6px 20px 0 rgba(237, 235, 235, 0.19);
    }

/* CSS */
#timer {
    position: fixed;
    top: 200px; /* Khoảng cách từ phía trên của trình duyệt */
    right: 10px; /* Khoảng cách từ phía phải của trình duyệt */
    background-color: #fff; /* Màu nền của thời gian */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    z-index: 1000; /* Để đảm bảo thời gian luôn hiển thị phía trên nội dung */
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
      
    <main style="margin-top: 150px;">
    
        <div class="container">
            <h1 class="text-center text-danger font-weight-bold mb-4">Quiz for topic {{ $questions->name }}</h1>
            {{-- <div id="timer">Current time: 3:00</div> --}}

            <form id="quiz-form" action="{{ route('courses.topic.submit.questions', ['courseId' => $course->id  ,'topicId' => $questions->id]) }}" method="POST">
                @csrf
                <!-- Câu 1 -->
                <div class="question">
                    @foreach ($questions->questions as $question)
                    <div class=" py-5">
                        <p style="font-size: 25px;">Question {{ $loop->index + 1 }}: {{ $question->title }}</p>
                        @foreach ($question->answers as $answer)
                        <div>
                            <label style="font-size: 20px;"  class="text-white">
                                <input type="radio" name="q{{ $loop->parent->index + 1 }}" value="{{ $answer->id }}"> {{ $answer->title }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
        
                <div class="submit-button mt-3 mb-3 text-center">
                    <input onclick="return confirm('Are you sure to complete this quiz?')" class="btn btn-danger" type="submit" value="Submit">
                </div>
            </form>
        </div>
    </main>
    </div>

    <script>
        function handleBeforeUnload(event) {
            // Cancel the event
            event.preventDefault();
            // Chrome requires returnValue to be set
            event.returnValue = '';

            // Optionally, you can display a confirmation message to the user
            var confirmationMessage = 'Are you sure you want to leave this page?';
            (event || window.event).returnValue = confirmationMessage; // For IE and Firefox
            return confirmationMessage;
        }

        // Add event listener for beforeunload event
        window.addEventListener('beforeunload', handleBeforeUnload);

        // Add event listener to the form submit event
        document.querySelector('#quiz-form').addEventListener('submit', function() {
            // Remove the beforeunload event listener temporarily
            window.removeEventListener('beforeunload', handleBeforeUnload);
        });
    </script>
@endsection
