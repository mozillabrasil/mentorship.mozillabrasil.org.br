var define;
var members = {
    url: function ($page, $id) {
        return URL_BASE + 'members/' + $page + ($.trim($id) ? '/' + $id : '');
    },
    saveOrUpdate: function (form) {
        var self = this;
        $.ajax({
            url: self.url('save_or_update'),
            method: 'POST',
            dataType: "json",
            data: $(form).serialize(),
            success: function ($json) {
                if ($.isPlainObject($json)) {
                    if ($json.success === true) {
                        $('#btn-load-member').click();
                    }
                }
            }
        });
    },
    applyRulesModalMember: function () {
        var self = this;
        $('#modal-add-member form').validate({
            submitHandler: function (form) {
                self.saveOrUpdate(form);
            },
            rules: {
                'name': {
                    required: true
                },
                'email': {
                    required: true,
                    email: true
                },
                'localization': {},
                'interest': {}
            },
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    },
    showModalMember: function ($objectId) {
        var self = this;
        var $modal = $('#modal-add-member');
        $.ajax({
            url: self.url('form', $objectId),
            dataType: "json",
            beforeSend: function () {
                $modal.find('#objectId').val('');
                $modal.find('#name').val('');
                $modal.find('#email').val('');
                $modal.find('#localization').val('');
                $modal.find('#interest option:first').prop('selected', true);
            },
            success: function ($json) {
//                $('#btn-submit-member').text('Cadastrar');
                if ($.isPlainObject($json)) {
                    if ($json.success === true) {
                        $modal.find('#objectId').val($objectId);
                        if ($.isPlainObject($json.data)) {
                            $modal.find('#name').val($json.data.name);
                            $modal.find('#email').val($json.data.email);
                            $modal.find('#localization').val($json.data.localization);
                            $modal.find('#interest').val($json.data.interest);
                            $('#btn-submit-member').text('Atualizar');
                        }
                    }
                }
            },
            complete: function () {
                $modal.modal('show');
            }
        });
    },
    filter: function (e, $input) {
        var code = e.keyCode || e.which;
        if (code === '9') {
            return;
        }
        var inputContent = $input.val().toLowerCase();
        var $panel = $input.parents('.filterable');
        var column = $panel.find('.filters th').index($input.parents('th'));
        var $table = $panel.find('.table');
        var $rows = $table.find('tbody tr');
        var $filteredRows = $rows.filter(function () {
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        $table.find('tbody .no-result').remove();
        $rows.show();
        $filteredRows.hide();
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No result found</td></tr>'));
        }
    },
    showFilter: function ($panel) {
        var $filters = $panel.find('.filters input');
        var $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') === true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    },
    loadMembers: function () {
        var self = this;
        $.ajax({
            url: self.url('load'),
            beforeSend: function () {
                $('#table-members tbody').html('<tr><td colspan="5">Carregando...</td></tr>');
            },
            success: function ($html) {
                $('#table-members tbody').html($html).find('.btn-edit-member').click(function () {
                    var $objectId = $(this).closest('tr').data('objectid');
                    self.showModalMember($objectId);
                });
            },
            complete: function () {
                $('#modal-add-member').modal('hide');
            }
        });
    },
    init: function () {
        var self = this;
        $.ajax({
            url: self.url('index'),
            success: function ($html) {
                $('main section.container').html($html);
                $('#btn-add-member').click(function () {
                    self.showModalMember();
                    return false;
                });
                $('#btn-load-member').click(function () {
                    self.loadMembers();
                    return false;
                }).click();
                $('.filterable #btn-filter-member').click(function () {
                    var $panel = $(this).parents('.filterable');
                    self.showFilter($panel);
                    return false;
                });
                $('.filterable .filters input').keyup(function (e) {
                    var $input = $(this);
                    self.filter(e, $input);
                    return false;
                });
                $('#modal-add-member').modal({
                    show: false,
                    keyboard: false
                });
                $('#modal-add-member #btn-submit-member').click(function () {
                    $('#modal-add-member form').submit();
                    return false;
                });
                self.applyRulesModalMember();
            }
        });
    }
};
define(function () {
    return members;
});