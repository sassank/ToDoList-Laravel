@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts</div>
                <ul>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(Route::currentRouteName() === 'categories.edit')
                    {!! Form::model(
                        $category,
                        ['route' =>
                            ['categories.update', 'category' => $category],
                            'method' => 'put'
                        ])
                    !!}
                    @else
                    {!! Form::open(['route' => 'categories.store']) !!}
                    @endif

                        {!! Form::label('Name') !!}
                        {!! Form::text('name') !!}

                        @if(
                        Route::get('/medias/{file}', function() {
                            $path = storage_path('app/medias'.$file);
                            if(!File::exists($path)) {
                              abort(404);
                            }
                            $file = File::get($path);
                            $type = File::mimeType($path);
                            $reponse = Reponse::make($file, 200);
                            $response->header("Content-Type", $type);
                            return $reponse;
                          });
                        {!! Form::submit() !!}

                    {!! Form::close() !!}
                </ul>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
