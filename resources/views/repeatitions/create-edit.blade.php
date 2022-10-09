<div class="container">
    @if (!empty($articles))
    @if (session()->has('changed'))
    <div class="alert alert-success" role="alert"> {{ session()->get('changed') }} </div>
    @endif
    @if (session()->has('indication'))
    <div class="alert alert-danger" role="alert"> {{ session()->get('indication') }} </div>
    @endif
    @endif
    <form method="POST" action="{{ empty($articles) ? route('articles-store') : route('articles-update', $articles['id']) }}">
        @if (!empty($articles))
        @method('PATCH')
        @endif
        @csrf
        <div class="mb-3">
            <label for="exampleInputTitle" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ empty($articles) ? old('title') : old('title', $articles['title']) }}">
            @error('title')
            <div class="alert alert-danger" role="alert">
                <a href="#" class="alert-link">{{ $message }}</a>
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">Description</label>
            <input name="description" type="text" class="form-control" id="exampleInputDescription" value="{{ empty($articles) ? old('description') : old('description', $articles['description']) }}">
            @error('description')
            <div class="alert alert-danger" role="alert">
                <a href="#" class="alert-link">{{ $message }}</a>
            </div>
            @enderror
        </div>
        <p>Status</p>
        <div class="mb-3">
            @if (empty($articles) ? old('status') === 1 : old('status', $articles['status']) === 1)
            <input type="radio" class="btn-check" name="status" id="success-outlined" autocomplete="off" value=1 checked>
            <label class="btn btn-outline-success" for="success-outlined">Active</label>
            @else
            <input type="radio" class="btn-check" name="status" id="success-outlined" autocomplete="off" value=1>
            <label class="btn btn-outline-success" for="success-outlined">Active</label>
            @endif
            @if (empty($articles) ? old('status') === 0 : old('status', $articles['status']) === 0)
            <input type="radio" class="btn-check" name="status" id="danger-outlined" autocomplete="off" value=0 checked>
            <label class="btn btn-outline-danger" for="danger-outlined">Inactive</label>
            @else
            <input type="radio" class="btn-check" name="status" id="danger-outlined" autocomplete="off" value=0>
            <label class="btn btn-outline-danger" for="danger-outlined">Inactive</label>
            @endif
            @error('status')
            <div class="alert alert-danger" role="alert">
                <a href="#" class="alert-link">{{ $message }}</a>
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>
