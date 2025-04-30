<div class="modal fade" id="modalFoto" tabindex="-1" aria-labelledby="modalFotoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('usuarios.foto', $usuario->idUsuario) }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalFotoLabel">Seleccionar Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <input type="file" name="foto" id="fotoInput" class="form-control mb-3" accept="image/*" required>

                <div id="previewContainer" style="display: none;">
                    <label>Vista previa:</label><br>
                    <img id="previewImage" class="img-thumbnail" width="200">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="cancelarPreview()">Cancelar</button>
            </div>
        </form>
    </div>
</div>
