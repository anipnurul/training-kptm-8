
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

        @if (session()->has('alert'))
           <div class="alert {{session()->get('alert-type')}}">
             {{session()->get('alert')}}
            </div>
        @endif
            <div class="card">
                <div class="card-header">{{ __('Training Index') }}
                <div class="float-right">
                <form 
                method="GET" action="">
                <div class="input-group">
                <input type="text" name="keyword" class="form-control"/>
                <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
                </div>
                </div>
                </form>
                
                </div>

                <div class="card-body">

                <table class="table">
                <thead>
                 <tr>
                 <th> ID </th>
                 <th> Title</th>
                 <th> Description </th>
                 <th> Creator </th>
                 <th> Created </th>
                 <th> Created DateTime </th>
                 <th> Actions </th>
                 </tr>
                 </thead>
                 
 
                 <tbody>
                   @foreach($trainings as $training)
                   <tr>
                   <td>{{ $training->id}}</td>
                   <td>{{ $training->title}}</td>
                   <td>{{ $training->description}}</td>
                   <td>{{ $training->user->name}} 
                   <strong> ({{ $training->user->email}}) </strong>
                   </td>
                   <td>{{ $training->Created ? $traininig->created->diffForHumans(): 'Undefined'}}</td>
                   <td>{{ $training->Created ?? '-'}}</td>
                   <td>
                   @can('view',$training)
                   <a href="{{route('trainings:show', $training)}}" class="btn btn-primary"> View </a>
                   @endcan
                   </td>
                   <td>
                   @can('update',$training)
                   <a href="{{route('trainings:edit',$training)}}" class="btn btn-success"> Edit </a>
                   @endcan
                   </td>
                   <td>
                   @can('delete',$training)
                   <a onclick="return confirm('Are you sure?')" href="{{route('trainings:delete',$training)}}" class="btn btn-danger"> Delete </a>
                   @endcan
                   </td>
                </tr>
                    @endforeach
                </tbody>
                </table>
                {{ $trainings
                ->appends([
                'keyword'=>request()->get('keyword')
                ])
                ->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
