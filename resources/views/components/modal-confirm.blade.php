<form action="{{ $action }}" method="POST" class="d-inline" onclick="return confirm('¿Seguro que deseas eliminar este registro?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn-modern btn-modern-outline btn-modern-sm btn-modern-icon"
            style="border-color: rgba(239,68,68,0.3); color: #DC2626;"
            title="Eliminar">
        <i class="bi bi-trash"></i>
    </button>
</form>
