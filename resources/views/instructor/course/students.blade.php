@extends('instructor.layouts.app')

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
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Time Enrollment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enrollments as $enroll)
                                    <tr>
                                        <th scope="row">{{ $loop->index+1 }}</th>
                                        <td>
                                            <img style="width: 100px; height:100px" class="img-circle" src="{{ $enroll->user->profile->avatar }}" alt="">
                                        </td>
                                        <td style = "text-align: start ">{{ $enroll->user->profile->full_name }} <span>{{ $enroll->user->username }}</span></td>
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
