@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Show training') }} by {{$training->user->name}} title {{$training->title}}</div>

                <div class="card-body">
                  
            
                     <div class="form-group">
                     <label>Title</label>
                     <input type="text" name="title" class="form-control" required value="{{ $training->title}}" readonly>
                     </div>

                     <div class="form-group">
                     <label>Description</label>
                     <textarea name="description" class="form-control"  readonly>{{ $training->description}} </textarea>
                     </div>

                     <div class="form-group">
                     <label>Trainer</label>
                     <input type="text" name="trainer" class="form-control" required value="{{ $training->trainer}}" readonly>
                     </div>
                     
                     <!-- @if($training->attachment) -->
                     <!--<a href="{{ asset('storage/'.$training->attachment) }}" target="_blank"> Open Attachment </a>-->
                     <a href="{{ $training->attachment_url }}" target="_blank"> Open Attachment </a>
                     <!-- @endif -->
                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
