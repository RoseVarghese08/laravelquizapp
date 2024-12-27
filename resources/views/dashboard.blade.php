@extends('layouts.app')

@section('content')
<div class="container text-center" style="background: linear-gradient(to right, rgba(9,121,187,255), rgba(115,86,183,255)); padding: 50px; color: white; overflow: hidden;">

    <h2>Select Quiz Type</h2>

    <div class="mt-5">
        <div class="row">
            @foreach ($categories as $category => $details)
                <div class="col-md-6 mb-4"> 
                    <a href="{{ route('quiz.start', ['category' => $category]) }}" class="btn btn-lg btn-info" style="width: 100%; padding: 20px;">
                        {{ $category }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>

 
    <div class="mt-4">
        <div class="col-12">
            <nav class="d-flex justify-content-center">
                <ul class="pagination">
                   

                 
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                            <a class="page-link" href="?page={{ $i }}" style="border-radius: 50%; background-color: {{ $i == $currentPage ? '#1cb5e0' : '#ddd' }}; color: #fff; width: 30px; height: 30px; text-align: center;">
                              
                            </a>
                        </li>
                    @endfor

                  
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
