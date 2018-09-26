function visualizar(id) {
    window.location = 'index.php?pagina=perfil&id='+id;
}

function cadastrar() {
    window.location = 'index.php?pagina=form';
}

function editar(id) {
    window.location = 'index.php?pagina=form&id='+id;
}

function excluir(id) {
    swal("Você tem certeza que deseja excluir o registro "+id+"?", {
        buttons: ["Não, cancelar.", "Sim, excluir."]
    })
    .then((value) => {
        if (value)
        {
            window.location = 'index.php?pagina=delete&id='+id;
        }
    });

    // var confirmacao = confirm("Você tem certeza que deseja excluir o registro "+id+"?");
    // if (confirmacao == true)
    // {
    // }
}

function registrarCafe(id, )
{
    var option = '';
    var select = document.createElement("SELECT");
    select.classList.add('form-control');
    select.name = 'tipoCafe'

    option = document.createElement("option");
    option.value = "1";
    option.text = 'Café Normal';
    select.add(option);

    option = document.createElement("option");
    option.value = "2";
    option.text = 'Café Pingado';
    select.add(option);

    option = document.createElement("option");
    option.value = "3";
    option.text = 'Cappuccino';
    select.add(option);

    option = document.createElement("option");
    option.value = "4";
    option.text = 'Mochaccino';
    select.add(option);

    swal({
        text: 'Escolha o tipo de café desejado.',
        content: select,
        button: {
            text: "Retirar Café",
            closeModal: false,
        },
    })
    .then(tipoCafe => {
        if (!tipoCafe) throw null;

        return fetch(`retira-cafe.php?idfuncionario=${id}&tipoCafe=${select.value}`);
    })
    .then(results => {
        return results.json();
    })
    .then(json => {
        const objResposta = json;

        if (objResposta.permissaoNegada)
        {
            return swal('Ops!', objResposta.msg, 'warning');
        }

        const msg = objResposta.msg;

        swal("Sucesso!", msg, 'success');
    })
    .catch(err => {
        if (err)
        {
            swal("Oh não!", "Houve algum erro com a requisição AJAX!", "error");
        }
        else
        {
            swal.stopLoading();
            swal.close();
        }
    });
}

$(document).ready(function() {

    $('input:text').setMask();

});