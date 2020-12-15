
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Training Index') }}</div>

                <div class="card-body">

                <table class="table">
                <thead>
                 <tr>
                 <th> ID </th>
                 <th> Title</th>
                 <th> Description </th>
                 <th> Created </th>
                 <th> Created DateTime </th>
                 </tr>
                 </thead>
                 
 
                 <tbody>
                   @foreach($trainings as $training)
                   <tr>
                   <td>{{ $training->id}}</td>
                   <td>{{ $training->title}}</td>
                   <td>{{ $training->Description}}</td>
                   <td>{{ $training->Created ? $traininig->created->diffForHumans(): 'Undefined'}}</td>
                   <td>{{ $training->Created ?? '-'}}</td>
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
