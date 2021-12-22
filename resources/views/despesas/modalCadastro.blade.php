<div class="modal fade" id="modalCadastroDespesas" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar despesa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" id="teste">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="descricao" class="form-label">Descrição</label>
                            <input type="text" name="descricao" class="form-control" id="descricao" placeholder="Digite uma descrição">
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <label for="valor" class="form-label">Valor</label>
                            <input type="text" name="valor" class="form-control" id="valor" placeholder="R$ 00,00">
                        </div>
                        <div class="col-6">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select class="form-select" id="categoria" name="categoria" aria-label="Default select example">
                                <option selected>Selecione uma categoria</option>
                                <option value="1">Alimentação</option>
                                <option value="2">Entreterimento</option>
                                <option value="3">Lazer</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="salvar">Salvar</button>
                </div>
            </form>


        </div>
    </div>
</div>
