
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Index') }}</div>

                <div class="card-body">

                <table class="table">
                <thead>
                 <tr>
                 <th> ID </th>
                 <th> Name</th>
                 <th> Email </th>
                 <th> Created At </th>
                 <th> Created DateTime </th>
                 </tr>
                 </thead>
                 
 
                 <tbody>
                   @foreach($users as $user)
                   <tr>
                   <td>{{ $user->id}}</td>
                   <td>{{ $user->name}}</td>
                   <td>{{ $user->email}}</td>
                   <td>{{ $user->Created ? $user->created->diffForHumans(): 'Undefined'}}</td>
                   <td>{{ $user->Created ?? '-'}}</td>
                </tr>
                    @endforeach
                </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
