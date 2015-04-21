<div class="row">
    <div class="col-md-12">
        <h2>Membros</h2>
        <div class="panel panel-default filterable">
            <div class="panel-heading text-right">
                <div class="btn-group">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                        Ações <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li id="btn-add-member"><a href="#">Adicionar</a></li>
                        <li id="btn-filter-member"><a href="#">Filtrar</a></li>
                    </ul>
                </div>
                <button class="btn btn-default" id="btn-load-member">
                    Atualizar
                </button>
            </div>
            <table id="table-members" class="table table-bordered table-condensed table-hover table-responsive table-striped">
                <thead>
                    <tr class="filters">
                        <th class="col-md-2 text-center"><input type="text" class="form-control" placeholder="Membro" disabled></th>
                        <th class="col-md-2 text-center visible-sm visible-md visible-lg"><input type="text" class="form-control" placeholder="Email" disabled></th>
                        <th class="col-md-3 text-center visible-sm visible-md visible-lg"><input type="text" class="form-control" placeholder="Localização" disabled></th>
                        <th class="col-md-3 text-center visible-sm visible-md visible-lg"><input type="text" class="form-control" placeholder="Interesse" disabled></th>
                        <th class="col-md-2 text-center visible-sm visible-md visible-lg">#</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhum registro encontrado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="modal-add-member" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Formulário de Membros</h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#informations" role="tab" data-toggle="tab">Informações</a></li>
                    <li role="presentation"><a href="#interests" role="tab" data-toggle="tab">Interesse</a></li>
                </ul>
                <form role="form">
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="informations">
                            <input type="hidden" id="id" name="id" />
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">Nome</span>
                                    <input type="text" class="form-control" placeholder="Nome" id="name" name="name"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">Email</span>
                                    <input type="email" class="form-control" placeholder="Email" id="email" name="email"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">Localização</span>
                                    <input type="text" class="form-control" placeholder="Localização" id="localization" name="localization"/>
                                </div>
                            </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="interests">
                        <?php
                        if (is_array($list_interests)) {
                            foreach ($list_interests as $interest) {
                                $this->load->view('members/row_interest', $interest);
                            }
                        }
                        ?>
                    </div>
                  </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btn-submit-member">Cadastrar</button>
            </div>
        </div>
    </div>
</div>
