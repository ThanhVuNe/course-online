@extends('instructor.layouts.app')
@section('title', 'Your Students')
@section('style')
    <style>
        .progress {
            height: 15px;
            background-color: #f5f5f5;
            border-radius: 10px;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .progress-bar {
            background-color: blueviolet;
            border-radius: 10px;
        }
    </style>
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>List Users</h1>
        </div><!-- End Page Title -->
        <section class="section">
            <div>
                <div class="card">
                    <div class="card-body">
                        <!-- Primary Color Bordered Table -->
                        <table class="table table-bordered border-primary" style="text-align : center">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Index</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Progress</th>
                                    <th scope="col">Time Enrollment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enrollments as $enroll)
                                    <tr>
                                        <th scope="row">{{ $loop->index+1 }}</th>
                                        <td style="width: 150px;">
                                            <div class="d-flex" style="flex-direction: column;">
                                                <div class="d-flex justify-content-center">

                                                    <img style="width: 100px; height:100px; border-radius: 100%" class="img-" src="{{ $enroll->user->profile->avatar }}" alt="">
                                                </div>
                                                <div style="text-align: center">
                                                    {{ $enroll->user->profile->full_name }} <span>{{ $enroll->user->username }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>            
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $enroll->progress }}%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <h5>{{ number_format($enroll->progress) }}% completed</h5>
                                        </td>
                                        <td>{{ $enroll->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Primary Color Bordered Table -->
                    </div>
                </div>
                {{-- <nav class="mb-11" aria-label="Page navigationa">
                    <ul class="pagination justify-content-center">
                        {!! $courses->links('pagination::bootstrap-4') !!}
                    </ul>
                </nav> --}}
            </div>
        </section>
    </main>
@endsection
