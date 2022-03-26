( function () {
  'use strict'

  let urlVizualiarPrescricao = window.location.protocol+'//'+window.location.host+'/medicina/visualizar-prescricao';
  console.log(urlVizualiarPrescricao);

  const btn_registrar = document.getElementById('btn_registrar');

  function obterDados(itensPrescritos) {

    let dados = new FormData();
        dados.append('id_medico', func);
        dados.append('id_paciente', pac);
        dados.append('itensPrescritos', JSON.stringify(itensPrescritos));

    return dados;
  
  }

  function btnStatus(acao) {
    
    if(acao) {
      btn_registrar.innerHTML = 'Registrando...';
      btn_registrar.setAttribute("disabled", "");
    } else {
      btn_registrar.innerHTML = 'Registrar';
      btn_registrar.removeAttribute("disabled");
    }
  };

  const alertDanger = (responseError) => {

    let alert = `<div class="col-md-4 alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>A prescrição não pode ser cadastrada.<br>${responseError}.</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>`;

    document.getElementById('alertCadastro').innerHTML += alert;

  };

  const alertSuccess = (idPrescricao) => {
    
    document.getElementById("tbody").innerHTML = '';

    let alert = `<div class="col-md-4 alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Prescrição cadastrada com sucesso</strong>
                    <a class="btn btn-warning" href="${urlVizualiarPrescricao}/${idPrescricao}" role="button">Ver Prescrição</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>`;

    document.getElementById('alertCadastro').innerHTML += alert;
    
  };

  async function enviarDados(dados) {
        
        const url = `http://127.0.0.1:8000/api/registrar-prescricao`;

        try {

            let response = await fetch(url, {method: 'POST', body: dados});

            response = await response.json();

            if(response.error) {
              alertDanger(response.error);
            } else {
              limparItensPrescritos();
              alertSuccess(response.idPrescricao);
            }
        }
        catch(error) {
          //console.log(error);
          alert(error);
        }
          
      };


  btn_registrar.addEventListener('click', function () {

    let itensPrescritos = {
            dieta: window.sessionStorage.getItem('dieta'),
            medicacoes: JSON.parse(window.sessionStorage.getItem('medicacoes')),
            outros: JSON.parse(window.sessionStorage.getItem('outros'))
          };

    if(!itensPrescritos.dieta && !itensPrescritos.medicacoes && !itensPrescritos.outros) return;

    let dados = obterDados(itensPrescritos);

    btnStatus(true);

    enviarDados(dados);
     
    btnStatus(false);

  });

  const limparItensPrescritos = () => {
      window.sessionStorage.removeItem('dieta');
      window.sessionStorage.removeItem('medicacoes');
      window.sessionStorage.removeItem('outros');
  };

})()