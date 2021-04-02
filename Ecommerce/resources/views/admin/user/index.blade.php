@extends('layouts.masterAdmin')
@section('title', 'Admin - users')
@section('content')
    <section class="container">
        <h3 class="mt-5 h3">All Users</h3>
        @if (Session::get('error'))
            <h3 class="text-danger">{{ Session::get('error') }}</h3>
        @endif
        <a class="btn btn-dark" href="{{ route('registerUserAdmin') }}">Create User</a>
        <form action="#filter" method="get" class="mb-5" id="#filter">
            <input type="hidden" name="page" value="{{ $filter['page'] }}">
            <div class="row">
                <div class="col-md-2">
                    <select class="form-control" onchange="this.form.submit()" name="perPage">
                        <option @if (!empty($filter['perPage']) && $filter['perPage'] === '20') selected @endif value="10">10 per Page</option>
                        <option @if (!empty($filter['perPage']) && $filter['perPage'] === '20') selected @endif value="20">20 per Page</option>
                        <option @if (!empty($filter['perPage']) && $filter['perPage'] === '30') selected @endif value="30">30 per Page</option>
                        <option @if (!empty($filter['perPage']) && $filter['perPage'] === '40') selected @endif value="40">40 per Page</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control" onchange="this.form.submit()" name="filter" id="">
                        <option value="">Sort By Name</option>
                        <option @if (!empty($filter['filter']) && $filter['filter'] === 'asc') selected @endif value="asc">Asc</option>
                        <option @if (!empty($filter['filter']) && $filter['filter'] === 'desc') selected @endif value="desc">Desc</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="row users__container">
            <div class="col-md-8">
                @foreach ($users as $user)

                    @php
                        $photo = $user->avatar ?? 'user.svg';
                    @endphp
                    <div class="user__item">
                        <input type="checkbox" class="mass__deletion--users" value="{{ $user->id }}">
                        <a href="{{ route('singleUser', $user->id) }}" class="user__link">
                            <div class="user__item--info">
                                <figure>
                                    <img class="user__img" src="{{ url('storage/img/users/' . $photo) }}" alt="">
                                </figure>
                                <div class="user__info">
                                    <p class="user__name">Name: <span>{{ $user->name . ' ' . $user->last_name }}</span>
                                    </p>
                                    <p class="user__email">E-mail: <span>{{ $user->email }}</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                @php
                    $next = $filter['page'] <= 1 ? 2 : $filter['page'] + 1;
                    $previous = $filter['page'] <= 1 ? 1 : $filter['page'] - 1;
                    
                    $nextPage = '?page=' . $next;
                    $previousPage = '?page=' . $previous;
                    
                    if (!empty($filter['perPage'])) {
                        $nextPage .= '&perPage=' . $filter['perPage'];
                        $previousPage .= '&perPage=' . $filter['perPage'];
                        $filter['perPage'] = (int) $filter['perPage'];
                    }
                    
                    if (!empty($filter['filter'])) {
                        $nextPage .= '&filter=' . $filter['filter'];
                        $previousPage .= '&filter=' . $filter['filter'];
                    }
                    
                    $nextPage .= '#filter';
                    $previousPage .= '#filter';
                    $filter['page'] = (int) $filter['page'];
                    $last = $users->lastPage();
                @endphp
                <div class="pagination">
                    @if ($last === $filter['page'] && $filter['page'] > 1)
                        <a class="pagination__link" href="{{ url(route('users') . $previousPage) }}">Prev</a>
                        <span class="pagination__link">Next</span>
                    @elseif($last > $filter['page'] && $filter['page'] > 1)
                        <a class="pagination__link" href="{{ url(route('users') . $previousPage) }}">Prev</a>
                        <a class="pagination__link" href="{{ url(route('users') . $nextPage) }}">Next</a>
                    @elseif($filter['page'] === 1 && $last > 1)
                        <span class="pagination__link">Prev</span>
                        <a class="pagination__link" href="{{ url(route('users') . $nextPage) }}">Next</a>
                    @endif
                </div>
            </div>
            @if (!empty($users))
                <div class="col-md-4">
                    <button class="delete__all btn btn-danger">Delete selected users</button>
                </div>
            @endif
        </div>
    </section>
    @csrf
@endsection
@section('page', url('js/pages/users.js'))
