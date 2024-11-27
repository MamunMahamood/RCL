@if (session('error'))
<div class="alert alert-danger text-center">
    {{ session('error') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('primary'))
<div class="alert alert-primary">
    {{ session('primary') }}
</div>
@endif