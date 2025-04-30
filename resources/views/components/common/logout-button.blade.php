<form action="{{ route('logout') }}" method="POST" class="d-inline-block mt-3">
    @csrf
    <button type="submit" class="btn btn-outline-danger">
        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
    </button>
</form>
