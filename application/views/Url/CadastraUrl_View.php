<div class="container py-5 margin_top_menu">
    <div class="row py-5">
        <div class="col-10 border mx-auto padding_form">
            <h4 class="text-center font-weight-bold py-2">Cadastrar URL</h4>
            <div class="col-11 mx-auto py-3">
                <form method="POST" action="<?= base_url('Url/realizaCadastroUrl') ?>">
                    <div class="form-group">
                        <label class="font-weight-bold">URL:</label>
                        <input type="url" class="form-control" id="url" name="url" placeholder="https://endereco.com" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Finalidade da URL:</label>
                        <input type="text" class="form-control" id="finalidadeurl" name="finalidadeurl" placeholder="Ex.: Busca dados de clientes" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Descrição: </label>
                        <textarea type="text" rows="3" class="form-control" id="descricaourl" name="descricaourl" placeholder="Descrição..."></textarea>
                    </div>
                    <div class="form-group py-2">
                        <button type="submit" class="btn btn-dark float-right font-weight-bold">Cadastrar</button>
                    </div>
                </form>
                <?php if ((isset($erro)) && ($erro == true)) { ?>
                    <div class="col-12 py-5">
                        <div class="alert alert-danger text-center mx-auto animated pulse delay-1s" role="alert">
                            <b class="font-weight-bold">Erro ao cadastrar!</b> Por favor, tente novamente.
                        </div>
                    </div>
                <?php } ?>
                <?php if ((isset($sucesso)) && ($sucesso == true)) { ?>
                    <div class="col-12 py-5">
                        <div class="alert alert-success text-center mx-auto animated pulse delay-1s" role="alert">
                            <b class="font-weight-bold">URL cadastrada com sucesso!</b>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>