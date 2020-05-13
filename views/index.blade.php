@php
if(request()->getMethod() === 'POST'){
    \Illuminate\Support\Facades\Cache::forget(config('sdds.cache'));
    if(request('action') === 'ADD'){
        \Milestone\SDDS\Model\SDDS::create(request()->except(['action','new','update']));
    } elseif(request('action') === 'UPDATE') {
        \Milestone\SDDS\Model\SDDS::find(request('id'))->update(request()->except(['action','new','update']));
    }
}
@endphp<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>SDDS</title>
    <style>
        * { font-size: 12px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="navbar-brand" href="#">SDDS</a>
    </nav>
    <div class="container-fluid">
        @if(request('new') === '1' || request('update'))
            @php $sdds = request('update') ? \Milestone\SDDS\Model\SDDS::find(request('update')) : null @endphp
            <form method="post">
                <div class="row form-row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="mb-0">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $sdds ? $sdds->name : '' }}">
                            <input type="hidden" name="id" value="{{ $sdds ? $sdds->id : '' }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="mb-0">Description</label>
                            <input type="text" class="form-control" placeholder="Short details" name="detail" value="{{ $sdds ? $sdds->detail : '' }}">
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label class="mb-0">Domain (sub)</label>
                            <input type="text" class="form-control" placeholder="Domain" name="domain" value="{{ $sdds ? $sdds->domain : '' }}">
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label class="mb-0">Database (name)</label>
                            <input type="text" class="form-control" placeholder="Database name" name="database" value="{{ $sdds ? $sdds->database : '' }}">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label class="mb-0">Active</label>
                            <select class="form-control" name="active"><option value="Y" {{ ($sdds && $sdds->active === 'Y') ? 'selected' : '' }}>Y</option><option value="N" {{ ($sdds && $sdds->active === 'N') ? 'selected' : '' }}>N</option></select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="mb-0">DB Username</label>
                            <input type="text" class="form-control" placeholder="DB Username " name="username" value="{{ $sdds ? $sdds->username : '' }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="mb-0">DB Password</label>
                            <input type="text" class="form-control" placeholder="DB Password" name="password" value="{{ $sdds ? $sdds->password : '' }}">
                        </div>
                    </div>
                </div>
                <input type="submit" name="action" value="{{ $sdds ? 'UPDATE' : 'ADD' }}" class="btn btn-info float-right">
            </form>
        @endif
            <div class="table-responsive pt-3">
                <table class="table table-sm">
                    <thead><tr><th>#</th><th>Name</th><th>Database</th><th>Active</th><th> </th></tr></thead>
                    <tbody>
                    @forelse(\Milestone\SDDS\Model\SDDS::all() as $sdds)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sdds->name }}</td>
                            <td>{{ $sdds->database }}</td>
                            <td>{{ $sdds->active }}</td>
                            <td><a href="?update={{ $sdds->id }}" class="btn btn-sm btn-info">Update</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No records</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
    </div>
    <a href="?new=1" type="button" class="btn btn-info rounded-circle font-weight-bolder" style="position: absolute; bottom: 1rem; right: 1rem; padding: 15px 9px;">NEW</a>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>